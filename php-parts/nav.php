<?php
	if(session_status() == PHP_SESSION_NONE) {
		session_start();
	}
?>
<div id="nav">
    <div class="ui container">
      <div class="ui large secondary inverted pointing menu" id="nananananavman">
        <a class="toc item">
          <i class="sidebar icon"></i>
        </a>
         <a class="active item">Home</a>
        <a class="item" >What is this?</a>
        <a class="item" >What does the internet say?</a>
        <a class="item" >Meme Blog</a> 
        <div class="right item">
          <?php
          	if(!isset($_SESSION["user"])) {
          		echo "<a class=\"ui inverted violet button\" onclick=\"$('#loginModal').modal({blurring: true}).modal('show'); return false;\">Log in</a><a class=\"ui inverted blue button\">Sign Up</a>";
          	} else {
          		echo "<button class=\"ui left labeled icon button\"><i class=\"left cart icon\"></i>Checkout</button><button class=\"ui inverted red button\" onclick=\"$.get('backend/logout.php').done(function() { $('#nav').load('php-parts/nav.php'); });\">Logout</button>";
          	}
          ?>
        </div>
      </div>
    </div>
</div>