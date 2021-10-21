<?php require_once 'DatabaseItem.php'; ?>
<?php require_once 'Table.php' ?>
<?php
final class Database extends DatabaseItem
{
    private array $tables=[];
    public function __construct($name)
    {
        parent::__construct($name);
    }
    protected function initializeIsExist():void
    {
        $query = 'show databases like :searchKey';
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':searchKey',$this->name);
        $execute = $statement->execute();
        if ($statement->rowCount()>=1)
            $this->isExist = true;
        else
            $this->isExist=false;
    }
    private function tableToObject($item)
    {
        $tableObject = new Table($this,$item->{"Tables_in_".$this->name});
        return $tableObject;
    }
    private function initializeTables()
    {
        $query = 'show tables from '.$this->name;
        $statement = $this->connection->query($query);
        $this->tables = $statement->fetchAll($this->connection::FETCH_OBJ);
        $this->tables = array_map([$this,'tableToObject'],$this->tables);
    }
    public function getTables():array
    {
        if($this->getIsExist() and empty($this->tables))
            $this->initializeTables();
        return  $this->tables;
    }

    public function delete():bool
    {
        if(!$this->getIsExist())
            return false;
        $query ='drop database '.$this->name;
        $result = $this->connection->exec($query);
        if (is_int($result)&& $result>=0)
            return true;
        return false;
    }

}