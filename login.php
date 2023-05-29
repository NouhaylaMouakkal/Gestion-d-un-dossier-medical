<!DOCTYPE html>
<html lang="en">

<head>
   <title>Gestion de Dossiers Médicaux</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!--===============================================================================================-->
   <link rel="icon" type="image/png" href="images/icons/med2.ico" />
   <!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
   <!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
   <!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
   <!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
   <!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
   <!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="css/util.css">
   <link rel="stylesheet" type="text/css" href="css/main.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <!--===============================================================================================-->
   <style>
      *{
      	-webkit-user-select: none; 
      	-webkit-touch-callout: none; 
      	-moz-user-select: none; 
      	-ms-user-select: none; 
      	 user-select: none;  }
      	 
   </style>
   <!--===============================================================================================-->
</head>

<body> <?php
    require('db.php');
    session_start();

    // Redirect to dashboard if user is already logged in
    if (isset($_SESSION['username'])) {
        header("Location: dashboard.php");
        exit;
    }

    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `auth` WHERE user='$username' AND mdp='$password'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location: dashboard.php");
        } else {
			echo "<script>
				Swal.fire({
					backdrop: 'rgba(233, 97, 106, 0.8)',
					icon: 'error',
					title: 'Oops...',
					text: 'Vous avez entré des informations incorrectes.',
				}).then(function() {
					window.location = 'login.php';
				});
				</script>";
        }
    } else {
?>
<div class="limiter">
      <div class="container-login100">
         <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt> <img src="images/img-01.png" draggable="false" alt="IMG"> </div> <?php if (isset($error_message)) { echo $error_message; } ?> <form class="login100-form validate-form" action="login.php" method="post"> <span class="login100-form-title"> Gestion de Dossiers Médicaux </span>
               <div class="wrap-input100 validate-input" data-validate="Entrer une adresse mail valide: ex@abc.xyz"> <input class="input100" type="text" id="username" name="username" placeholder="Email"> <span class="focus-input100"></span> <span class="symbol-input100"> <i class="fa fa-user-circle" aria-hidden="true"></i> </span> </div>
               <div class="wrap-input100 validate-input" data-validate="Mot de passe est obligatoire!"> <input class="input100" type="password" id="password" name="password" placeholder="Mot de passe"> <span class="focus-input100"></span> <span class="symbol-input100"> <i class="fa fa-lock" aria-hidden="true"></i> </span> </div>
               <div class="text-center p-t-12"> <label class="txt2" for="checkbox"> <input class="txt1" type="checkbox" id="checkbox"> &nbsp;Afficher le mot de passe </label> </div>
               <div class="container-login100-form-btn"> <input type="submit" value="Connecter-vous" class="login100-form-btn" /> </div>
               <div class="text-center p-t-12"> <a class="txt1" style="cursor:pointer" onClick="
		
const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 10000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'info',
  title: 'Notre site de gestion de dossiers médicaux est dédié à la protection de la vie privée et de la sécurité de vos données médicales. Nous collectons uniquement les informations nécessaires à la gestion de votre dossier médical.\nSi vous avez des questions ou des préoccupations concernant la confidentialité de vos données médicales sur notre site, n\'hésitez pas à nous contacter'})
						">Politique de confidentialité</a> </div>
               <div class="text-center p-t-136"> <a class="txt2" href="https://www.enset-media.ac.ma/"> ENSET Mohammédia <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> </a> </div>
            </form>
         </div>
      </div>
   </div>
   <!--===============================================================================================-->
   <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
   <!--===============================================================================================-->
   <script src="vendor/bootstrap/js/popper.js"></script>
   <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
   <!--===============================================================================================-->
   <script src="vendor/select2/select2.min.js"></script>
   <!--===============================================================================================-->
   <script src="vendor/tilt/tilt.jquery.min.js"></script>
   <script>
      $('.js-tilt').tilt({
      	scale: 1.1
      })
   </script>
   <!--===============================================================================================-->
   <script src="js/main.js"></script>
   <script type="text/javascript">
      $(document).ready(function() {
      	var checkbox = $("#checkbox");
      	var password = $("#password");
      	checkbox.click(function() {
      		if(checkbox.prop("checked")) {
      			password.attr("type", "text");
      		} else {
      			password.attr("type", "password");
      		}
      	});
      });
   </script> <?php
    }
?>
</body>

</html>