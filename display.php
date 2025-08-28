<?php include('connect.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Display Data</title>
    <link rel="stylesheet" href="style.css?v1=a" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
  </head>
  <body>
    <h2>Display Student Details</h2>
    <div class="table_container">
      <table class="table">
      
    <?php
    $select_query="Select * from `crud`";
    $result=mysqli_query($con,$select_query);
    $i=1;
    if(mysqli_num_rows($result)>0){
      echo "  <thead>
      <tr>
        <th>Sl No</th>
        <th>Username</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Address</th>
        <th>DATETIME</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>";
       while( $row=mysqli_fetch_assoc($result)){
            $id=$row['id'];
            // echo $id;
            $id=$row['id'];
$username=$row['username'];
$email=$row['email'];
$phone=$row['phone'];
$place=$row['address'];
$datetime=$row['date'];

$username = html_entity_decode($username);
$email = html_entity_decode($email);
$place = html_entity_decode($place);
$phone = html_entity_decode($phone);



echo " <tr>
<td>$i</td>
<td>$username</td>
<td>$email</td>
<td>$phone</td>
<td>$place</td>
<td>$datetime</td>
<td>
<a href='update.php?update_id=$id'><i class='fa-solid fa-pen-to-square'></i></a>
<a href='delete.php?delete_id=$id'><i class='fa-solid fa-trash'></i></a>
</td>
</tr>";
$i++;
        }
      }
    else{
        echo "<h3 class='no_records'>No Records to display</h3>";
    }
?>          </tbody>
      </table>
    </div>
    <?php include "./includes/footer.php"?>

