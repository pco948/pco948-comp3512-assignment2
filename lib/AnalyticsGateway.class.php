<?php
class AnalyticsGateway extends TableDataGateway {
 
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
     
     protected function getTop15Countries(){
      return "SELECT CountryName, count(BookVisits.CountryCode) 
             From Countries Join BookVisits ON BookVisits.CountryCode=Countries.CountryCode 
             Group by BookVisits.CountryCode 
             Order By Count(BookVisits.CountryCode) 
             Desc Limit 15";
     }
     
         
      protected function getAdoptedBooks(){
      return "SELECT ISBN10, sum(AdoptionBooks.Quantity), Title
              FROM Books 
              JOIN AdoptionBooks ON Books.BookID=AdoptionBooks.BookID
              GROUP BY AdoptionBooks.BookID
              ORDER BY sum(AdoptionBooks.Quantity) 
              DESC Limit 10";
     }
     
      protected function getTotalNumVisits(){
      return "SELECT count(DateViewed) 
              FROM BookVisits
              WHERE DateViewed >=  '01/06/2017'
              AND DateViewed <=  '31/06/2017'";
     }
     
     protected function getUniqueCountries(){
      return "SELECT  count(DISTINCT BookVisits.CountryCode) 
              From BookVisits";
     }
     
     protected function getTotalEmployeeToDo(){
      return "SELECT count(DateBy)
              FROM EmployeeToDo
              WHERE DateBy >= '2017-06-01 00:00:00'
              AND DateBy <= '2017-06-30 00:00:00'";
     }
     
      protected function getTotalEmployeeMessages(){
      return "SELECT count(MessageDate)
              FROM EmployeeMessages
              WHERE MessageDate >= '2017-06-01 00:00:00'
              AND MessageDate <= '2017-06-30 00:00:00'";
     }
     
   //  and the total number of employee messages in June 2017

   
public function findTop15Countries()
{
 $sql = $this->getTop15Countries();
 // add sort order if required

 $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
 return $statement->fetchAll();
}

public function findAdoptedBooks()
{
 $sql = $this->getAdoptedBooks();


 $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
 return $statement->fetchAll();
}

public function findTotalNumVisits()
{
 $sql = $this->getTotalNumVisits();


 $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
 return $statement->fetch();
}

public function findUniqueCountries()
{
 $sql = $this->getUniqueCountries();


 $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
 return $statement->fetch();
}

public function findTotalEmployeeToDo()
{
 $sql = $this->getTotalEmployeeToDo();


 $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
 return $statement->fetch();
}

public function findTotalEmployeeMessages()
{
 $sql = $this->getTotalEmployeeMessages();


 $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
 return $statement->fetch();
}


}
?>
