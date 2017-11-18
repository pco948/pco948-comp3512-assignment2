<?php
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