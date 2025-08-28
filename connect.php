<?php
// mysql_connect
// mysqli_connect
// PDO
$con = mysqli_connect('localhost','root','','crudoperation');
// var_dump($con);
if(!$con){
//     echo "Connection Successfull";
// }
// else{
//     // echo "Connection Failed !";
    die("Connection Failed!".mysqli_connect_err());
}


?> 

