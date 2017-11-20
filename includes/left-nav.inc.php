  <? session_start(); ?>
  <div class="mdl-layout__drawer mdl-color--blue-grey-800 mdl-color-text--blue-grey-50">
       <div class="profile">
           <img src="images/avatar_small.png" class="avatar">
           
           <!--Echoes session variables for the user.-->
           <h3><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></h3>           
           <span><?php echo $_SESSION['email'];?></span>
       </div>

    <nav class="mdl-navigation mdl-color-text--blue-grey-300">
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="index.php"><i class="material-icons" role="presentation">dashboard</i> Dashboard</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="browse-employees.php"><i class="material-icons" role="presentation">supervisor_account</i> Employees</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="browse-books.php"><i class="material-icons" role="presentation">view_list</i> Books</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="browse-universities.php"><i class="material-icons" role="presentation">account_balance</i> Universities</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="analytics.php"><i class="material-icons" role="presentation">insert_chart</i> Analytics</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="aboutus.php"><i class="material-icons" role="presentation">feedback</i> About</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="user-profile.php"><i class="material-icons" role="presentation">person</i> User Profile</a>
    </nav>
  </div>