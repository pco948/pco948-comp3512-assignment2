 <?php 
 
function outputEmployeeAddresses($data)
{
  try
  {
     if(isset($_GET["employee"]))
     {
       $sql = "SELECT FirstName, LastName, Address, City, Region, Country, Postal, Email 
       FROM Employees 
       WHERE EmployeeID = :EmployeeID";
       $statement= $data->prepare($sql);
       $statement->bindValue(":EmployeeID", $_GET["employee"]);
       $statement->execute();
       $row = $statement->fetch();
       if ($statement->rowCount() == 0) { echo "Did not understand request!... try clicking on an employee from list";  }
      else {
       echo "<h3>" . $row['FirstName'] . " " .  $row['LastName'] . "</h3>";
       echo "<h6> Address: " . $row['Address'] . "</br>" ;
       echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
       echo $row['City'] . ", " .  $row['Region'] . ", " .  $row['Country'] . " " .  $row['Postal'] . "</br>" ;
       echo "Email: " . $row['Email'] . "</h6>";
 }
     }
     $data = null;
      }
  catch (PDOException $e)
  {
     echo "Did not understand request!... try clicking on an employee from list";
 }
}
  
function outputEmployeeToDoList($data)
{
  try 
   { 
    if(isset($_GET["employee"]))
    {
     $sql = "SELECT DATE_FORMAT(DateBy,'%Y-%M-%d') AS Date, Status, Priority, Description
     FROM EmployeeToDo 
     WHERE EmployeeID = :EmployeeID ORDER BY DateBy";
     $statement= $data->prepare($sql);
     $statement-> bindValue(":EmployeeID", $_GET["employee"]);
     $statement->execute();
     if ($statement->rowCount() == 0) { echo "Did not understand request!... try clicking on an employee from list";  }
    else {
     while ($row = $statement->fetch()) 
     {
     echo "<tr>";
     echo "<td style='text-align: left'>" . $row['Date'] . "</td>";
     echo "<td style='text-align: left'>" . $row['Status']   . "</td>";
     echo "<td style='text-align: left'>" . $row['Priority']   . "</td>";
     echo "<td style='text-align: left'>" . substr($row['Description'],0,40) . "..."  .  "</td>";
     echo "</tr>"; 
     }
      }
    }
   $data = null;
      }
    catch (PDOException $e)
    {
    echo "Did not understand request!... try clicking on an employee from list";
    }
     }
     
                            
function outputEmployeeMessages($data)
{
 try 
 {
  if(isset($_GET["employee"])){
    $sql = "SELECT FirstName, LastName, DATE_FORMAT(MessageDate,'%Y-%M-%d') as Date, Category, SUBSTRING(Content, 1, 40) as Content 
    FROM Employees, EmployeeMessages
    WHERE EmployeeMessages.EmployeeID = :EmployeeID AND EmployeeMessages.ContactID = Employees.EmployeeID
    ORDER BY MessageDate";
    $statement= $data->prepare($sql);
    $statement-> bindValue(":EmployeeID", $_GET["employee"]);
    $statement->execute();
    if ($statement->rowCount() == 0) { echo "Did not understand request!... try clicking on an employee from list";  }
 else {
    while ($row = $statement->fetch())
    {
    echo "<tr>";
    echo  "<td style='text-align: left'>" . $row['Date'] . "</td>";
    echo  "<td style='text-align: left'>" . $row['Category']   . "</td>";
    echo  "<td style='text-align: left'>" . $row['FirstName'] . " " . $row['LastName'] . "</td>";
    echo  "<td style='text-align: left'>" . substr($row['Content'],0,30) . "..."  . "</td>";
    echo "</tr>"; 
    }
      }
  }
     $data = null;
     }
   catch (PDOException $e)
   {
     echo "Did not understand request!... try clicking on an employee from list";
   }
     }
    ?>  
    
    
<div class="mdl-card__supporting-text">
 <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
    <div class="mdl-tabs__tab-bar">
        <a href="#address-panel" class="mdl-tabs__tab is-active">Address</a>
        <a href="#todo-panel" class="mdl-tabs__tab">To Do</a>
        <a href="#messages-panel" class="mdl-tabs__tab">Messages</a>
   </div>
 <div class="mdl-tabs__panel is-active" id="address-panel">
       <?php outputEmployeeAddresses($data); ?>

 </div>
<div class="mdl-tabs__panel" id="todo-panel">
     <table class="mdl-data-table  mdl-shadow--2dp">
      <thead>
      <tr>
      <th class="mdl-data-table__cell--non-numeric">Date</th>
      <th class="mdl-data-table__cell--non-numeric">Status</th>
      <th class="mdl-data-table__cell--non-numeric">Priority</th>
      <th class="mdl-data-table__cell--non-numeric">Content</th>
      </tr>
      </thead>
         <tbody>
           <?php outputEmployeeToDoList($data) ?>      
          </tbody>
       </table>
 </div>
                          
 <div class="mdl-tabs__panel" id="messages-panel">
  <table class="mdl-data-table  mdl-shadow--2dp">
    <thead>
      <tr>
       <th class="mdl-data-table__cell--non-numeric">Date</th>
       <th class="mdl-data-table__cell--non-numeric">Category</th>
       <th class="mdl-data-table__cell--non-numeric">From</th>
       <th class="mdl-data-table__cell--non-numeric">Message</th>
     </tr>
    </thead>
       <tbody>
          <?php outputEmployeeMessages($data) ?>      
      </tbody>
       </table>
    </div>
       </div>                         
           </div>    
  