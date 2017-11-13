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


function outputEmployeeList($data)
{

      $sql = "select EmployeeID, FirstName, LastName from Employees order by LastName";
              $result = $data->query($sql);
              while ($row = $result->fetch()) {
                 echo "<li>" . "<a href=" . 'browse-employees.php?employee=' . $row['EmployeeID'] . ">" . 
                $row['FirstName'] . " " . $row['LastName'] . "</a>" . "</li>" . "<br/>";
}
 }
 
 function outputEmployeeDetailsTabs($data)
 {
   try 
   {
if(isset($_GET["employee"])) {
      if(empty($_GET["employee"])){ echo "<p> No employee found!... try clicking on a employee from list </p>"; }
        else { include 'includes/employee-details-tabs.inc.php';  }
          }elseif(!isset($_GET["employee"])){
            echo "<p> Try clicking on a employee from the list </p>";
        }
      }
    catch (PDOException $e){ echo "Error";   }

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
              <div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Employees</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">
                         <?php outputEmployeeList($data) ?> 
                    </ul>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->
              
              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--9-col card-lesson mdl-card  mdl-shadow--2dp">

                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Employee Details</h2>
                    </div> 
                       <?php outputEmployeeDetailsTabs($data) ?>
              </div>  <!-- / mdl-cell + mdl-card -->   
            </div>  <!-- / mdl-grid -->    

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>