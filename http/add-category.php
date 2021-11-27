<?php
session_start();

# If the admin is logged in
if (
  isset($_SESSION['user_id']) &&
  isset($_SESSION['user_email'])
) {
  include "../db_conn.php";
    /** 
	  check if author  name is submitted
	**/
	if (isset($_POST['category_name'])) {
		/** 
		Get data from POST request 
		and store it in var
		**/
		$name = $_POST['category_name'];

		#simple form Validation
		if (empty($name)) {
			$em = "The Category name is required";
			header("Location: ../Add-Category.php?error=$em");
            exit;
		}else {
			# Insert Into Database
			$sql  = "INSERT INTO categorys (name)
			         VALUES (?)";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$name]);

			/**
		      If there is no error while inserting the data
		    **/
		     if ($res) {
		     	# success message
		     	$sm = "Successfully created!";
				header("Location: ../Add-Category.php?success=$sm");
	            exit;
		     }else{
		     	# Error message
		     	$em = "Unknown Error Occurred!";
				header("Location: ../Add-Category.php?error=$em");
	            exit;
		     }
		}
	}else {
      header("Location: ../admin.php");
      exit;
	}

}else{
  header("Location: ../login.php");
  exit;
}






