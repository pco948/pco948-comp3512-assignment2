<?php
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
            
            echo "<h3>" . $row['Name'] . "</h3>";
            echo "<h6> Address: " . $row['Address'] . "<br>";
            echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
            echo $row['City'] . ", " . $row['State'] . " " . $row['Zip'] . "</br>";
            echo "Website: <a href = " . $row['Website'] . ">" . $row['Website'] . "</a></h6>";
            include('includes/load-map.php');
        }
    }
    catch (PDOException $e) {
        echo "error";
    }
}
?>
     
	<div class="mdl-card__supporting-text">
		<?php printUniversityDetails() ?>
	</div>  