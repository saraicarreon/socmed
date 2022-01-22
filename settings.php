<?php 
include("includes/header.php");
include("includes/form_handlers/settings_handler.php");
?>

<div>
<div class="main_column">
    <div class="profile-edittop">
	<h4 class="account_title">Account Settings</h4>
	<?php
	echo "<img src='" . $user['profile_pic'] ."' id='smaller_profile'>";
	?>
	</div>

	<br>
	<a href="upload.php"> </a> <br><br><br>


	<?php
	$user_data_query = mysqli_query($con, "SELECT first_name, last_name, email FROM users WHERE username='$userLoggedIn'");
	$row = mysqli_fetch_array($user_data_query);

	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$email = $row['email'];
	?>
	
	<div class="profile-edit">
	<form class="pass-form" action="settings.php" method="POST">
		First Name: 
		<br>
		<input type="text" name="first_name" value="<?php echo $first_name; ?>"><br>
		<br>
		Last Name: 
		<br>
		<input type="text" name="last_name" value="<?php echo $last_name; ?>"><br>
		<br>
		Email Address: 
		<br>
		<input type="text" name="email" value="<?php echo $email; ?>"><br>
		<br>
		<?php echo $message; ?>
	<div>

		<input type="submit" name="update_details" id="save_details" value="Update Details"><br>
	</form>

	<div class="profile-edit">
	<br>
	<br>
	<h4>Change Password</h4>
	<form action="settings.php" method="POST">
		Old Password: 
		<br>
		<input type="password" name="old_password" ><br>
		<br>
		New Password: 
		<br>
		<input type="password" name="new_password_1" ><br>
		<br>
		New Password Again: 
		<br>
		<input type="password" name="new_password_2" ><br>

		<?php echo $password_message; ?>

		<br>
		<input type="submit" name="update_password" id="save_details" value="Update Password"><br>
	</form>
	<div>

	<div class="profile-edit">
	<br>
	<br>
	<h4>Close Account</h4>
	<form action="settings.php" method="POST">
		<input type="submit" name="close_account" id="close_account" value="Close Account">
	</form>
	<div>


</div>
</div>