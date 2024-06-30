<?php
    // $myconn=require __DIR__ ."/database.php";
function check_if_exist($con,$mail){
    $sql="select * from users where email = ?";
    $stmt=mysqli_prepare($con,$sql);
    mysqli_stmt_bind_param($stmt,"s",$mail);
    mysqli_stmt_execute($stmt);
    // At this point [above], the query is sent to the database for execution.
    mysqli_stmt_store_result($stmt);
    //line above it is as the result of line number 7, the result of execution
    return mysqli_stmt_num_rows($stmt);
    
}




// $sql="select * from users";
// $result = mysqli_query($myconn, $sql);
// if we have no parameters we dont use the statment
?>


