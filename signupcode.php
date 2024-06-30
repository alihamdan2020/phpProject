<?php
session_start();

if(empty($_POST['username']))
die ("your name is empty");   
// note that : ignore every thing after execution of die, if your name is empty, is execute the die then it is stop

if(! filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
//if (your eamil is not valid)
die ("your email is not valid");

if(strlen($_POST['password'])<8)
die ("your password must be at least 8 characters");

if(! preg_match("/[a-z]/i",$_POST['password']))
//if(your password does not contains at leat 1 characters[the "i" mean small or cappital])
// if you want your password contain only small letters you remove i from pattern/
die("your password must have at least 1 character");

if(! preg_match("/[0-9]/",$_POST['password']))
//if(your password does not contains at leat 1 digit)
die("your password must have at least 1 digit");

if(! preg_match("/[^a-zA-Z0-9]/",$_POST['password']))
//if(your password does not contains at leat 1 digit)
die("your password must have at least 1 special character");





if($_POST['password']!==$_POST['confirm_password'])
die("your paswords does not match");

echo "<pre>";
print_r($_POST); //this line return all the form's contents
echo "</pre>";

$hash_password=password_hash($_POST['password'],PASSWORD_BCRYPT);

// var_dump($hash_password);


$myconn=require __DIR__."/database.php";
//since ["/database.php"] has a return value $conn, so the value of require is the return value
// $myconn get the return value from require __DIR__."/database.php"

//must be 2 underscore DIR 2 underscore, DIR mean directory or the full path of your project
// echo __DIR__."/database.php";

$sql="insert into users (name,email,password_hash) values (?, ?,?)";

// $stmt mean statement
$stmt=mysqli_prepare($myconn,$sql);
mysqli_stmt_bind_param($stmt, "sss", strip_tags($_POST['username']),strip_tags($_POST['email']),$hash_password);

//strip_tags to remove the html tags [kind of security]
// i can replace codes above with hte code below, but code below is able for SQL injection
// $uname=$_POST['username'];
// $mail=$_POST['email'];
// mysqli_query($myconn, "insert into users (name,email,password_hash) values ('$uname','$mail','$hash_password')");
// echo "execute";

// sss mean we have 3 string parameters, if we have integer variable, we set i, if date also we set s 

//include the page that contains the function check_if_exist
require "checkMail.php";

$existEmail=check_if_exist($myconn,$_POST['email']);

if($existEmail>0)
echo "this email already exist";
else
if (mysqli_stmt_execute($stmt)) {
    header("Location: signupSuccess.html");
    //location: do not make space between location and :
    exit;
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}
