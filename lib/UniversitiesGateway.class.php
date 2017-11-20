<?php
class UniversitiesGateway extends TableDataGateway {
     
 public function __construct($connect) {
 parent::__construct($connect);
 }
 
protected function getSelectStatement(){
 return "SELECT UniversityID, Name, Address, City, State, Zip, Website, Longitude, Latitude FROM Universities";   
}

protected function getOrderFields(){
    return "Name";
}

protected function getPrimaryKeyName(){
    return "UniversityID";
}

  protected function getIsbnNumber(){
  return "Books.ISBN10";
 }

protected function getlistedUniversitiesAdoptedBook()
{
 return "SELECT Name, Universities.UniversityID
       FROM Universities
       JOIN Adoptions ON Adoptions.UniversityID = Universities.UniversityID
       JOIN AdoptionBooks ON AdoptionBooks.AdoptionID = Adoptions.AdoptionID 
       JOIN Books ON Books.BookID = AdoptionBooks.BookID";
}

public function findBookUniversityDetailsByIsbn($isbn)
{
 $sql = $this->getlistedUniversitiesAdoptedBook(). ' WHERE ' .
 $this->getIsbnNumber() . '=:ISBN10';
 $sql.=' ORDER BY ' . $this->getOrderFields();
 $sql .= " ASC";
 $statement = DatabaseHelper::runQuery($this->connection, $sql,
 Array(':ISBN10' => $isbn));
 return $statement->fetchAll();
} 

}

function printUniversitiesList()
{
    try {
        $connection = getConnection();
        $sql        = "SELECT UniversityID, Name FROM Universities ORDER BY Name LIMIT 20 ";
        $statement  = DatabaseHelper::runQuery($connection, $sql);
        while ($row = $statement->fetch()) {
            echo "<li>" . "<a href=" . 'browse-universities.php?university=' . $row['UniversityID'] . ">" . $row['Name'] . "</a>" . "</li>" . "<br/>";
        }
        
        $connection = null;
    }
    catch (PDOException $e) {
        echo "Error";
    }
}

function printUniversitiesByStates()
{
    try {
        $connection = getConnection();
        $sql       = "SELECT UniversityID, Name 
    FROM Universities, States 
    WHERE States.StateAbbr = ?
    AND States.StateName = Universities.State 
    COLLATE utf8_unicode_ci 
    ORDER by Name 
    LIMIT 20";
    
        $statement  = DatabaseHelper::runQuery($connection, $sql, $_GET['states']);
        while ($row = $statement->fetch()) {
            echo "<li>" . "<a href=" . 'browse-universities.php?university=' . $row['UniversityID'] . ">" . $row['Name'] . "</a>" . "</li>" . "<br/>";
        }
        $connection = null;
    }
    catch (PDOException $e) {
        echo "Error";
    }
}

function printFilter()
{
    try {
        $connection = getConnection();
        $sql        = "SELECT StateId, StateName, StateAbbr FROM States ORDER by StateName";
        $statement  = DatabaseHelper::runQuery($connection, $sql);
        while ($row = $statement->fetch()) {
            echo "<option value=" . $row['StateAbbr'] . ">" . $row['StateName'] . "</option>";
        }
        $connection = null;
    }
    catch (PDOException $e) {
        echo "Error";
    }
}

function printUniversityDetails()
{
    try {
        $connection = getConnection();
        $sql        = "SELECT UniversityID, Name, Address, City, State, Zip, Website, Latitude, Longitude
     FROM Universities
     WHERE UniversityID = ?";
        $statement  = DatabaseHelper::runQuery($connection, $sql, $_GET['university']);
        if ($statement->rowCount() == 0) {
            echo "Did not understand request!... try clicking on a University from list";
        }
        while ($row = $statement->fetch()) {
            
            echo '<div class="mdl-card__supporting-text">';
            echo "<h3>" . $row['Name'] . "</h3>";
            echo "<h6> Address: " . $row['Address'] . "<br>";
            echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
            echo $row['City'] . ", " . $row['State'] . " " . $row['Zip'] . "</br>";
            echo "Website: <a href = " . $row['Website'] . ">" . $row['Website'] . "</a></h6>";
            include('includes/load-map.php');
            echo '</div>';
        }
    }
    catch (PDOException $e) {
        echo "error";
    }
}
?>