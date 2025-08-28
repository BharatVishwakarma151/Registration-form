<?php
include('connect.php');
$username_msg = "Username should be between 3 to 20 characters";
$email_msg = "Email is not valid";
$phone_msg = "Invalid phone number";
// $place_msg = "Place should be between 3 to 30 characters";
$fill_msg = "All fields are required";
$error_msg = array();

if(isset($_GET['update_id'])){
    $uid=$_GET['update_id'];
    /*selecting data from database table,so that we can display in input fields*/
    $select_query="Select * from `crud` where id=$uid";
    $result_query=mysqli_query($con,$select_query);
    $row=mysqli_fetch_assoc($result_query);
    $username=$row['username'];
    $email=$row['email'];
    $phone=$row['phone'];
    $place=$row['address'];

    $username = html_entity_decode($username);
$email = html_entity_decode($email);
$place = html_entity_decode($place);
$phone = html_entity_decode($phone);

    $username = trim($username);
    $email = trim($email);
    $phone = trim($phone);
    $place = trim($place);

    
    if(isset($_POST['update'])){
      $username_update=$_POST['username'];
      $email_update=$_POST['email'];
      $phone_update=$_POST['phone'];
      // echo $phone_update;
      $place_update=$_POST['address'];
      
      
      $username = $username_update;
     $email = $email_update;
     $phone = $phone_update;
     $place = $place_update;
     
    //  $username_update = ucwords(strtolower($username_update));
     $place_update = ucwords(strtolower($place_update));
     

      
      if(empty($username_update)|| empty($email_update)|| empty($phone_update)|| empty($place_update)){
      array_push($error_msg,$fill_msg);
    }
    else{
    if(strlen($username_update)<3 || strlen($username_update)>20){
      array_push($error_msg,$username_msg);
    }
    if(strlen($place_update)<3 || strlen($place_update)>30){
      array_push($error_msg,$place_msg);
    }
    if(!filter_var($email_update,FILTER_VALIDATE_EMAIL)|| !preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/',$email)){
      array_push($error_msg,$email_msg);
    } 
    if(!preg_match('/^[0-9]{10}+$/',$phone_update) || ctype_digit($phone_update)==false|| strlen($phone_update)!=10){
      array_push($error_msg,$phone_msg);
    }
    
 }
 if(empty($error_msg)){
  // $check_query= "SELECT * FROM WHERE id IS NOT $uid AND (SELECT * FROM crud where username = '$username_update' OR email = '$email_update' OR phone = '$phone_update')";
  $check_query = "SELECT * FROM crud
WHERE id <> $uid
  AND (username = '$username_update' 
       OR email = '$email_update' 
       OR phone = '$phone_update')";
            
             $check_result = mysqli_query($con,$check_query);
      // ...existing code...
      if(mysqli_num_rows($check_result)>0){
        while($existing_data = mysqli_fetch_assoc($check_result)){
              if($existing_data['email'] === $email_update){
                  $email_msg = "Email already exists";
                  array_push($error_msg, $email_msg);
              }
              if ($existing_data['username'] === $username_update) {
                  $username_msg = "Username already exists";
                  array_push($error_msg, $username_msg);
                }
              if($existing_data['phone'] === $phone_update){
                  $phone_msg = "Phone number already exists";
                  array_push($error_msg, $phone_msg);
              }
          }
      }
      // ...existing code...');

    else{
      if (empty($error_msg)) {
        $username_update=htmlspecialchars($username_update);
       $email_update=htmlspecialchars($email_update);
       $phone_update=htmlspecialchars($phone_update);
       $place_update=htmlspecialchars($place_update);
       
        $username_update = mysqli_real_escape_string($con,$username_update);
        $email_update = mysqli_real_escape_string($con,$email_update);
        $phone_update = mysqli_real_escape_string($con,$phone_update);
        $place_update = mysqli_real_escape_string($con,$place_update);
        
  
        /* updating new data inside database table*/
        $update_query="update `crud` set username='$username_update',email='$email_update',phone='$phone_update',address='$place_update' where id=$uid";
        $result_query=mysqli_query($con,$update_query);
        if($result_query){
            echo "<script>alert('Data updated successfully')</script>";
            echo "<script>window.open('display.php','_self')</script>";
        }
      }
    
    }
  }
 }
  }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update Data in PHP</title>
    <link rel="stylesheet" href="style.css" />
    <style>
            .error_messages {
            color: rgb(251, 70, 70);
            font-size: 14px;
            display: inline;
            margin-bottom: 10px;
        }
    </style>
  </head>
  <body>
    <div class="form_container">
      <form action='' method='post'>
        <fieldset>
          <legend>Edit Details</legend>
             <?php if(in_array($fill_msg,$error_msg)){
        echo '<span class="error_messages" id= "all_fields_error" >'.$fill_msg.'</span>';
      }
      ?>
          <label for="username">Username</label>
          <input type="text" name="username" value="<?php echo $username ?>"/>
            <?php if(in_array($username_msg,$error_msg)){
        echo '<span class="error_messages">'.$username_msg.'</span>';
      }
      ?>

          <label for="email">Email</label>
          <input type="email" name="email" value="<?php echo $email ?>"/>
            <?php if(in_array($email_msg,$error_msg)){
        echo '<span class="error_messages">'.$email_msg.'</span>';
      }
      ?>

          <label for="phone">Mobile</label>
          <input type="number" name="phone" value="<?php echo $phone ?>"/>
            <?php if(in_array($phone_msg,$error_msg)){
        echo '<span class="error_messages">'.$phone_msg.'</span>';
      }
      ?>

          <label for="place">Address</label>
          <input type="text" name="address"  value="<?php echo $place ?>"/>
          

          <input
            type="submit"
            class="submit_btn"
            name="update"
            value="Update"
          />
        </fieldset>
      </form>
    </div>
    <?php include "./includes/footer.php"?>
