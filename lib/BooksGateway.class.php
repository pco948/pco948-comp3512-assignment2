<?php
class BooksGateway extends TableDataGateway {

 public function __construct($connect) {
 parent::__construct($connect);
 }

 protected function getSelectStatement()
 {
 return "SELECT BookID, ISBN10, ISBN13, Title, CopyrightYear,
 SubcategoryID, ImprintID, ProductionStatusID, PageCountsEditorialEst,latestInstockDate, Description, CoverImage FROM Books ";
 }

 protected function getOrderFields() {
 return 'Books.Title';
 }
 protected function getPrimaryKeyName() {
 return "Books.BookID";
 }
 
 protected function getIsbnNumber(){
  return "Books.ISBN10";
 }
 
 protected function getJoinedSelectStatements()
     {
      return "SELECT BookID, ISBN10, SUBSTRING(Title, 1, 57) as Title, CopyrightYear, SubcategoryName, Imprint 
      FROM Books, Subcategories, Imprints
      WHERE Imprints.ImprintID = Books.ImprintID
      AND Subcategories.SubcategoryID = Books.SubcategoryID";
     }

protected function getBookDetails()
{
return "SELECT Title, BookID, ISBN10,ISBN13, CopyrightYear, SubcategoryName, Imprint,
         Status,BindingType, TrimSize, PageCountsEditorialEst, Description 
FROM Books
INNER JOIN Subcategories ON Subcategories.SubcategoryID = Books.SubcategoryID
INNER JOIN Imprints ON Imprints.ImprintID = Books.ImprintID
INNER JOIN BindingTypes ON BindingTypes.BindingTypeID = Books.BindingTypeID
INNER JOIN Statuses ON Statuses.StatusID = Books.ProductionStatusID";
}

public function findBookDetailsByIsbn($isbn)
{
 $sql = $this->getBookDetails(). ' WHERE ' .
 $this->getIsbnNumber() . '=:ISBN10';

 $statement = DatabaseHelper::runQuery($this->connection, $sql,
 Array(':ISBN10' => $isbn));
 return $statement->fetchAll();
} 

public function findByJoinStatements($id)
{
 $sql = $this->getJoinedSelectStatements() . ' WHERE ' .
 $this->getPrimaryKeyName() . '=:id';
  $sql .= " LIMIT 20";

 $statement = DatabaseHelper::runQuery($this->connection, $sql,
 Array(':id' => $id));
 return $statement->fetchAll();
} 

public function findAllLimitByTwenty()
 {
 $sql = $this->getJoinedSelectStatements() . ' ORDER BY ' . $this->getOrderFields();
 $sql .= " ASC LIMIT 20";
 $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
 return $statement->fetchAll();
}

public function runQuery($sql)
{
  $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
  return $statement->fetchAll();
  
}


}

?>