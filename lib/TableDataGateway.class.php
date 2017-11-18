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
 
abstract protected function getSelectStatement();
/*
A list of fields that define the sort order
*/
abstract protected function getOrderFields();
/*
The name of the primary keys in the database ... this can be overridden by
subclasses
*/
abstract protected function getPrimaryKeyName();


/*
 Returns all the records in the table
*/
public function findAll($sortFields=null)
{
 $sql = $this->getSelectStatement();
 // add sort order if required
 if (! is_null($sortFields)) {
 $sql .= ' ORDER BY ' . $sortFields;
 }
 $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
 return $statement->fetchAll();
}
/*
 Returns all the records in the table sorted by the specified sort order
*/
public function findAllSorted($ascending)
{
 $sql = $this->getSelectStatement() . ' ORDER BY ' .
 $this->getOrderFields();
 $sql .= " ASC";
 if (! $ascending) {
 $sql .= " DESC";
 }
 $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
 return $statement->fetchAll();
}
/*
 Returns a record for the specificed ID
 
 THIS FUNCTION DOES NOT WORK FOR MULTIPLE RECORDS, DO NOT USE
*/
public function findById($id)
{
 $sql = $this->getSelectStatement() . ' WHERE ' .
 $this->getPrimaryKeyName() . '=:id';

 $statement = DatabaseHelper::runQuery($this->connection, $sql,
 Array(':id' => $id));
 return $statement->fetch();
} 







}
?>
