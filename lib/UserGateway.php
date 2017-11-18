<?php
/*
The name of the table in the database

Description: Class is designed to set up as a pesudo-interface to run basic queries, and return fetch recordsets.
*/
abstract class TableDataGateway  {
 
 protected $conection;
 
 public function __construct($connect)
 {
  if(is_null($connect))
   throw new Exception("Connection is null");
  $this->connection = $connect;
 }
 
protected function getSelectStatement();
/*
A list of fields that define the sort order
*/
protected function getOrderFields();
/*
The name of the primary keys in the database ... this can be overridden by
subclasses
*/
protected function getPrimaryKeyName();








}
?>
