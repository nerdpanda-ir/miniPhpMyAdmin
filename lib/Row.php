<?php require_once 'DatabaseItem.php'; ?>
<?php require_once 'Database.php'; ?>
<?php require_once 'Table.php'; ?>
<?php
final class Row extends DatabaseItem
{
    private Database $database;
    private Table $table;
    private  $content;
    public function __construct($name,$database,$table)
    {
        $this->initializeDatabase($database);
        $this->initializeTable($table);
        parent::__construct($name);
        $this->initializeContent();
    }
    private function initializeDatabase($database)
    {
        if ($database instanceof Database)
            $this->database = $database;
        else if (is_string($database))
            $this->database = new Database($database);
    }
    private function initializeTable($table)
    {
        if ($table instanceof Table)
            $this->table=$table;
        else
            if (is_string($table))
                $this->table=new Table($this->database,$table);
    }
    public function getDatabase() :Database
    {
        return  $this->database;
    }
    public function getTable():Table
    {
        return $this->table;
    }
    protected function initializeIsExist(): void
    {
        $tablePrimaryKeyColumn = $this->table->getPrimaryKeyColumn();
        $query = 'select '.$tablePrimaryKeyColumn.' from '.$this->getDatabase()->getName().'.'.$this->table->getName().' where '.$tablePrimaryKeyColumn.' = :value  ';

        $statement = $this->connection->prepare($query);
        $statement->bindValue(':value',$this->name);

        $execute = $statement->execute();

        if ($statement instanceof PDOStatement and $execute and $statement->rowCount()>=1)
            $this->isExist = true;
        else
            $this->isExist = false;
    }
    private function initializeContent()
    {
        $query = 'select * from '.$this->database->getName().'.'.$this->table->getName().' where '.$this->table->getPrimaryKeyColumn().'='.$this->name.';';
        $statement = $this->connection->query($query);
        if ($statement instanceof PDOStatement)
            $this->content=$statement->fetch($this->connection::FETCH_OBJ);
        else
            $this->content=null;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function delete():bool
    {
        if (!$this->getIsExist())
            return false;
        $query = 'delete from '.$this->database->getName().'.'.$this->table->getName().' where '.$this->table->getPrimaryKeyColumn().'=?';
        $statement = $this->connection->prepare($query);
        $statement->bindValue(1,$this->name);
        if ($statement instanceof PDOStatement and $statement->execute())
            return true;
        return false;
    }
}
?>