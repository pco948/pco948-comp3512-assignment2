<?php
class EmployeesGateway extends TableDataGateway {
 
 public function __construct($connect) {
   parent::__construct($connect);
 }

 protected function getSelectStatement()
 {
 return "SELECT EmployeeID, FirstName, LastName, Address, City,
 Region, Country, Postal, Email FROM Employees 
 ORDER BY LastName";
 }

 protected function getOrderFields() {
 return 'LastName, FirstName';
 }
 protected function getPrimaryKeyName() {
 return "EmployeeID";
 }
 
  protected function getJoinedSelectStatement()
     {
      return "SELECT EmployeeID, FirstName, LastName, Address, City,
              Region, Country, Postal, Email FROM Employees";
     }
     
     public function getDistinctCity(){
        return   "SELECT DISTINCT City FROM Employees ORDER by City";
     }
     
     protected function getEmployeeAddresses()
     {
      return "SELECT EmployeeID, FirstName, LastName, Address, City,
              Region, Country, Postal, Email FROM Employees 
              WHERE EmployeeID = ?";
     }
     
   
public function findEmployeeAddresses($sortFields=null)
{
 $sql = $this->getEmployeeAddresses();
 // add sort order if required
 if (! is_null($sortFields)) {
 $sql .= ' ORDER BY ' . $sortFields;
 }
 $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
 return $statement->fetchAll();
}

 
public function findAddressByID($id) {
  $sql = $this->getEmployeeAddresses() . ' WHERE ' .
  $this->getPrimaryKeyName() . '=:id';
 
  $statement = DatabaseHelper::runQuery($this->connection, $sql,
  Array(':id' => $id));
  return $statement->fetch();
 }  
 
  /*
 public function findEmployeeAddresses($id)
{
 $sql = $this->getEmployeeAddresses() . ' WHERE ' .
 $this->getPrimaryKeyName() . '=:id';
  $sql .= " LIMIT 20";

 $statement = DatabaseHelper::runQuery($this->connection, $sql,
 Array(':id' => $id));
 return $statement->fetchAll();
} 
*/


}
?>
