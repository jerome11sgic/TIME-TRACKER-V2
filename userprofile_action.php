<?php

//edit_profile.php
// session_start();
// if(!isset($_SESSION["type"])){
//   header("location:login.php");
// }
// include('database_config_dashboard.php');

// if($_POST['action']=='change_password')
// {
// 	$newPass =$_POST["user_new_password"];
// 	$conPass = $_POST["user_re_enter_password"];
// 	if($_POST["user_current_password"]!=''){
// 		$query = "SELECT user_password FROM user WHERE user_id = '".$_SESSION["user_id"]."' ";
// 		$statement = $connect->prepare($query);
// 		$statement->execute();
// 		$result = $statement->fetch(PDO::FETCH_ASSOC);

// 		$oldPass=$_POST["user_current_password"];
		
// 		if(password_verify($oldPass,$result['user_password'])){
			
// 			if($newPass==$conPass)
// 	{
		
// 		$query = "
// 		UPDATE user SET  
// 			user_password = '".password_hash($_POST["user_new_password"], PASSWORD_DEFAULT)."' 
// 			WHERE user_id = '".$_SESSION["user_id"]."'
// 		";

// 		//echo $query;
// 		$statement = $connect->prepare($query);
	

// 			if($statement->execute())
// 			{
// 				echo '<div class="alert alert-success">Password changed </div>';
// 			}
// 	}else{
// 		echo '<div class="alert alert-danger">New password and confirm password not match   </div>';
// 		}
// 	}else{
// 		echo '<div class="alert alert-danger">Please enter correct current password  </div>';
// 	}

// }
// }
include_once('includes/message.inc.php');
include_once('src/dbrepo.php');
include_once('src/UserProfile.dao.php');
include_once('src/message.php');
		// $first_name='kumar';
		// $last_name='jems';
		// $address='kuppilan';
		// $contact_number='07712345625';
		// $user_id=3;
// UserProfileDAO::editProfile($user_id,$first_name,$last_name,$address,$contact_number);
//UserProfileDAO::insertUserProfile($user_id,$first_name,$last_name,$address,$contact_number);
	// $user_id=1;
	// 	echo json_encode(UserProfileDAO::findProfilleById($user_id)); 
if (isset($_POST['action'])) {
	if($_POST['action']=='EDIT_PROFILE')
	{
		$first_name=trim($_POST["first_name"]);
		$last_name=trim($_POST["last_name"]);
		$address=trim($_POST["address"]);
		$contact_number=trim($_POST["contact_number"]);
		$user_id=trim($_POST["user_id"]);

		UserProfileDAO::editProfile($user_id,$first_name,$last_name,$address,$contact_number);
		
	}
	if($_POST['action']=='ADD_PROFILE'){
		$first_name=trim($_POST["first_name"]);
		$last_name=trim($_POST["last_name"]);
		$address=trim($_POST["address"]);
		$contact_number=trim($_POST["contact_number"]);
		$user_id=trim($_POST["user_id"]);

		UserProfileDAO::insertUserProfile($user_id,$first_name,$last_name,$address,$contact_number);

	}
	if ($_POST['action'] == 'FETCH_SINGLE')
	{
		$user_id=trim($_POST["user_id"]);
		echo json_encode(UserProfileDAO::findProfilleById($user_id)); 
	}
}


?>