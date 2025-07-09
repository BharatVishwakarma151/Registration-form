<?php
require_once "connect.php";
//  var_dump($_GET);
//  echo $_GET['delete_id'];
if (isset($_GET['delete_id_'])) {
    $delete_id = $_GET['delete_id_'];
    // echo $delete_id;
    $delete_query = "DELETE FROM crud where id = $delete_id";
    
    $result = mysqli_query($conn,$delete_query);
    if ($result) {
          echo  "<script>alert('Record  deleted Successfully');</script>";
          echo  "<script>window.open('display.php','_self');</script>";
    }

    else {
        die(mysqli_query($result));
    }
}
else {
    die(mysqli_error($conn));
}
?>
