<header class="mdl-layout__header">
		<div class="mdl-layout__header-row">
			<h1 class="mdl-layout-title"><span>CRM</span> Admin</h1>
			<div class="mdl-layout-spacer"></div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right">
				<label class="material-icons mdl-badge mdl-badge--overlap" data-badge="5" id="tt2">account_box</label>
				<div class="mdl-tooltip">
					Messages
				</div><label class="material-icons mdl-badge mdl-badge--overlap" data-badge="4" id="tt3">notifications</label>
				<div class="mdl-tooltip">
					Notifications
				</div><a href="../logout.php" id="tt4"><label class="material-icons" id="tt4">power_settings_new</label></a>
				<div class="mdl-tooltip">
					Log Out
				</div><label class="mdl-button mdl-js-button mdl-button--icon" for="fixed-header-drawer-exp" id="searchIcon" onclick="myFunctionSearch()"><i class="material-icons">search</i></label>
				<div class="mdl-textfield__expandable-holder inner-addon right-addon" id="search">
					<form action="browse-employees.php" method="get">
						<button class="mdl-button mdl-js-button mdl-button--icon" id="submitButton" type="submit"><i class="material-icons">done</i></button> <input class="mdl-textfield__input" id="fixed-header-drawer-exp" name="lastname" type="text">
					</form>
				</div>
			</div>
		</div>
	</header>