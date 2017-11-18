<?php
include './includes/booksFunctions.inc.php';



function listUniversities() {
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
    


function listAuthors($isbnNumber) 
{

global  $authorData;

$result = $authorData->findBookDetailsByIsbn($isbnNumber);
 

  foreach($result as $row) 
{
  echo "<li>". $row['FirstName'] ." " .$row['LastName'] ."</li>";
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
        <?php   printBookDetails($_GET["isbn"]); 
       ?>
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
      <?php  listAuthors($_GET["isbn"]); ?>
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
      <?php listUniversities(); ?>
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
