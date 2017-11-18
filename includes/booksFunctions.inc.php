<?php
 require_once('includes/db-config.inc.php');
 $data = new BooksGateway($connection );
 
 $subcategoriesData = new SubcategoriesGateway($connection);
 $imprintsData = new ImprintsGateway($connection);
 $authorData = new AuthorsGateway($connection);
 $universityData = new UniversitiesGateway($connection);

//Browse Books Page Functions
function printAllBooks($data){
      $result = $data->findAllLimitByTwenty();

      foreach($result as $row) {
       echo "<tr>";
       echo  "<td style='text-align: left'>" . "<img src='book-images/thumb/" . $row['ISBN10'] .".jpg'></td>";
      echo  "<td style='text-align: left'>" . "<a href=" . 'single-book.php?isbn=' .   $row['ISBN10'] . ">".  $row['Title']  . "</a>" . "</td>";
       echo  "<td style='text-align: left'>" . $row['CopyrightYear'] . "</td>";
      echo  "<td style='text-align: left'>" . $row['SubcategoryName'] . "</td>";
    echo  "<td style='text-align: left'>" . $row['Imprint']   . "</td>";
    echo "</tr>"; 
             }
         }
                               
function printBooksSubcategoryFilter($subcategoriesIDNumber){
 
 global   $subcategoriesData;

$result = $subcategoriesData->findByJoinStatements($subcategoriesIDNumber);
 
      foreach($result as $row) {
      
       echo "<tr>";
             echo  "<td style='text-align: left'>" . "<img src='book-images/thumb/" . $row['ISBN10'] .".jpg'></td>";
              echo  "<td style='text-align: left'>" . "<a href=" . 'single-book.php?isbn=' .   $row['ISBN10'] . ">".  $row['Title']  . "</a>" . "</td>";
              echo  "<td style='text-align: left'>" . $row['CopyrightYear'] . "</td>";
               echo  "<td style='text-align: left'>" . $row['SubcategoryName'] . "</td>";
                echo  "<td style='text-align: left'>" . $row['Imprint']   . "</td>";
              echo "</tr>";  
      }
}

                               
function printBooksImprintFilter($imprintsIDNumber){
 global $imprintsData;
 
 $result = $imprintsData->findByJoinStatements($imprintsIDNumber);
  
  foreach($result as $row) 
  {
         echo "<tr>";
        echo  "<td style='text-align: left'>" . "<img src='book-images/thumb/" . $row['ISBN10'] .".jpg'></td>";
        echo  "<td style='text-align: left'>" . "<a href=" . 'single-book.php?isbn=' . $row['ISBN10'] . ">".  $row['Title']  . "</a>" . "</td>";
        echo  "<td style='text-align: left'>" . $row['CopyrightYear'] . "</td>";
         echo  "<td style='text-align: left'>" . $row['SubcategoryName'] . "</td>";
        echo  "<td style='text-align: left'>" . $row['Imprint']   . "</td>";
        echo "</tr>"; 
         }
}


function printSubcategoryDropdown($subcategoriesData){
          $result = $subcategoriesData-> findAllSorted("ASC");
      foreach($result as $row) {
         echo "<option value=" . $row['SubcategoryID'] . ">" . $row['SubcategoryName'] . "</option>";
              }
       $subcategoriesData = null;
}

function printImprintDropdown($imprintsData){
      $result = $imprintsData-> findAllSorted("ASC");
      foreach($result as $row) {
          echo "<option value=" . $row['ImprintID'] . ">" . $row['Imprint'] . "</option>";
                                 }
                                 $imprintsData = null;
}

 function printBookChecker($data) 
{
      if(isset($_GET["subcategory"]) || isset($_GET['imprint']))
      {
       if($_GET["subcategory"] == "all" || $_GET["imprint"] == "all" )  {   printAllBooks($data); }
                       
         else if(isset($_GET["subcategory"])) { printBooksSubcategoryFilter($_GET["subcategory"]); }
         
       else if(isset($_GET["imprint"])){ printBooksImprintFilter($_GET["imprint"]);   }
          
            else if($_GET["subcategory"] == " " || $_GET["imprint"] == " " )  {echo "Try filtering by subcategory or imprints";}
      }  
      else { printAllBooks($data); }
               
}

//Single Books Page Functions
function printBookDetails($isbnNumber)
{

global  $data;
$result = $data->findBookDetailsByIsbn($isbnNumber);
  foreach($result as $row) 
{
  echo "<div class='mdl-card__media mdl-cell mdl-cell--12-col-tablet'>";
  echo  "<img class='article-image' src='book-images/medium/" . $row['ISBN10'] .".jpg' border='0' alt=''>";
  echo "</div>";
  echo "<div class='mdl-cell mdl-cell--8-col'>";
  echo "<h2 class='mdl-card__title-text' > <strong>". $row['Title'] . "</strong></h2>";
  echo "<div class='mdl-card__supporting-text padding-top'>";
  echo  "<span>".$row['SubcategoryName'] . " (" . $row['CopyrightYear'] . ") </span>";
  echo "<div class='mdl-card__supporting-text no-left-padding'>";
    echo "<p> <strong>ISBN10: </strong>". $row['ISBN10'] . "</br>";
    echo "<strong> ISBN13: </strong>" . $row['ISBN13'] . "</br>";
    echo "<strong> Subcategory: </strong><a href=".'browse-books.php?subcategory='.$row['SubcategoryID'].">" .$row['SubcategoryName'] ."</a></br>";
    echo "<strong> Imprint: </strong><a href=" .'browse-books.php?imprint='.$row['ImprintID'].">". $row['Imprint']   . "</a></br>";
    echo " <strong> Production Status: </strong>" . $row['Status'] . "</br>";
    echo "<strong> Binding Type: </strong>" . $row['BindingType'] . "</br>";
    echo "<strong> Trim Size: </strong>" . $row['TrimSize'] . "</br>";
    echo "<strong> Page Count: </strong>" . $row['PageCountEditorialEst'] . "</br></p>";
     echo "</div>";
     echo "</div>";
     echo "</div>";
       echo "<div class= 'mdl-grid mdl-cell mdl-cell--12-col' >";
     echo "<p><strong> Description: </strong>" . $row['Description'] . "</p>";
     echo "</div>";
   }
}

function listAuthors($isbnNumber) 
{

global  $authorData;

$result = $authorData->findBookAuthorDetailsByIsbn($isbnNumber);
 

  foreach($result as $row) 
{
  echo "<li>". $row['FirstName'] ." " .$row['LastName'] ."</li>";
   }
}

function listUniversities($isbnNumber) {
global  $universityData;

$result = $universityData-> findBookUniversityDetailsByIsbn($isbnNumber);

  foreach($result as $row) 

{
   echo "<li>" . "<a href=" . 'browse-universities.php?university=' . $row['UniversityID'] . ">" . 
                                $row['Name'] . "</a>" . "</li>" . "<br/>";
   }
   
}
?>