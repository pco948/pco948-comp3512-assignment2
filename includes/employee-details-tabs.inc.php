<div class="mdl-card__supporting-text">
 <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
    <div class="mdl-tabs__tab-bar">
        <a href="#address-panel" class="mdl-tabs__tab is-active">Address</a>
        <a href="#todo-panel" class="mdl-tabs__tab">To Do</a>
        <a href="#messages-panel" class="mdl-tabs__tab">Messages</a>
   </div>
 <div class="mdl-tabs__panel is-active" id="address-panel">
             <?php outputEmployeeAddresses(); ?>

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
           <?php outputEmployeeToDoList($_GET['employee']); ?>      
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
          <?php //outputEmployeeMessages(); ?>      
      </tbody>
       </table>
    </div>
       </div>                         
           </div>    
  