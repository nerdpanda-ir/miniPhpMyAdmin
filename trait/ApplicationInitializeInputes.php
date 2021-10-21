<?php
trait ApplicationInitializeInputes
{
    private function initializeAction():void
    {
        if ($this->inputChecker('action'))
            $this->action =$_GET['action'];
    }
    private function initializeDataBase():void
    {
        if ($this->inputChecker('database'))
            $this->dataBase =$_GET['database'];
    }
    private function initializeTable()
    {
        if ($this->inputChecker('table'))
            $this->table =$_GET['table'];
    }
    private function initializeRow()
    {
        if ($this->inputChecker('row') && is_numeric($_GET['row']))
            $this->row =$_GET['row'];
    }
}