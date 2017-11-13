<?php
   
$data=startDatabase();
    
function startDatabase()
{
try
{
  $connstring="mysql:localhost=3306;dbname=book;charset=utf8";
  
  $user="root";
  $password="";


  $pdo = new PDO ($connstring, $user, $password);
  $pdo->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  return $pdo;
}
 
catch(PDOException $ex)
{
  die($ex->getMessage());
}
 }


function printAllBooks($data){
   try {
      $sql = "SELECT BookID, ISBN10, SUBSTRING(Title, 1, 57) as Title, CopyrightYear, SubcategoryName, Imprint 
      FROM Books, Subcategories, Imprints
      WHERE Imprints.ImprintID = Books.ImprintID
      AND Subcategories.SubcategoryID = Books.SubcategoryID
       ORDER BY Title LIMIT 20";
      $result = $data->query($sql);
      while ($row = $result->fetch()) {
       echo "<tr>";
       echo  "<td style='text-align: left'>" . "<img src='book-images/thumb/" . $row['ISBN10'] .".jpg'></td>";
      echo  "<td style='text-align: left'>" . "<a href=" . 'single-book.php?isbn=' .   $row['ISBN10'] . ">".  $row['Title']  . "</a>" . "</td>";
       echo  "<td style='text-align: left'>" . $row['CopyrightYear'] . "</td>";
      echo  "<td style='text-align: left'>" . $row['SubcategoryName'] . "</td>";
    echo  "<td style='text-align: left'>" . $row['Imprint']   . "</td>";
    echo "</tr>"; 
        }
         $data = null;
             }
       catch (PDOException $e){
         echo "Error";
             }
         }
                               
function printBooksSubcategoryFilter($data){
      try {
         $sql = "SELECT BookID, ISBN10, SUBSTRING(Title, 1, 57) Title, CopyrightYear, SubcategoryName, Imprint 
         FROM Books, Subcategories, Imprints
         WHERE Books.SubcategoryID = :SubcategoryID
         AND Imprints.ImprintID = Books.ImprintID
         AND Subcategories.SubcategoryID = Books.SubcategoryID
        ORDER BY Title LIMIT 20";
         $statement= $data->prepare($sql);
          $statement-> bindValue(":SubcategoryID", $_GET["subcategory"]);
          $statement->execute();
            while ($row = $statement->fetch()) 
            {
            echo "<tr>";
             echo  "<td style='text-align: left'>" . "<img src='book-images/thumb/" . $row['ISBN10'] .".jpg'></td>";
              echo  "<td style='text-align: left'>" . "<a href=" . 'single-book.php?isbn=' .   $row['ISBN10'] . ">".  $row['Title']  . "</a>" . "</td>";
              echo  "<td style='text-align: left'>" . $row['CopyrightYear'] . "</td>";
               echo  "<td style='text-align: left'>" . $row['SubcategoryName'] . "</td>";
                echo  "<td style='text-align: left'>" . $row['Imprint']   . "</td>";
              echo "</tr>"; 
               }
                  $data = null;
                   }
                   catch (PDOException $e){
                                    echo "Error";
                                 }
}

                               
function printBooksImprintFilter($data){
        try {
          $sql = "SELECT BookID, ISBN10, SUBSTRING(Title, 1, 57) as Title, CopyrightYear, SubcategoryName, Imprint 
           FROM Books, Subcategories, Imprints
            WHERE Books.ImprintID = :ImprintID
             AND Imprints.ImprintID = Books.ImprintID
             AND Subcategories.SubcategoryID = Books.SubcategoryID
             ORDER BY Title LIMIT 20";
          $statement= $data->prepare($sql);
          $statement-> bindValue(":ImprintID", $_GET["imprint"]);
         $statement->execute();
         while ($row = $statement->fetch()) 
         {
         echo "<tr>";
        echo  "<td style='text-align: left'>" . "<img src='book-images/thumb/" . $row['ISBN10'] .".jpg'></td>";
        echo  "<td style='text-align: left'>" . "<a href=" . 'single-book.php?isbn=' . $row['ISBN10'] . ">".  $row['Title']  . "</a>" . "</td>";
        echo  "<td style='text-align: left'>" . $row['CopyrightYear'] . "</td>";
         echo  "<td style='text-align: left'>" . $row['SubcategoryName'] . "</td>";
        echo  "<td style='text-align: left'>" . $row['Imprint']   . "</td>";
        echo "</tr>"; 
            }
            $data = null;
     }
         catch (PDOException $e){
         echo "Error";
         }
}



