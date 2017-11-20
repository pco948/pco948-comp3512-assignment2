<?php
include('login-checker.php');  


require_once('includes/db-config.inc.php');
$dataGateway = new AnalyticsGateway($connection);



function printTop15Countries(){
    global $dataGateway;
    
      $result = $dataGateway->findTop15Countries(); 
          foreach($result as $row) {
               echo "<tr>";
               echo "<td class=" . 'mdl-data-table__cell--non-numeric' .">";
               echo $row["CountryName"] . "</td>";
               echo "<td>" . $row["count(BookVisits.CountryCode)"] . "</td>";
               echo "</tr>";
            
          }
}

function printTotalNumVisits(){
   global $dataGateway;
    
      $result = $dataGateway->findTotalNumVisits(); 
      echo $result["count(DateViewed)"];
}

function printUniqueCountries(){
  global $dataGateway;
  
    $result = $dataGateway->findUniqueCountries();
    echo $result["count(DISTINCT BookVisits.CountryCode)"];
}

function printTotalEmployeeToDo(){
   global $dataGateway;
  
    $result = $dataGateway->findTotalEmployeeToDo();
    echo $result["count(DateBy)"];
  
}

function printTotalEmployeeMessages(){
   global $dataGateway;
  
    $result = $dataGateway->findTotalEmployeeMessages();
    echo $result["count(MessageDate)"];
  
}

function printAdoptedBooks(){
    global $dataGateway;
    
    $result = $dataGateway->findAdoptedBooks();

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




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Analytics</title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <link rel='stylesheet prefetch' href='https://cdn.rawgit.com/kybarg/mdl-selectfield/mdl-menu-implementation/mdl-selectfield.min.css'>
    <link rel="stylesheet" href="css/styles.css">
      <link rel="stylesheet" href="css/searchbar.css">
    <script src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <script src='https://cdn.rawgit.com/kybarg/mdl-selectfield/mdl-menu-implementation/mdl-selectfield.min.js'></script>
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
     <h2 class="mdl-card__title-text">Analytics</h2>
       </div>
       
       <h2 class= "mdl-card__title-text" style ="padding-right:17px; padding-top:15px;">June 2017</h2>
    
        <div class="mdl-grid">
              <div class="mdl-grid mdl-cell mdl-cell--12-col mdl-cell--4-col-tablet mdl-card mdl-shadow--4dp">
       <div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp">

  <div class="mdl-card__actions ">  
         <header class="mdl-cell mdl-cell--6-col-desktop mdl-cell--2-col-tablet mdl-cell--4-col-phone mdl-color--deep-purple mdl-color-text--white">
              <i class="material-icons">group_add</i>
            </header>
              <div class="mdl-card__supporting-text">
                <h4>
                   <?php printTotalNumVisits(); ?>
                </h4> Total number of visits in June
              </div>
  </div>
</div>
<div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp">
  <div class="mdl-card__actions ">  
         <header class="mdl-cell mdl-cell--6-col-desktop mdl-cell--2-col-tablet mdl-cell--4-col-phone mdl-color--deep-purple mdl-color-text--white">
              <i class="material-icons">satellite</i>
            </header>
              <div class="mdl-card__supporting-text">
                <h4>
                <?php  printUniqueCountries(); ?>
                </h4> Total number of unique countries 
              </div>
  </div>
</div>
<div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp">
    <div class="mdl-card__actions ">  
         <header class="mdl-cell mdl-cell--6-col-desktop mdl-cell--2-col-tablet mdl-cell--4-col-phone mdl-color--deep-purple mdl-color-text--white">
              <i class="material-icons">assignment_ind</i>
            </header>
              <div class="mdl-card__supporting-text">
                <h4>
                   <?php  printTotalEmployeeToDo(); ?>  
                </h4> Total number of employees-to-dos in June 2017
              </div>
  </div>
 
</div>
<div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp">
   <div class="mdl-card__actions ">  
         <header class="mdl-cell mdl-cell--6-col-desktop mdl-cell--2-col-tablet mdl-cell--4-col-phone mdl-color--deep-purple mdl-color-text--white">
              <i class="material-icons">mail</i>
            </header>
              <div class="mdl-card__supporting-text">
                <h4>
                  <?php  printTotalEmployeeMessages(); ?>     
                </h4>  Total number of employee messages in June 2017
              </div>
  </div>
  </div>
</div>
</div>

<div class="mdl-grid">
     <div class="mdl-cell mdl-cell--5-col mdl-cell--4-col-tablet mdl-card mdl-shadow--4dp">
 <div class="mdl-card__title">
   <h2 class="mdl-card__title-text">Top 15 Countries</h2>
    </div>
     <div class="mdl-card__media">
 <a href="#"> <img class="article-image" src="" border="0" alt=""></a>
   </div>
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  <thead>
    <tr>
      <!-- class "mdl-data-table__cell--non-numeric", align values to left -->
      <th class="mdl-data-table__cell--non-numeric">Country Name</th>
      <th>Visitor Count</th>
      <th> </th>
    </tr>
  </thead>
  <tbody>
    
    <?php printTop15Countries(); ?>
    
  </tbody>
</table>
</div>
<div class="mdl-cell mdl-cell--7-col mdl-cell--4-col-tablet mdl-card mdl-shadow--4dp">
 <div class="mdl-card__title">
   <h2 class="mdl-card__title-text">Top 10 Adopted Books</h2>
    </div>
     <div class="mdl-card__media">
 <a href="#"> <img class="article-image" src="" border="0" alt=""></a>
   </div>
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  <thead>
    <tr>
      <!-- class "mdl-data-table__cell--non-numeric", align values to left -->
      <th class="mdl-data-table__cell--non-numeric">Book</th>
      <th>Title</th>
      <th>Quantity</th>
    </tr>
  </thead>
  <tbody>
    
    <!-- Row 1 -->
    <tr>
      <!-- class "mdl-data-table__cell--non-numeric", align values to left -->
      <td class="mdl-data-table__cell--non-numeric">Keyboard(backlit)</td>
      <td>10</td>
      <td>$50</td>
    </tr>
    
    <!-- Row 2 -->
    <tr>
      <!-- class "mdl-data-table__cell--non-numeric", align values to left -->
      <td class="mdl-data-table__cell--non-numeric">Mouse(wireless)</td>
      <td>22</td>
      <td>$25</td>
    </tr>
    
    <!-- Row 3 -->
    <tr>
      <!-- class "mdl-data-table__cell--non-numeric", align values to left -->
      <td class="mdl-data-table__cell--non-numeric">LED Display(1080p)</td>
      <td>56</td>
      <td>$113</td>
    </tr>
    
  </tbody>
</table>
    </div>
</div>
     </div>
</div> 
</section>

</main>    
</div>   
</body>
<script type="text/javascript" src="js/javascript.js"></script>
</html>

    
