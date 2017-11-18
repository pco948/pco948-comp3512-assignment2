<?php
    
class SubcategoriesGateway extends TableDataGateway {

    
 public function __construct($connect) {
 parent::__construct($connect);
 }

 protected function getSelectStatement()
 {
 return "SELECT Subcategories.SubcategoryID, CategoryID, SubcategoryName FROM Subcategories ";
 }

 protected function getOrderFields() {
 return 'SubcategoryName';
 }
 protected function getPrimaryKeyName() {
 return "Subcategories.SubcategoryID";
 }
 
 protected function getJoinedSelectStatements()
 {
 return" SELECT BookID, ISBN10, SUBSTRING(Title, 1, 57) Title, CopyrightYear, SubcategoryName, Imprint 
         FROM Books 
         JOIN Subcategories ON Books.SubcategoryID = Subcategories.SubcategoryID
         JOIN Imprints ON Books.ImprintID = Imprints.ImprintID";
 }
 protected function getBookName() {
  return "Books.Title";
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
}
?>