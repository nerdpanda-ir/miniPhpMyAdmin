<?php require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'trait' . DIRECTORY_SEPARATOR . 'ApplicationInitializeInputes.php'; ?>
<?php require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'trait' . DIRECTORY_SEPARATOR . 'DoConditions.php'; ?>
<?php require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'trait' . DIRECTORY_SEPARATOR . 'DoMethods.php'; ?>
<?php require_once 'Database.php' ?>
<?php require_once 'DatabaseConnector.php'; ?>
<?php
final class Application
{
    private int $action = 1 ;
    private string $dataBase='';
    private string $table='';
    private  string $row='';
    private string $viewPath;
    private PDO $connection;

    use ApplicationInitializeInputes;
    use DoConditions;
    use DoMethods;
    public function __construct()
    {
        $this->viewPath= dirname(__DIR__) . DIRECTORY_SEPARATOR .DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR;
        $this->connection = DatabaseConnector::getConnection();
        $this->initialize();
        $this->do();
    }
    private function view($view,array $result)
    {
        extract($result);
        require_once $this->viewPath.$view.'.php';
    }
    private function initialize()
    {
        $this->initializeAction();
        $this->initializeDataBase();
        $this->initializeTable();
        $this->initializeRow();
    }
    private function validStrLen($value):bool
    {
        return strlen($value)>=1;
    }
    private function inputChecker($key) :bool
    {
        $isExist =isset($_GET[$key]) && $this->validStrLen($_GET[$key]);
        return  $isExist;
    }
    private function do():void
    {
        if ($this->isShowTables())
            $this->showTables();
        else
            if ($this->isShowDatabases())
                $this->showDatabases();
            else
                if ($this->isShowTable())
                    $this->showRows();
                else
                    if ($this->isDeleteDatabase())
                        $this->deleteDatabase();
                    else
                        if ($this->isDeleteTable())
                            $this->deleteTable();
                        else
                            if ($this->isDeleteRow())
                                $this->deleteRow();
    }
}