<?php
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

function printUniversityListChecker()
{
    if (isset($_GET["states"])) {
        if ($_GET["states"] == "remove" || $_GET["states"] == "") {
            printUniversitiesList();
        } else {
            printUniversitiesByStates();
        }
    } else {
        printUniversitiesList();
    }
}

function printSpecificUniversityDetail()
{
    try {
        if (isset($_GET["university"])) {
            if (empty($_GET["university"])) {
                echo "<p> No university found!... try clicking on a university from list </p>";
            } else {
                include 'includes/university-details.inc.php';
            }
        } elseif (!isset($_GET[employee])) {
            echo "<p> Try clicking on a university from the list </p>";
        }
    }
    catch (PDOException $e) {
        echo "Error";
    }
}
?>