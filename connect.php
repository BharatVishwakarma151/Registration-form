<?php
// mysql_connect
// mysqli_connect
// PDO
$conn = mysqli_connect('localhost','root','','login');
// var_dump($conn);
if(!$conn){
//     echo "Connection Successfull";
// }
// else{
//     // echo "Connection Failed !";
    die("Connection Failed!".mysqli_connect_err());
}

?> 