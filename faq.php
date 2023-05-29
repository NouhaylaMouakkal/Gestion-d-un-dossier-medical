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

   <title>Dossiers Medicaux</title>

   <!-- Favicons -->
   <link rel="icon" type="image/png" href="images/icons/med2.ico" />

   <!-- Google Fonts -->
   <link href="https://fonts.gstatic.com" rel="preconnect">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

   <!-- Vendor CSS Files -->
   <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
   <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
   <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
   <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
   <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
   <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

   <!--  Main CSS File -->
   <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
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
         <li class="nav-item"> <a class="nav-link collapsed" href="addPatient.php"> <i class="bi bi-plus-lg"></i> <span>Ajouter un patient</span> </a> </li><!-- End ajouter -->
         <li class="nav-item"> <a class="nav-link collapsed" href="print.php"> <i class="bi bi-printer"></i><span>Imprimer documents</span> </a> </li><!-- End doc print Nav -->
         <li class="nav-item"> <a class="nav-link" href="faq.php"> <i class="bi bi-question-circle"></i> <span>F.A.Q</span> </a> </li><!-- End F.A.Q Page Nav -->
         <li class="nav-item"> <a class="nav-link collapsed" href="contact.php"> <i class="bi bi-envelope"></i> <span>Contact</span> </a> </li><!-- End Contact Page Nav -->
      </ul>
   </aside><!-- End Sidebar-->
   <main id="main" class="main">
      <section class="section">
         <div class="card">
            <img src="images/faq.jpg" class="d-block mx-auto" style="height:auto;width:40%;" alt="...">
            <div class="card-body">

               <h5 class="text-decoration-underline">Gestion des patients</h5>
               <b>Comment puis-je ajouter un patient ?</b>
               <p>Pour ajouter un patient, cliquez sur le bouton "Ajouter un patient" dans le menu principal de l'application de gestion de patients. Remplissez le formulaire avec les informations du patient et cliquez sur "Enregistrer".</p>

               <b>Comment puis-je éditer ou supprimer un enregistrement de patient ?</b>
               <p>Pour éditer un enregistrement de patient, cliquez sur le bouton "Editer" à côté de l'enregistrement dans la table "Liste de patients". Pour supprimer un enregistrement, cliquez sur le bouton "Supprimer".</p>

               <h5 class="text-decoration-underline">Imprimer des documents</h5>
               <b>Comment puis-je imprimer un document ?</b>
               <p>Pour imprimer un document, cliquez sur le bouton "Imprimer" dans le menu principal. Sélectionnez le document que vous souhaitez imprimer et suivez les instructions de votre navigateur pour lancer l'impression.</p>

               <h5 class="text-decoration-underline">Signaler une erreur</h5>
               <b>Comment puis-je signaler une erreur sur le site ?</b>
               <p>Pour signaler une erreur sur le site, utilisez le formulaire de contact disponible dans le menu principal. Remplissez le formulaire avec les détails de l'erreur et cliquez sur "Envoyer". Nous ferons de notre mieux pour corriger l'erreur dès que possible.</p>

            </div>
         </div><!-- End Card with an image on top -->
      </section>
   </main>

   <!-- ======= Footer ======= -->
   <footer id="footer" class="footer">
      <div class="copyright">&copy; Copyright <strong><span>( ENSET Project 2022 )</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
      </div>
   </footer><!-- End Footer -->

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