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

function printBookDetails($data)
{
 try 
 {
$sql = "SELECT Title, BookID, ISBN10,ISBN13, CopyrightYear, SubcategoryName, Imprint,
         Status,BindingType, TrimSize, PageCountsEditorialEst, Description 
FROM Books
INNER JOIN Subcategories ON Subcategories.SubcategoryID = Books.SubcategoryID
INNER JOIN Imprints ON Imprints.ImprintID = Books.ImprintID
INNER JOIN BindingTypes ON BindingTypes.BindingTypeID = Books.BindingTypeID
INNER JOIN Statuses ON Statuses.StatusID = Books.ProductionStatusID
WHERE Books.ISBN10 = :ISBN10
ORDER BY Title LIMIT 20";
$statement= $data->prepare($sql);
$statement-> bindValue(":ISBN10", $_GET["isbn"]);
$statement-> execute();

if ($statement->rowCount() == 0) { echo "Did not understand request!... go back to book list";  }
else{
while ($row = $statement->fetch())
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
    echo "<strong> Imprint: </strong>" . $row['Imprint']   . "</br>";
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
    $data = null;
    }
 catch (PDOException $e)
 {
   echo "Error";
  }
}

function listUniversities($data) {
try 
 {
$sql = "SELECT Name, Universities.UniversityID
       FROM Universities
       JOIN Adoptions ON Adoptions.UniversityID = Universities.UniversityID
       JOIN AdoptionBooks ON AdoptionBooks.AdoptionID = Adoptions.AdoptionID 
       JOIN Books ON Books.BookID = AdoptionBooks.BookID
       WHERE Books.ISBN10 = :ISBN10
       ORDER BY Universities.Name ASC";

$statement= $data->prepare($sql);
$statement-> bindValue(":ISBN10", $_GET["isbn"]);
$statement-> execute();
while ($row = $statement->fetch())
{
   echo "<li>" . "<a href=" . 'browse-universities.php?university=' . $row['UniversityID'] . ">" . 
                                $row['Name'] . "</a>" . "</li>" . "<br/>";
   }
    $data = null;
    }
 catch (PDOException $e)
 {
   echo "Error";
  }
}
    


function listAuthors($data) {
    try 
 {
$sql = "SELECT FirstName, LastName 
       FROM Authors
       JOIN BookAuthors ON BookAuthors.AuthorId = Authors.AuthorID
       JOIN Books ON Books.BookID = BookAuthors.BookId 
       WHERE Books.ISBN10 = :ISBN10
       ORDER BY BookAuthors.Order";

$statement= $data->prepare($sql);
$statement-> bindValue(":ISBN10", $_GET["isbn"]);
$statement-> execute();
while ($row = $statement->fetch())
{
  echo "<li>". $row['FirstName'] ." " .$row['LastName'] ."</li>";
   }
    $data = null;
    }
 catch (PDOException $e)
 {
   echo "Error";
  }
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
    <link rel="stylesheet" href="css/styles.css">
    
    
    <script   src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    
</head>
<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    
  <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">
     <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
            <div class="mdl-card__title mdl-color--orange">
             <h2 class="mdl-card__title-text">Book Details</h2>
                </div>
      <div class="mdl-card__supporting-text">
      <div class="mdl-grid portfolio-max-width">
       <div class="mdl-grid mdl-cell mdl-cell--12-col mdl-cell--4-col-tablet mdl-card mdl-shadow--4dp">
        <?php   printBookDetails($data);  ?>
        </div>
      
 <div class="mdl-cell mdl-cell--6-col mdl-cell--4-col-tablet mdl-card mdl-shadow--4dp">
   <div class="mdl-card__title">
   <h2 class="mdl-card__title-text">List of Authors</h2>
    </div>
 <div class="mdl-card__media">
  <a href="#"> <img class="article-image" src="" border="0" alt=""></a>
     </div>
   <div class="mdl-card__supporting-text no-bottom-padding">
   <span>List of authors for the book </span>
   </div>
  <div class="mdl-card__supporting-text">
      <?php  listAuthors($data); ?>
  </div>
   </div>
   
<div class="mdl-cell mdl-cell--6-col mdl-cell--4-col-tablet mdl-card mdl-shadow--4dp">
 <div class="mdl-card__title">
   <h2 class="mdl-card__title-text">List of Universities</h2>
    </div>
  <div class="mdl-card__media">
 <a href="#"> <img class="article-image" src="" border="0" alt=""></a>
   </div>
    <div class="mdl-card__supporting-text no-bottom-padding">
   <span>List of universities that have adopted the book.</span>
     </div>
     <div class="mdl-card__supporting-text">
      <?php listUniversities($data); ?>
   </div>
   </div>
     </div>
    </div>
  </div>
 </div>  
 </section>
</main>    
</div>    
</body>
</html>
