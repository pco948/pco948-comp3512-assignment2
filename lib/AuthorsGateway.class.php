<?php
class AuthorsGateway extends TableDataGateway {

    
 public function __construct($connect) {
 parent::__construct($connect);
 }

 protected function getSelectStatement()
 {
 return "SELECT AuthorID, FirstName, LastName, Institution From Authors";
 }

 protected function getOrderFields() {
 return 'FirstName';
 }
 protected function getPrimaryKeyName() {
 return "Authors.AuthorID";
 }
  
  protected function getIsbnNumber(){
  return "Books.ISBN10";
 }
 
protected function getJoinedSelectStatements()
 {
 return"SELECT FirstName, LastName 
       FROM Authors
       JOIN BookAuthors ON BookAuthors.AuthorId = Authors.AuthorID
       JOIN Books ON Books.BookID = BookAuthors.BookId ";
 }
 
public function findBookAuthorDetailsByIsbn($isbn)
{
 $sql = $this->getJoinedSelectStatements(). ' WHERE ' .
 $this->getIsbnNumber() . '=:ISBN10';
 $sql.=' ORDER BY ' . $this->getOrderFields();
 $sql .= " ASC";
 $statement = DatabaseHelper::runQuery($this->connection, $sql,
 Array(':ISBN10' => $isbn));
 return $statement->fetchAll();
} 
 
}
?>