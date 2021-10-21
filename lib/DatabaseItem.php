<?php require_once 'DatabaseConnector.php' ?>
<?php
abstract class DatabaseItem
{
    protected string $name;
    protected PDO $connection;
    protected bool $isExist;
    public function __construct($name)
    {
        $this->name = $name;
        $this->connection = DatabaseConnector::getConnection();
    }
    public function getName():string
    {
        return $this->name;
    }
    protected abstract function initializeIsExist():void;
    public function getIsExist()
    {
        if (!isset($this->isExist))
            $this->initializeIsExist();
        return $this->isExist;
    }
    public abstract function delete():bool;
}
