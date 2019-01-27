<?php
	session_start();
	if($_POST) {
		$SQL = new mysqli("127.0.0.1", "root", "", "meme");

		$username = $SQL->real_escape_string($_POST["username"]);
		$password = hash("sha256", $_POST["pass"]);

		$res = $SQL->query("SELECT * FROM users WHERE name = '".$username."' AND password = '".$password."'")->fetch_array(MYSQLI_ASSOC);
		if($res) {
			echo "*ok*";
			$_SESSION["user"] = array(
				"id" => $res["id"],
				"name" => $res["name"]
			);
		} else {
			echo "Invalid Username or Password";
		}
	}
?>