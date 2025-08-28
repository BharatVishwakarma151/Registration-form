<?php 
include('connect.php');
$username_msg = "Username should be between 3 to 20 characters";
$email_msg = "Email is not valid";
$phone_msg = "Invalid phone number";
$place_msg = "Place should be between 3 to 30 characters";
$fill_msg = "All fields are required";
$error_msg = array();

$username = $email = $phone = $place = '';

if(isset($_POST['submit'])){
  // Removing spaces if any
  // $username = str_replace(" ","",$username);
  // $email = str_replace(" ","",$email);
  // $phone = str_replace(" ","",$phone);
  // $place = str_replace(" ","",$place);
    $username=htmlspecialchars($_POST['username']);
        $email=htmlspecialchars($_POST['email']);
        $phone=htmlspecialchars($_POST['phone']);
        $place=htmlspecialchars($_POST['place']);

        $username = trim($username);
    $email = trim($email);
    $phone = trim($phone);
    $place = trim($place);
      
  
  if(empty($username)|| empty($email)|| empty($phone)|| empty($place)){
    
    array_push($error_msg,$fill_msg);
  }
  else{
    if(strlen($username)<3 || strlen($username)>20){
      array_push($error_msg,$username_msg);
    }
    if(strlen($place)<3 || strlen($place)>30){
      array_push($error_msg,$place_msg);
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)|| !preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/',$email)){
      array_push($error_msg,$email_msg);
    } 
    if(!preg_match('/^[0-9]{10}+$/',$phone) || ctype_digit($phone)==false|| strlen($phone)!=10){
      array_push($error_msg,$phone_msg);
    }
    
  }
  if(empty($error_msg)){
    $check_query= "SELECT * FROM crud where username = '$username' OR email = '$email' OR phone = '$phone'";
    $check_result = mysqli_query($con,$check_query);
    if($check_result){
      if(mysqli_num_rows($check_result)>0){
        $existing_data= mysqli_fetch_assoc($check_result);
        if($existing_data['email'] === $email){
          $email_msg = "Email already exists";
          array_push($error_msg, $email_msg);
          }
         if ($existing_data['username'] === $username) {
           $username_msg = "Username already exists";
           array_push($error_msg, $username_msg);
          # code...
         }
          if($existing_data['phone'] === $phone){
            $phone_msg = "Phone number already exists";
            array_push($error_msg, $phone_msg);
          }
    }
    else{
      if(empty($error_msg)){
      
        // $username = ucwords(strtolower($username));
        $place = ucwords(strtolower($place));

        $username = mysqli_real_escape_string($con,$username);
        $email = mysqli_real_escape_string($con,$email);
        $phone = mysqli_real_escape_string($con,$phone);
        $place = mysqli_real_escape_string($con,$place);
        
  
        $insert_query="insert into `crud` (username,email,phone,address) values ('$username','$email','$phone','$place') ";
          $result=mysqli_query($con,$insert_query);
          if($result){
              echo "<script>alert('Data inserted successfully')</script>";
            echo "<script>window.open('index.php','_self')</script>";
          }else{
              die(mysqli_error($con));
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
    <meta name="viewport" content="width=device-width, initial-scale=0.9" />
    <title>PHP - CRUD Operation</title>
    <link rel="stylesheet" href="style.css" />
    <style>
         
    .form_container form fieldset input[name="email"],
    .form_container form fieldset input[name="username"],
    .form_container form fieldset input[name="phone"], 
    .form_container form fieldset input[name="place"]{
        width: 90%;
        margin-bottom: 12px;
        background: rgba(0, 0, 0, 0.4);
        outline: none;
        padding: 8px;
        font-size: 14px;
        color: #fff;
        border: 1px solid rgba(0, 0, 0, 0.3);
        border-radius: 5px;
          box-shadow: inset 0 -5px 45px rgba(209, 71, 71, 0.4), 0 1px 1px rgba(255, 255, 255, 0.2);
        transition: box-shadow 0.5s ease;
    }
     .error_messages {
        color: rgb(251, 70, 70);
        font-size: 14px;
        display: inline;
        margin-bottom: 10px;
    }
      .form_container form fieldset input[name="email"],
    .form_container form fieldset input[name="username"],
    .form_container form fieldset input[name="phone"],
    .form_container form fieldset input[name="place"], :focus {
        box-shadow: inset 0 -5px 45px rgba(147, 140, 140, 0.2), 0 1px 1px rgba(123, 116, 116, 0.2);

      
    }
    </style>
  </head>
  <body>
    <div class="form_container">
      <form action='' method='post'>
        <fieldset>
          <legend>Personal Details</legend>
          <?php if(in_array($fill_msg,$error_msg)){
        echo '<span class="error_messages" id= "all_fields_error" >'.$fill_msg.'</span>';
      }
      ?>
          <label for="username"></label>
          <span>Name <span class="required">*</span></span
          ><input
          class="input_fields"
            type="text"
            placeholder="Enter your Username"
            autocomplete="off"
            name="username"
            value = "<?php echo $username; ?>"
          />
          <?php if(in_array($username_msg,$error_msg)){
        echo '<span class="error_messages">'.$username_msg.'</span>';
      }
      ?>

          <label for="email"></label>
          <span>Email <span class="required">*</span></span
          ><input
             class="input_fields"
            type="email"
            placeholder="Enter your Email"
            autocomplete="off"
            name="email"
             value = "<?php echo $email; ?>"
          />
          <?php if(in_array($email_msg,$error_msg)){
        echo '<span class="error_messages">'.$email_msg.'</span>';
      }
      ?>

          <label for="phone"></label>
          <span>Phone <span class="required">*</span></span
          ><input
          class="input_fields"
            type="number"
            placeholder="Enter your Mobile"
            autocomplete="off"
            name="phone"
             value = "<?php echo $phone; ?>"
          />
          <?php if(in_array($phone_msg,$error_msg)){
        echo '<span class="error_messages">'.$phone_msg.'</span>';
      }
      ?>

          <label for="place"></label>
          <span>Place <span class="required">*</span></span
          ><input
          class="input_fields"
            type="text"
            name="place"
            placeholder="Enter your Place"
            autocomplete="off"
            name="place"
             value = "<?php echo $place; ?>"
          />
          <?php if(in_array($place_msg,$error_msg)){
        echo '<span class="error_messages">'.$place_msg.'</span>';
      }
      ?>

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
    
    </body>
<script>
  document.addEventListerner('DOMContentLoaded',function(){
    const errorMessages = document.querySelectorAll('.error_messages');
    const inputFields = document.querySelectorAll('.input_field');
    // const btn = document.querySelector('.btn');
    // const form = document.querySelector('form');
    // const userEmailError = doccument.querySelector('.user_email_error');
    
    const allFieldsError = document.getElementById('all_fields_error');

    inputFields.forEach((inputField)=>{
      inputField.addEventListener('focus',()=>{
     if(allFieldsError){
      allFieldsError.textContent = '';
        }
        
        const errorSpan = this.nextElementSibling ;
        if(errorSpan.textContent && errorSpan.classList.contains(errorMessages)){
          errorSpan.textContent = '';
        }
      });

    });
  });

</script>
  </html>

   <?php include "./includes/footer.php"?>
