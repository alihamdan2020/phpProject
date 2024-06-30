<?php

$is_valid=false;
//to check if submit the form
if($_SERVER['REQUEST_METHOD']==='POST')
{
    $myconn=require "database.php";
    $email=$_POST['email'];
    $sql="select * from users where email = '$email'";
    $result=mysqli_query($myconn,$sql);
    // print_r($result);
    $data=[];
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $data[] = $row;
    }
    if(count($data)==1)
    {          
    // mean this email exist, now let;s check the password
    if(password_verify($_POST['password'],$data[0]['password_hash']))
    // $data[0] because index 0 in the array
    {
        session_start();
        $_SESSION['userId']=$data[0]["id"];
        header("Location: index.php");
        exit;
        
    }
}
$is_valid=true;
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Document</title>
</head>
<body>
    <p>
        <?php
            if($is_valid===true):
        ?>

        <span style="color:red">invalid log in </span>
        <?php endif; ?>


    </p>
    <p>user name : jawad@hotmail.com</p>
    <p>password : 123456789A$</p>
    

<form action="" method="post">
    <div>
        <label for="email">email</label>
        <input type="email" name="email" id="email"  
        value="<?php echo $_POST['email'] ?? "" ?>">
        <!-- this mean keep the value of email inside textbox since onloading where form not submitted textbox display empty string -->
    </div>
    <div>
        <label for="password"></label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <button>log in</button>
    </div>
</form>    
</body>
</html>