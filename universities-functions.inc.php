<?php

//Checks if there is a state filter applied and filter the universities list based on the filter.
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

//Will print out specific details about a selected university.
function printSpecificUniversityDetail()
{
    try {
        if (isset($_GET["university"])) {
            if (empty($_GET["university"])) {
                echo "<p> No university found!... try clicking on a university from list </p>";
            } else {
                printUniversityDetails();
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