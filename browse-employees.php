<?php
include('login-checker.php');   


require_once('includes/db-config.inc.php');
$dataGateway = new EmployeesGateway($connection);



function outputEmployeeAddresses()
{
  try
  {
    
    global $dataGateway;

  if(isset($_GET["employee"])){
     
         $result = $dataGateway->findAddressByID($_GET["employee"]);

         
        foreach($result as $row) {
      
    // if ($statement->rowCount() == 0) { echo "Did not understand request!... try clicking on an employee from list";  }
    //  else {
       echo "<h3>" . $row['FirstName'] . " " .  $row['LastName'] . "</h3>";
       echo "<h6> Address: " . $row['Address'] . "</br>" ;
       echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
       echo $row['City'] . ", " .  $row['Region'] . ", " .  $row['Country'] . " " .  $row['Postal'] . "</br>" ;
       echo "Email: " . $row['Email'] . "</h6>";
 
     }
  }
   
      }
        catch (PDOException $e)
  {
     echo "Error";
 }
  }

function outputEmployeeToDoList()
{
   global $dataGateway;

  if(isset($_GET["employee"])){
     
         $result = $dataGateway->findEmployeeToDo($_GET["employee"]);
 
 foreach ($result as $row) {
 
     echo "<tr>";
     echo "<td style='text-align: left'>" . $row['date'] . "</td>";
     echo "<td style='text-align: left'>" . $row['Status']   . "</td>";
     echo "<td style='text-align: left'>" . $row['Priority']   . "</td>";
     echo "<td style='text-align: left'>" . substr($row['Description'],0,40) . "..."  .  "</td>";
     echo "</tr>"; 
 
      }
    }
}
   
     
                            
function outputEmployeeMessages()
{
    
     global $dataGateway;

  if(isset($_GET["employee"])){
     
           $result = $dataGateway->findEmployeeMessages($_GET["employee"]);
            
 foreach ($result as $row) {
    echo "<tr>";
    echo  "<td style='text-align: left'>" . $row['Date'] . "</td>";
    echo  "<td style='text-align: left'>" . $row['Category']   . "</td>";
    echo  "<td style='text-align: left'>" . $row['FirstName'] . " " . $row['LastName'] . "</td>";
    echo  "<td style='text-align: left'>" . substr($row['Content'],0,30) . "..."  . "</td>";
    echo "</tr>"; 
    }
      }
  }

     


 function outputEmployeeList()
{
    try {
        
   global $dataGateway;

    $result = $dataGateway->findAll($ASC);
        foreach($result as $row) {
             echo "<li>" . "<a href=" . 'browse-employees.php?employee=' . $row['EmployeeID'] . ">" . 
            $row['FirstName'] . " " . $row['LastName'] . "</a>" . "</li>" . "<br/>";
}

         }
   catch (PDOException $e){
        console.log("Error"); 
         }
}
 
 
 
 function outputEmployeeDetailsTabs()
 {
   try 
   {
if(isset($_GET["employee"])) {
      if(empty($_GET["employee"])){ echo "<p> No employee found!... try clicking on a employee from list </p>"; }
        else {
            
            
            include 'includes/employee-details-tabs.inc.php';  }
          }elseif(!isset($_GET["employee"])){
            echo "<p> Try clicking on a employee from the list </p>";
        }
      }
    catch (PDOException $e){ echo "Error";   }

 }
 
function printCityFilter(){
    
    global $dataGateway;
    $result = $dataGateway->findAllCities();
        foreach($result as $row) {
    
       echo "<option value=" . $row['City'] . ">" . $row['City'] . "</option>";
     }
}

function printEmployeesSubFilter(){
               
 global $dataGateway;
   try {
                            
    $last ="";
    $city ="";
    $keyword = $_GET['lastname'];
                            
        if($_GET["lastname"] != ""){
        $last = " AND LastName = :Lastname
        OR LastName LIKE :Lastname";
        }
     if(isset($_GET["city"]) && $_GET["city"] != "all"){
        $city = " AND City = :City ";
        }
      if(isset($_GET["city"]) && $_GET["city"] != "all" && $_GET["lastname"] != ""){
     
          $result = $dataGateway->findEmployeeCity($keyword . '%',$last,$city,$_GET["city"] ); 
      }
      elseif(isset($_GET["city"]) && $_GET["city"] != "all" && $_GET["lastname"] == ""){
          $result = $dataGateway->findEmployeeCityOnly($_GET["city"], $city);
      }
      else {
          $result = $dataGateway->findEmployeeNoCity($keyword . '%', $last); 
      }
         foreach($result as $row) {
        echo "<li>" . "<a href=" . 'browse-employees.php?employee=' . $row['EmployeeID'] . ">" . 
        $row['FirstName'] . " " . $row['LastName'] . "</a>" . "</li>" . "<br/>";
        }
        }
        catch (PDOException $e){
        echo "Incorrect query string";
        }
}

 
?>
 
     
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Browse Employees</title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/searchbar.css">
    
    <script   src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
       
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
   
    
</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">
            
            
            <div class="mdl-grid">
    
  
              <!-- mdl-cell + mdl-card -->
            <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">

   
   <button class="mdl-button mdl-button--raised mdl-button--colored" onclick="myFunction()">Click To Filter</button>
   
      
                    <div id="myDIV" class="mdl-cell mdl-cell--12-col mdl-color--deep-purple mdl-color-text--white">
                        
                         
                       <div class="mdl-card__title ">
                         <form method="GET" action="browse-employees.php">  
      <h5 class="mdl-color-text--white">Filter by Last Name</h5>
      <div class="mdl-selectfield mdl-js-selectfield"> 
      <input name="lastname"  type="text">
        <label class="mdl-selectfield__label" for="lastname"></label>
      </div>

  

                      
                      
       <h5 class="mdl-color-text--white">Filter by City</h5>
      
      <div class="mdl-selectfield mdl-js-selectfield"> 
     
        <select class="mdl-selectfield__select" id="city" name="city">
       
          <option value="all">All Cities </option>

            <?php  
                           printCityFilter();
                         ?> 
        </select>
        <label class="mdl-selectfield__label" for="city"></label>
      </div>
      <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored" type="submit">
  <i class="material-icons">search</i>

</button> 

  </form>
 </div> 
 </div>
     
                   </div> </div>
            <div class="mdl-grid">

              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Employees</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">
  
                         <?php
                       

                          if(isset($_GET["lastname"]) || isset($_GET['city'])){
                              if($_GET["lastname"] == "" && $_GET['city'] == "all")  {
                                 outputEmployeeList();
                              }

                             else if(isset($_GET["lastname"]) || isset($_GET['city'])){
                            
                                printEmployeesSubFilter();
                             }
                            

                        }
                        else {
                            outputEmployeeList();
                        }
                         
                         
                      
                         
                         ?> 
                    </ul>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->
              
              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--9-col card-lesson mdl-card  mdl-shadow--2dp">

                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Employee Details</h2>
                    </div> 
                       <?php outputEmployeeDetailsTabs() ?>
              </div>  <!-- / mdl-cell + mdl-card -->   
            </div>  <!-- / mdl-grid -->    

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
 <script type="text/javascript" src="js/javascript.js"></script>
</html>