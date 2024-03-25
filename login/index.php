<?php
  session_start();
  $con = new mysqli_connect("intoed-arrows.000webhostap","id22003962_achref","sedzeedzff54684-I", "id22003962_myresto");
  if ($_SERVER['REQUEST_METHOD']=="POST"){
    $fname= mysqli_real_escape_string($con,$_POST['fname']);
    $lname= mysqli_real_escape_string($con,$_POST['lname']);
    $email= mysqli_real_escape_string($con,$_POST['email']);
    $password= mysqli_real_escape_string($con,$_POST['password']);
    $num = "select count(*) as total_rows from utilisateur";
    $result=mysqli_query($conn,$num);
    if (mysqli_num_rows($result) > 0) {
      // Fetch the row as an associative array
      $row = mysqli_fetch_assoc($result);
      $newId = $row['total_rows'];
    
    if(!empty(trim($fname)) && !empty(trim($lname)) && !is_numeric($email)){
      $query="insert into utilisateur(id,nom,prenom,email,pass,etat,is_admin) values($newId,$fname,$lname,$email,$password,0,0)";
      mysqli_query($con,$query);
      echo "<script>alert('Utilisateur ajouté avec succés')</script>";

    }
    else{
      echo "<script>alert('Veuillez remplir tous les champs correctement')</script>";
    }
  }

  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Gl-icious</title>
  </head>

  <body>
    <div class="welcome">
      <h1 id="welcome">
        Welcome to <span style="color: brown">GL-icious</span>
      </h1>
    </div>
    <div class="container" id="container">
      <div class="form-container sign-up">
        <form method="POST">
          <h1>Create Account</h1>

          <input type="text" placeholder="First Name" name="fname" />
          <input type="text" placeholder="Last Name" name="lname" />
          <input type="email" placeholder="Email" name="email"/>
          <input type="password" placeholder="Password" name="password"/>
          <button>Sign Up</button>
        </form>
      </div>
      <div class="form-container sign-in">
        <form>
          <h1>Sign In</h1>
          <input type="email" placeholder="Email" />
          <input type="password" placeholder="Password" />
          <button>Sign In</button>
        </form>
      </div>
      <div class="toggle-container">
        <div class="toggle">
          <div class="toggle-panel toggle-left">
            <h1>Welcome Back!</h1>
            <p>Enter your personal details to use all of site features</p>
            <button class="hidden" id="login">Sign In</button>
          </div>
          <div class="toggle-panel toggle-right">
            <h1>Don't have an account?</h1>
            <p>
              Register with your personal details to use all of site features
            </p>
            <button class="hidden" id="register">Sign Up</button>
          </div>
        </div>
      </div>
    </div>

    <script src="script.js"></script>
  </body>
</html>
