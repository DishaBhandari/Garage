<?php 

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("Location: ../index.php");
    exit;
}

include '../../database/db_connection.php';

if(isset($_POST['submit']))
{   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      if (!empty($_POST['email'])&&!empty($_POST['password'])&&!empty($_POST['cpassword'])&&!empty($_POST['captcha'])) {
      
        if($_SESSION["vercode"]==$_POST['captcha']){

            $sql = "SELECT * FROM user_details WHERE email='$_POST[email]'";
            $result = mysqli_query($conn, $sql);        
            if (mysqli_num_rows($result)==0) {
              if($_POST['password']==$_POST['cpassword'])
              {
                  $username = $_POST['email'];
                  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  

                  $sql = "INSERT INTO user_details (email, password)
                  VALUES ('$username', '$password')";
                  if (mysqli_query($conn, $sql)) {
                      $succmsg  = "New record created successfully";
                    } else {
                      $errmsg = "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
              } else {
                $errmsg = "Password Mismatched!";
              }
            } else {
              $errmsg = "Email already exists!";
            }  
      } else {
          $errmsg = "Invalid Verification Code!";
      }    
      } else {
        $errmsg = "Please fill all fields!";
      }  
  }
}

?> 

<style>
  @media(max-width: 590px){
    .card{
      width:380px!important;
    }
    .row .card-container,  .row .card-container .card{
      margin-top:1rem!important;
      margin-bottom: 0!important;
    }

  }
  @media(max-width: 450px){
    .card{
      width:280px!important;
    }
    .row .card-container, .row .card-container .card {
      margin-top:0.5rem!important;
      margin-bottom: 0!important;
    }

  }

</style> 


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Register</title>
  </head>
  <body>

  <nav class="navbar navbar-expand navbar-light bg-light ">
  <div class="container">
    <a class="navbar-brand" href="../../index.php">Gyan Car Workshop</a>
    
    
    <!-- 
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item navbar-light">
          <a class="nav-link " aria-current="page" href="#">Home</a>
        </li>     
      </ul> -->
      <a class="nav-link float-right" href="login.php" style="color:black;">Login</a>
  </div>
</nav>



  <!-- Login  -->
    <div class="row">
      <div class="container card-container col-6 col-sm-12 col-12 my-5">
      <div class="card mx-auto  shadow p-3 mb-5 bg-body rounded" style="width: 540px;">
            <div class="card-header shadow-sm p-3 mb-3 bg-body rounded">
                <p class="h2 fw-light text-center">Register</p>
            </div>
            <div class="card-body">
              
          <?php 
            if(!empty($errmsg))
              {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.
                  $errmsg
                  . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
              }
          ?>  

          <?php 
            if(!empty($succmsg))
              {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.
                  $succmsg
                  . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
              }
          ?>  
                
          

            <form method="post" action="">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email </label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="example@gmail.com">               
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label" minlength="5" >Password</label>
                <input type="password" class="form-control" name="password" minlength="5" >
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label" > Confirm Password</label>
                <input type="password" class="form-control" name="cpassword" >
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12 my-2">
                <label class="checkbox-inline">Verification Code</label>
                &nbsp;&nbsp;<img src="captcha.php" >
              </div>
              <div class="col-md-6 col-sm-12 my-2">
              <input type="text" class="form-control" name="captcha" maxlength="5" placeholder= " Enter verification code">
              </div>               
            </div>
            <div class="d-grid gap-2 my-4">
            <input type="submit" class="btn btn-primary" name="submit" value="Register">
            </div>
            </form>

            </div>
        </div>
        
            
</div>
</div>
   </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>