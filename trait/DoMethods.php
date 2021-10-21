<?php
trait DoMethods
{
    private function showTables()
    {
        $database = new Database($this->dataBase);
        $result = ['tables'=>$database->getTables(),'database'=>$database];
        $this->view('showTables',$result);
    }
    private function databasesToObject($item)
    {
        $database = new Database($item->Database);
        return $database;
    }
    private function showDatabases()
    {
        $query = 'show databases';
        $statement = $this->connection->query($query);
        $fetch = $statement->fetchAll($this->connection::FETCH_OBJ);
        $fetch=  array_map([$this,'databasesToObject'],$fetch);
        $result = ['databases'=>$fetch];
        $this->view('showDatabases',$result);
    }
    private function showRows()
    {
        $table = new Table($this->dataBase,$this->table);
        $result = ['rows'=>$table->getRows(),'table'=>$table,'database'=>$table->getDatabase()];
        $this->view('showTableContent',$result);
    }
    private function deleteDatabase()
    {
        $database = new Database($this->dataBase);
        $result =['isDeleted'=>$database->delete(),'database'=>$database];
        $this->view('dropDatabase',$result);
    }
    private function deleteTable()
    {
        $table = new Table($this->dataBase,$this->table);
        $result = ['isDeleted'=>$table->delete(), 'table'=>$table];
        $this->view('dropTable',$result);
    }
    private function deleteRow()
    {
        $row = new Row($this->row,$this->dataBase,$this->table);
        $result = ['isDeleted'=>$row->delete(),'database'=>$row->getDatabase(), 'table'=>$row->getTable() , 'row'=>$row];
        $this->view('deleteRow',$result);
    }
}