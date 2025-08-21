<?php 
include('connect.php');
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    // echo $username;
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $place=$_POST['place'];

        $insert_query="insert into `crud` (username,email,phone,address) values ('$username','$email','$phone','$place') ";
        $result=mysqli_query($con,$insert_query);
        if($result){
            echo "<script>alert('Data inserted successfully')</script>";
          echo "<script>window.open('index.php','_self')</script>";
        }else{
            die(mysqli_error($con));
        }
    }  
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PHP - CRUD Operation</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="form_container">
      <form action='' method='post'>
        <fieldset>
          <legend>Personal Details</legend>
          <label for="username"></label>
          <span>Name <span class="required">*</span></span
          ><input
            type="text"
            placeholder="Enter your Username"
            autocomplete="off"
            name="username"
          />

          <label for="email"></label>
          <span>Email <span class="required">*</span></span
          ><input
            type="email"
            placeholder="Enter your Email"
            autocomplete="off"
            name="email"
          />

          <label for="phone"></label>
          <span>Phone <span class="required">*</span></span
          ><input
            type="text"
            placeholder="Enter your Mobile"
            autocomplete="off"
            name="phone"
          />

          <label for="place"></label>
          <span>Place <span class="required">*</span></span
          ><input
            type="text"
            name="place"
            placeholder="Enter your Place"
            autocomplete="off"
            name="place"
          />

          <input type="submit" class="submit_btn" name="submit" />

          <a href="display.php" class="view_data">Details</a>
          <a
            href="https://www.youtube.com/c/@BharatVishwakarma-z1d"
            class="view_data"
            target="_blank"
            >Channel</a
          >
        </fieldset>
      </form>
    </div>

   <?php include "./includes/footer.php"?>
