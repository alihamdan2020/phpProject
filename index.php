
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

    <title>index page</title>
</head>
<body>
    <?php
session_start();
//in order to use session is this page
if (isset($_SESSION['userId']))
//isset mean $_SESSION["userId"] has a value
{
    $sql="select * from users where id = {$_SESSION['userId']}";
    $myconn=require "database.php";
    $result=mysqli_query($myconn,$sql);
    $data=[];
    while($row=mysqli_fetch_assoc($result)){
        $data[]=$row;
    }
    
    
?>
<h1>our are loged in</h1>
<p>your id is <?php echo $_SESSION['userId'] ?></p>
<p>your name is <?php echo($data[0]['name']) ?></p>
<p>do you want to <a href="logout.php">log out </a></p>
<?php
}
else
{
?>
   <a href="signup.html">sign up</a> <br>
   <a href="login.php">log in</a> 
<?php
}
?>
</body>
</html>