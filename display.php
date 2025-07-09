<?php 
 include 'connect.php';
 ?>

<!doctype html>
<html lang='en'>
  <head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
   <style>
    table{
        width: 100vw;
        /* height: 55vh; */
        box-shadow: 20px 20px 20px  grey;
    }
    #heading{
        text-align:center;
        margin: 2rem;
    }
   </style>
   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg>
  
  </head>
  <body>
    <h4 id= 'heading'> DISPLAY STUDENT DETAILS</h4>
    <div class='container'>

        <table class='table table-striped'>
          <thead style= 'background-color: hsl(888 23% 22%); color:white;'>
            <tr>
              <th scope='col'>S.No.</th>
              <th scope='col'>Username</th>
              <th scope='col'>Email</th>
              <th scope='col'>Mobile</th>
              <th scope='col'>Address</th>
              <th scope='col'>DOS</th>
              <th scope='col'>Action</th>
            </tr>
          </thead>
          <tbody>
 <?php
 $select_query = 'SELECT * FROM `crud`;';
 $result = mysqli_query($conn,$select_query);
 if ($result) {
    
 // var_dump($result);

 while($row = mysqli_fetch_assoc($result)){
    // var_dump($row);
$id = $row['id'];
$username = $row['username'];
$email = $row['email'];
$mobile = $row['phone'];
$address = $row['place'];
$time = $row['date'];

echo "<tr>
              <th scope='row'>$id</th>
              <td>$username</td>
              <td>$email</td>
              <td>$mobile</td>
              <td>$address</td>
              <td>$time</td>
              <td>
                  <a href='update.php?update_id=$id' >
                  <img src='pencil-square.svg'/>
                  </a>  
                  <a href='delete.php?delete_id=$id'>
                  <img src = 'trash.svg'/>
                  </a>
              
              </td>
            </tr>";
}
 }
else{

    die(mysqli_query($conn,$select_query));
}
?>
            
          </tbody>
        </table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
  </body>
</html>