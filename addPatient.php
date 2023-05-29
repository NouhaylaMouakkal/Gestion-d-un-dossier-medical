<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <title>Dossiers Medicaux</title> <!-- Favicons -->
   <link rel="icon" type="image/png" href="images/icons/med2.ico" /> <!-- Google Fonts -->
   <link href="https://fonts.gstatic.com" rel="preconnect">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" /> <!-- Vendor CSS Files -->
   <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
   <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
   <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
   <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
   <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
   <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet"> <!--  Main CSS File -->
   <link href="assets/css/style.css" rel="stylesheet">
   <style>
      /* Chrome, Safari, Edge, Opera */
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }
      
      /* Firefox */
      input[type=number] {
        -moz-appearance: textfield;
      }
   </style>
</head>

<body>
<?php 
if (!$con) {
    die("Erreur de connexion : " . mysqli_connect_error());
}
//PHP Code here SO YEAAAAAAH --------------------


// Fermeture de la connexion à la base de données
mysqli_close($con);
?>
   <!-- ======= Header ======= -->
   <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between"> <a href="dashboard.php" class="logo d-flex align-items-center"> <img src="images/icons/med2.ico" alt=""> <span class="d-none d-lg-block">Dossiers Médicaux</span> </a> <i class="bi bi-list toggle-sidebar-btn"></i> </div><!-- End Logo -->
      <nav class="header-nav ms-auto">
         <!-- Icons Navigation -->
         <div class="d-flex align-items-center">
            <!-- Bonjour -->
            <div class="nav-item pe-3"> <a class="nav-link nav-profile d-flex align-items-center pe-0"> <i class="bi bi-person-circle"></i> <span class="d-none d-md-block ps-2 underline-blood">Bonjour <?php echo $_SESSION['username']; ?></span> </a> </div> <!-- Déconnecter -->
            <div class="nav-item pe-3"> <a class="nav-link nav-profile d-flex align-items-center pe-0" href="logout.php"> <i class="bi bi-box-arrow-right"></i> <span class="d-none d-md-block ps-2">Déconnecter</span> </a> </div>
         </div>
      </nav> <!-- End Icons Navigation -->
   </header><!-- End Header -->
   <!-- ======= Sidebar ======= -->
   <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
         <li class="nav-item"> <a class="nav-link collapsed" href="dashboard.php"> <i class="bi bi-grid"></i> <span>Tableau de bord</span> </a> </li><!-- End Dashboard Nav -->
         <li class="nav-item"> <a class="nav-link collapsed" href="listePatient.php"> <i class="bi bi-person-lines-fill"></i> <span>Liste de patients</span> </a> </li><!-- End list patient -->
         <li class="nav-item"> <a class="nav-link" href="addPatient.php"> <i class="bi bi-plus-lg"></i> <span>Ajouter un patient</span> </a> </li><!-- End ajouter -->
         <li class="nav-item"> <a class="nav-link collapsed" href="print.php"> <i class="bi bi-printer"></i><span>Imprimer documents</span> </a> </li><!-- End doc print Nav -->
         <li class="nav-item"> <a class="nav-link collapsed" href="faq.php"> <i class="bi bi-question-circle"></i> <span>F.A.Q</span> </a> </li><!-- End F.A.Q Page Nav -->
         <li class="nav-item"> <a class="nav-link collapsed" href="contact.php"> <i class="bi bi-envelope"></i> <span>Contact</span> </a> </li><!-- End Contact Page Nav -->
      </ul>
   </aside><!-- End Sidebar-->
   <main id="main" class="main">
      <div class="pagetitle">
         <h1>Gestion de patients</h1>
      </div> <!-- End Page Title -->
      <section class="section">
         <div class="row">
            <div class="col-lg-6">
               <div class="card">
                  <div class="card-body">
                     <h5 class="card-title"> Données personnelles du patient </h5>
                     <form class="row g-3" name="form1">
                        <!-- Form personal data -->
                        <div class="col-md-12">
                           <div class="form-floating"> <input type="text" class="form-control" id="nom" placeholder="Nom"> <label for="nom">Nom</label> </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-floating"> <input type="text" class="form-control" id="prenom" placeholder="Prénom"> <label for="prenom">Prénom</label> </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-floating"> <input type="date" class="form-control" id="date_naissance" placeholder="Date de naissance"> <label for="date_naissance">Date de naissance</label> </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-floating mb-3"> <select class="form-select" id="sexe" aria-label="Sexe">
                                 <option value="1">Femme</option>
                                 <option value="2">Homme</option>
                              </select> <label for="sexe">Sexe</label> </div>
                        </div>
                        <fieldset class="col-md-12">
                           <legend class="col-form-label pt-0"> Situation familiale :</legend>
                           <div class="d-flex justify-content-evenly">
                              <div class="form-check"> <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1"> <label class="form-check-label" for="gridRadios1">Célibataire</label> </div>
                              <div class="form-check"> <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2"> <label class="form-check-label" for="gridRadios2">Marié</label> </div>
                              <div class="form-check"> <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3"> <label class="form-check-label" for="gridRadios3">Divorcé</label> </div>
                              <div class="form-check"> <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios4" value="option4"> <label class="form-check-label" for="gridRadios4">Veuf</label> </div>
                           </div>
                        </fieldset>
                        <div class="col-md-6">
                           <div class="form-floating"> <input type="tel" class="form-control" id="telephone" placeholder="Téléphone"> <label for="telephone">Téléphone</label> </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-floating"> <input type="text" class="form-control" id="job" placeholder="Métier"> <label for="job">Métier</label> </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-floating"> <input type="text" class="form-control" id="ville" placeholder="Ville"> <label for="ville">Ville</label> </div>
                        </div>
                        <div class="col-md-9">
                           <div class="form-floating"> <input type="text" class="form-control" id="adresse" placeholder="Adresse"> <label for="adresse">Adresse</label> </div>
                        </div>
                        <div class="text-center"> <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Enregistrer</button> <button type="reset" class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i> Annuler</button> </div>
                     </form>
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="card mt-4">
                  <div class="card-body">
                     <h5 class="card-title"> Informations médicales du patient </h5>
                     <form class="row g-3" name="form2">
                        <!-- Form medical data -->
                        <div class="col-md-4">
                           <div class="form-floating mb-3"> <select class="form-select" id="groupe_sanguin" aria-label="Groupe sanguin">
                                 <option selected>A+</option>
                                 <option value="1">A-</option>
                                 <option value="2">B+</option>
                                 <option value="3">B-</option>
                                 <option value="4">AB+</option>
                                 <option value="5">AB-</option>
                                 <option value="6">O+</option>
                                 <option value="7">O-</option>
                              </select> <label for="groupe_sanguin">Groupe sanguin</label> </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-floating"> <input type="number" class="form-control" id="taille" placeholder="taille"> <label for="taille">Taille (cm)</label> </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-floating"> <input type="number" class="form-control" id="poids" placeholder="poids"> <label for="poids">Poids (kg)</label> </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-floating"> <input type="number" class="form-control" id="tension" placeholder="Tension artérielle"> <label for="tension">Tension artérielle</label> </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-floating"> <input type="number" class="form-control" id="glucose" placeholder="Taux de glucose"> <label for="glucose">Taux de glucose</label> </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-floating"> <textarea class="form-control" placeholder="antecedent" id="antecedent" style="height: 120px;resize: none;overflow-y:hidden;"></textarea> <label for="antecedent">Les antécédents</label> </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-floating"> <textarea class="form-control" placeholder="madicaments" id="medicamants" style="height: 120px;resize: none;overflow-y:hidden;"></textarea> <label for="medicaments">Médicaments</label> </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </main> <!-- ======= Footer ======= -->
   <footer id="footer" class="footer">
      <div class="copyright">&copy; Copyright <strong><span>( ENSET Project 2022 )</span></strong>. All Rights Reserved </div>
      <div class="credits"> </div>
   </footer>
   <!-- End Footer -->
    <a class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> 

	<!-- Vendor JS Files -->
   <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
   <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="assets/vendor/chart.js/chart.min.js"></script>
   <script src="assets/vendor/echarts/echarts.min.js"></script>
   <script src="assets/vendor/quill/quill.min.js"></script>
   <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
   <script src="assets/vendor/tinymce/tinymce.min.js"></script>
   <script src="assets/vendor/php-email-form/validate.js"></script>
   <script src="assets/js/main.js"></script>
</body>
</html>