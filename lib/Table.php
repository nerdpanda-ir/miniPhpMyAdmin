<?php require_once 'DatabaseItem.php' ?>
<?php require_once 'Database.php' ?>
<?php require_once 'Row.php' ?>
<?php
final class Table extends DatabaseItem
{
    private Database $database;
    private string $primaryKeyColumn;
    private array $rows;
    public function __construct($database,string $name)
    {
        $this->initializeDatabase($database);
        parent::__construct($name);
    }
    private function initializeDatabase($database):void
    {
        if ($database instanceof Database)
            $this->database =$database;
        else
            if (is_string($database))
                $this->database= new Database($database);
    }
    private function initializePrimaryKeyColumn():void
    {
        $query ='SHOW KEYS FROM '.$this->database->getName().'.'.$this->name.' WHERE Key_name = \'PRIMARY\'';
        $statement = $this->connection->query($query);
        $keys =$statement->fetch($this->connection::FETCH_OBJ);
        if ($keys!==false)
            $this->primaryKeyColumn = $keys->Column_name;
        else
            $this->primaryKeyColumn='';
    }
    public function getPrimaryKeyColumn():string
    {
        if ($this->getIsExist() and !isset($this->primaryKeyColumn))
            $this->initializePrimaryKeyColumn();
        return $this->primaryKeyColumn;
    }
    private function rowToObj($item)
    {
        $row = new Row($item->{$this->getPrimaryKeyColumn()},$this->database,$this);
        return $row;
    }
    private function initializeRows()
    {
        $query = 'select * from '.$this->database->getName().'.'.$this->name;
        $statement = $this->connection->query($query);
        if ($statement instanceof PDOStatement)
        {
            $this->rows = $statement->fetchAll($this->connection::FETCH_OBJ);
            $this->rows = array_map([$this,'rowToObj'],$this->rows);
        }
        else
            $this->rows= [];
    }

    protected function initializeIsExist():void
    {
        $query = 'show tables from '.$this->database->getName().' like :searchKey';
        $statement = $this->connection->prepare($query);
        $execute = $statement->execute([':searchKey'=>$this->name]);
        if ($statement->rowCount()>=1)
            $this->isExist=true;
        else
            $this->isExist=false;
    }

    public function getDatabase():Database
    {
        return  $this->database;
    }
    public function getRows()
    {
        if (!isset($this->rows))
            $this->initializeRows();
        return $this->rows;
    }
    public function delete():bool
    {
       if (!$this->getIsExist())
           return false;
       $query = 'drop table '.$this->database->getName().'.'.$this->name;
       $result = $this->connection->exec($query);
       if ($result===false)
           return false;
       return  true;
    }
}
