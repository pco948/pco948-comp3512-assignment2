<?php
    
class ImprintsGateway extends TableDataGateway {

    
 public function __construct($connect) {
 parent::__construct($connect);
 }

 protected function getSelectStatement()
 {
 return "SELECT ImprintID, Imprint FROM Imprints";
 }

 protected function getOrderFields() {
 return 'Imprint';
 }
 protected function getPrimaryKeyName() {
 return "Imprints.ImprintID";
 }
   
    protected function getJoinedSelectStatements()
 {
 return" SELECT BookID, ISBN10, SUBSTRING(Title, 1, 57) Title, CopyrightYear, SubcategoryName, Imprint 
         FROM Books 
         JOIN Subcategories ON Books.SubcategoryID = Subcategories.SubcategoryID
         JOIN Imprints ON Books.ImprintID = Imprints.ImprintID";
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