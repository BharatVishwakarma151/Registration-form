<?php
include_once "connect.php";
// var_dump($_POST);
// echo "<br>".$_POST["username"];
if (isset($_POST['submit'])) {
    
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $place = $_POST["place"];
    // echo $place;
    $insert_query = "INSERT INTO crud (username, email, phone, place) VALUES ('$username','$email','$phone','$place')";
    $result = mysqli_query($conn,$insert_query);
    if ($result) {
            echo  "<script>alert('Data inserted Successfully !');</script>
              ";
          echo   "<script>window.open('index.php','_self')</script>";
        
    }
    else{
        die(mysqli_error($result));
    }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" 
          content="width=device-width, 
                   initial-scale=1,
                   shrink-to-fit=no" />
    <link rel="stylesheet" 
          href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <title>Bootstrap Form</title>
</head>

<body>
    <h1 class="text-success text-center">
        Submission Form
    </h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form id="registrationForm" action="" method= "post">
                            <div class="form-group">
                                <label for="name">
                                    Name
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="name" 
                                       name = "username"
                                       placeholder="Abc Pqr" required />
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Email
                                </label>
                                <input type="email" 
                                       class="form-control" 
                                       id="email" 
                                       name = "email"
                                       placeholder="abc@example.com" required />
                            </div>
                            <div class="form-group">
                                <label for="phone">
                                    Phone
                                </label>
                                <input type="number" 
                                       class="form-control" 
                                       id="phone"
                                       name = "phone" 
                                       placeholder="9876543210" required />
                            </div>
                            <div class="form-group">
                                <label for="address">
                                    Address
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="address" 
                                       placeholder=""
                                       name= "place"
                                    required />
                            </div>
                            <button class="btn btn-danger" name="submit">
                               Submit
                            </button>
                            <button class="btn btn-danger" name="details" style = "background-color: #74992e;">
                               <a href="display.php" <?php echo "style = 'color: white; text-decoration: none; '"?>>Details</a>
                            </button>
                        </form>
                        <!-- <p class="mt-3">
                            Not registered?
                            <a href="#">Create an
                                account</a>
                        </p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>