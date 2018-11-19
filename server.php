<?php
session_start();

$username = "";
$email    = "";
$errors = array(); 


$db = mysqli_connect('localhost', 'root', '', 'test');


if (isset($_POST['reg_user'])) {

  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  if (count($errors) == 0) {
  	$password = md5($password_1);

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}
	else {
  		array_push($errors, "Wrong username or password combination");
  	}
	
  }
	
}

if (isset($_POST["username"]) && isset($_POST["password"]))

    {


        if (!isset($_SESSION["attempts"]))

            $_SESSION["attempts"] = 0;
             

        if ($_SESSION["attempts"] < 3)

        {

            $username = $_POST["username"];

            $password = $_POST["password"];

             

            if ($username = "test" && $password == "test")

            {

                echo "Hello, you are logged in.";

            }

            else

            {

                echo "You failed to log-in, try again";

                $_SESSION["attempts"] = $_SESSION["attempts"] + 1;

            }

             

        }

        else

        {

            echo "You've failed too many times. Try again later";
		
        }
    }




     

  
	?>
<!--/*if(isset($_SESSION['num_login_fail']))
{
  if($_SESSION['num_login_fail'] == 3)
   {
     if(time() - $_SESSION['last_login_time'] < 10*60*60 ) 
      {
         // alert to user wait for 10 minutes afer
          return; 
      }
      else
      {
        //after 10 minutes
         $_SESSION['num_login_fail'] = 0;
      }
   }      
}


if($success)
{
   $_SESSION['num_login_fail'] = 0;
   //your code here
}
else
{
 $_SESSION['num_login_fail'] ++;
 $_SESSION['last_login_time'] = time();
}*/
--!>