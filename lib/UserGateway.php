<?php
/*
The name of the table in the database

Description: Class is designed to set up as a pesudo-interface to run basic queries, and return fetch recordsets.
*/
class UserGateway extends TableDataGateway {
 protected $conection;
     
 public function __construct($connect) {
  parent::__construct($connect);
 }
 
 protected function getSelectStatement() {
  return "SELECT * FROM Users";
 }
 protected function getOrderFields(){}
 /*
 The name of the primary keys in the database ... this can be overridden by
 subclasses
 */
 protected function getPrimaryKeyName() {
  return "UserID";
 }
}
?>