function printSubcategoryDropdown($data){
        $sql = "SELECT SubcategoryID, SubcategoryName FROM Subcategories ORDER by SubcategoryName";
        $result = $data->query($sql);
        while ($row = $result->fetch()) {  
         echo "<option value=" . $row['SubcategoryID'] . ">" . $row['SubcategoryName'] . "</option>";
              }
       $data = null;
}

function printImprintDropdown($data){
     $sql = "SELECT ImprintID, Imprint FROM Imprints ORDER by Imprint";
      $result = $data->query($sql);
       while ($row = $result->fetch()) {
          echo "<option value=" . $row['ImprintID'] . ">" . $row['Imprint'] . "</option>";
                                 }
                                 $data = null;
}

function printBookChecker($data) 
{
      if(isset($_GET["subcategory"]) || isset($_GET['imprint']))
      {
       if($_GET["subcategory"] == "all" || $_GET["imprint"] == "all" )  {   printAllBooks($data); }
                       
         else if(isset($_GET["subcategory"])) { printBooksSubcategoryFilter($data); }
         
          else if(isset($_GET["imprint"])){ printBooksImprintFilter($data);   }
          
            else if($_GET["subcategory"] == " " || $_GET["imprint"] == " " )  {echo "Try filtering by subcategory or imprints";}
      }  
      else { printAllBooks($data); }
               
}


?>
     
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Browse Books</title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <link rel='stylesheet prefetch' href='https://cdn.rawgit.com/kybarg/mdl-selectfield/mdl-menu-implementation/mdl-selectfield.min.css'>
    <link rel="stylesheet" href="css/styles.css">
    
    <script   src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <script src='https://cdn.rawgit.com/kybarg/mdl-selectfield/mdl-menu-implementation/mdl-selectfield.min.js'></script>e
</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    
<main class="mdl-layout__content mdl-color--grey-50">
   <section class="page-content">

    <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
    <div class="mdl-card__title mdl-color--orange">
     <h2 class="mdl-card__title-text">Books</h2>
       </div>
      <div class="mdl-card__supporting-text">
     <div class="mdl-grid">
      <div class="mdl-card__title ">
      <form method="GET" action="browse-books.php">  
       <h5>Filter by Subcategory</h5>
        <div class="mdl-selectfield mdl-js-selectfield"> 
         <select class="mdl-selectfield__select" id="subcategory" name="subcategory">
         <option value=""></option>
          <option value="all">All Subcategories </option>
           <?php  printSubcategoryDropdown($data); ?> 
           </select>
           <label class="mdl-selectfield__label" for="subcategory">Subcategories</label>
              </div>
           <button class="mdl-button mdl-js-button mdl-button--accent" type="submit"> Search </button> 
            </div> 
         </form>

 <div class="mdl-card__title">
  <form method="GET" action="browse-books.php">  
    <h5>Filter by Imprint</h5>
   <div class="mdl-selectfield mdl-js-selectfield"> 
    <select class="mdl-selectfield__select" id="imprint" name="imprint">
   <option value=""></option>
    <option value="all">All Imprints </option>
      <?php  printImprintDropdown($data);   ?> 
      </select>
       <label class="mdl-selectfield__label" for="imprint">Imprints</label>
        </div>
        <button class="mdl-button mdl-js-button mdl-button--accent" type="submit"> Search </button> 
    </div>
   </form>
    
</div>
    
 <table class="mdl-data-table  mdl-shadow--2dp">
  <thead>
  <tr>
  <th class="mdl-data-table__cell--non-numeric">Cover</th>
  <th class="mdl-data-table__cell--non-numeric">Title</th>
  <th class="mdl-data-table__cell--non-numeric">Year</th>
  <th class="mdl-data-table__cell--non-numeric">Subcategory</th>
  <th class="mdl-data-table__cell--non-numeric">Imprint</th>
  </tr>
  </thead>
  <tbody>
      <?php  printBookChecker($data);  ?>
    </tbody>
    </table>
  </div>
  </div> 
</div> 
</section>
</main>    
</div>   
</body>
</html>