<div class="ui basic modal" id="loginModal">
	<div class="ui icon header">
		<i class="users icon"></i>
		Sign In
	</div>

	<form action="login.php" method="post" id="loginForm">
		<div class="content">
			<div class="ui center aligned inverted segment">
				<div class="ui horizontal inverted divider"></div>
				<div class="ui inverted transparent left icon input">
					<input type="text" placeholder="Username" name="username">
					<i class="user icon"></i>
				</div>
				<div class="ui horizontal inverted divider"></div>
				<div class="ui inverted transparent left icon input">
					<input type="text" placeholder="Password" name="pass">
					<i class="key icon"></i>
				</div>
				<div class="ui horizontal divider"></div>
				<div class="ui violet inverted button" onclick="document.getElementById('loginForm').submit();">Sign in</div>
				<div class="ui red inverted button" onclick="document.getElementById('loginForm').reset(); $('#loginModal').modal('hide');">Cancel</div>
			</div>
		</div>
	</form>
</div>