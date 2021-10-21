<?php
trait DoConditions
{
    private function isShowTables():bool
    {
        return $this->action==1 && $this->validStrLen($this->dataBase) && !$this->validStrLen($this->table);
    }
    private function isShowDatabases():bool
    {
        return $this->action==1 && !$this->validStrLen($this->dataBase);
    }
    private function isShowTable():bool
    {
        return $this->action==1 && $this->validStrLen($this->dataBase) && $this->validStrLen($this->table);
    }
    private function isDeleteDatabase()
    {
        return $this->action==2 && $this->validStrLen($this->dataBase) and !$this->validStrLen($this->table);
    }
    private function isDeleteTable()
    {

        return $this->action==2 && $this->validStrLen($this->dataBase) and $this->validStrLen($this->table) and !$this->validStrLen($this->row);
    }
    private function isDeleteRow()
    {
        return $this->action==2 && $this->validStrLen($this->dataBase) and $this->validStrLen($this->table) and $this->validStrLen($this->row);
    }
}