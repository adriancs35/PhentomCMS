<?php
//Refuse direct access
if(!defined("PhentomCMS")){ exit; }

if (isset($_POST['rusername']) and isset($_POST['rpassword'])){
	if ($_POST['rpassword'] == $_POST['vpassword']){
		$username = $_POST['rusername'];
		$password = sha_password($username,$_POST['rpassword']);
		$mail = $_POST['email'];
	
		$mysqli -> select_db($acc_db);		
		$check = $mysqli -> query("SELECT * FROM 'accounts' WHERE login='".$username."'") or die($mysqli -> error); 
		$count = $check -> num_rows;
		
		if ($count > 0){
			echo "<p class='fail'>Username already exists.</p>";
		}
		else{ 
			$mysqli -> query("INSERT INTO 'accounts' ('login', 'encrypted_password', 'email', 'flags') VALUES ('".$username."','".$password."','".$email."',".$arcemu_expansion.")") or die($mysqli -> error);
			header("Location: ?page=register_success");
		}
	}
	else{
		echo "<p class='fail'>Password missmatch.</p>";
	}
}