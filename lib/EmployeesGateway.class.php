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
     
     protected function getDistinctCity(){
        return   "SELECT DISTINCT City FROM Employees ORDER by City";
     }
     
     protected function getEmployeeAddresses()
     {
      return "SELECT EmployeeID, FirstName, LastName, Address, City,
              Region, Country, Postal, Email FROM Employees";
     }
     
     protected function getEmployeeToDo()
     {
      return "SELECT DATE_FORMAT(DateBy,'%Y-%M-%d') as date, Status, Priority, Description 
              FROM EmployeeToDo";
     }
     
     protected function getEmployeeMessage(){
      return "SELECT FirstName, LastName, DATE_FORMAT(MessageDate,'%Y-%M-%d') as Date, Category, SUBSTRING(Content, 1, 40) as Content 
                     FROM Employees 
                     JOIN EmployeeMessages ON Employees.EmployeeID = EmployeeMessages.ContactID";
             
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
  return $statement->fetchAll();
 }  
 
public function findAllCities($sortFields=null)
{
 $sql = $this->getDistinctCity();
 // add sort order if required
 if (! is_null($sortFields)) {
 $sql .= ' ORDER BY ' . $sortFields;
 }
 $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
 return $statement->fetchAll();
}

public function findEmployeeToDo($id){
  $sql = $this->getEmployeeToDo() . ' WHERE ' .
  $this->getPrimaryKeyName() . '=:id';
 
  $statement = DatabaseHelper::runQuery($this->connection, $sql,
  Array(':id' => $id));
  return $statement->fetchAll();
}

public function findEmployeeMessages($id){
  $sql = $this->getEmployeeMessage() . ' WHERE ' .
  $this->getPrimaryKeyName() . '=:id';
 
  $statement = DatabaseHelper::runQuery($this->connection, $sql,
  Array(':id' => $id));
  return $statement->fetchAll();
}




}
?>
