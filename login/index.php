<?php
session_start();
$serveur = 'localhost';
$utilisateur = 'root';
$motdepasse = '';
$base_de_donnees = 'if0_36253541_glicious';
$con = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

if ($con->connect_error) {
  die("Erreur de connexion à la base de données : " . $connexion->connect_error);
}
$message = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['login_email']);
    $password = mysqli_real_escape_string($con, $_POST['login_password']);

    $query = "SELECT id, email, pass,etat,is_admin FROM utilisateur WHERE email='$email'";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);


    if ($user && password_verify($password, $user['pass'])) {
      $_SESSION['user_id'] = $user['id'];
      if ($user['is_admin'] == 1) {
        header("Location: ../Admin/admin.php");
        exit;
      } else {
        if ($user['etat'] == 1) {
          header("Location: baned.php");
        } else {
        }
      }
    } else {

      $message  = '<div class="message-error">Email ou mot de passe incorrect</div>';
    }
  }


  if (isset($_POST['signup'])) {
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "SELECT id FROM utilisateur WHERE email='$email'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {

      $message = '<div class="message-error">Cet email est déjà utilisé</div>';
    } else {

      $query = "SELECT MAX(id) AS max_id FROM utilisateur";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_assoc($result);
      $newId = $row['max_id'] + 1;

      if (!empty(trim($fname)) && !empty(trim($lname)) && !empty(trim($email)) && !empty(trim($password))) {
        $query = "INSERT INTO utilisateur(id, nom, prenom, email, pass, etat, is_admin) VALUES ('$newId', '$fname', '$lname', '$email', '$hashedPassword', 0, 0)";
        if (mysqli_query($con, $query)) {
          $message = '<div class="message-success">Utilisateur ajouté avec succès</div>';
        } else {
          $message = '<div class="message-error">Erreur lors de l\'ajout de l\'utilisateur</div>';
        }
      } else {
        $message = '<div class="message-error">Veuillez remplir tous les champs correctement</div>';
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="logo.png" class="icone" />
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
        <input type="email" placeholder="Email" name="email" />
        <input type="password" placeholder="Password" name="password" />
        <button type="submit" name="signup">Sign Up</button>
        <div class="message"><?php echo $message; ?>
        </div>
      </form>
    </div>
    <div class="form-container sign-in">
      <form method="POST">
        <h1>Sign In</h1>
        <input type="email" placeholder="Email" name="login_email" />
        <input type="password" placeholder="Password" name="login_password" />
        <button type="submit" name="login">Sign In</button>
        <div class="message"><?php echo $message; ?>
        </div>
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