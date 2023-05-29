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

   <style>
      .underline-blood{
          font-weight: 100%;
          text-decoration: underline;
      }
   </style>

</head>

<body>

   <?php 
if (!$con) {
    die("Erreur de connexion : " . mysqli_connect_error());
}
// Requête SQL pour compter le nombre total de patients
$sql1 = "SELECT COUNT(*) AS total FROM patients";

// Exécution de la première requête
$result1 = mysqli_query($con, $sql1);

// Vérification de l'exécution de la première requête
if (!$result1) {
    die("Erreur d'exécution de la première requête : " . mysqli_error($con));
}

// Requête SQL pour compter le nombre de patients de sexe masculin
$sql2 = "SELECT COUNT(*) AS total_hommes FROM patients WHERE SEXE='M'";

// Exécution de la deuxième requête
$result2 = mysqli_query($con, $sql2);

// Vérification de l'exécution de la deuxième requête
if (!$result2) {
    die("Erreur d'exécution de la deuxième requête : " . mysqli_error($con));
}

// Requête SQL pour compter le nombre de patients de sexe féminin
$sql3 = "SELECT COUNT(*) AS total_femmes FROM patients WHERE SEXE='F'";
  
// Exécution de la troisième requête
$result3 = mysqli_query($con, $sql3);

// Vérification de l'exécution de la troisième requête
if (!$result3) {
    die("Erreur d'exécution de la troisième requête : " . mysqli_error($con));
}

// Récupération du résultat de la première requête
$row1 = mysqli_fetch_assoc($result1);

// Récupération du nombre total de patients
$total_patients = $row1['total'];

// Récupération du résultat de la deuxième requête
$row2 = mysqli_fetch_assoc($result2);

// Récupération du nombre de patients de sexe masculin
$total_hommes = $row2['total_hommes'];

// Récupération du résultat de la troisième requête
$row3 = mysqli_fetch_assoc($result3);

// Récupération du nombre de patients de sexe féminin
$total_femmes = $row3['total_femmes'];

// Requête SQL pour récupérer toutes les colonnes de la table "patients"
$sql4 = "SELECT * FROM patients";

// Exécution de la requête
$result4 = mysqli_query($con, $sql4);


$sql_total_fe_moins_18 = "SELECT COUNT(*) AS total_fe_moins_18 FROM patients WHERE sexe='F' AND DateNaissance >= DATE_SUB(NOW(), INTERVAL 18 YEAR)";

// Requête pour récupérer le nombre de patients de sexe féminin ayant un âge entre 18 et 25 ans
$sql_total_fe_18_25 = "SELECT COUNT(*) AS total_fe_18_25 FROM patients WHERE sexe='F' AND DateNaissance BETWEEN DATE_SUB(NOW(), INTERVAL 25 YEAR) AND DATE_SUB(NOW(), INTERVAL 18 YEAR)";

// Requête pour récupérer le nombre de patients de sexe féminin ayant un âge entre 25 et 30 ans
$sql_total_fe_25_30 = "SELECT COUNT(*) AS total_fe_25_30 FROM patients WHERE sexe='F' AND DateNaissance BETWEEN DATE_SUB(NOW(), INTERVAL 30 YEAR) AND DATE_SUB(NOW(), INTERVAL 25 YEAR)";

// Requête pour récupérer le nombre de patients de sexe féminin ayant un âge entre 30 et 45 ans
$sql_total_fe_30_45 = "SELECT COUNT(*) AS total_fe_30_45 FROM patients WHERE sexe='F' AND DateNaissance BETWEEN DATE_SUB(NOW(), INTERVAL 45 YEAR) AND DATE_SUB(NOW(), INTERVAL 30 YEAR)";

// Requête pour récupérer le nombre de patients de sexe féminin ayant un âge entre 45 et 60 ans
$sql_total_fe_45_60 = "SELECT COUNT(*) AS total_fe_45_60 FROM patients WHERE sexe='F' AND DateNaissance BETWEEN DATE_SUB(NOW(), INTERVAL 60 YEAR) AND DATE_SUB(NOW(), INTERVAL 45 YEAR)";

$sql_total_fe_plus_60 = "SELECT COUNT(*) AS total_fe_plus_60 FROM patients WHERE sexe='F' AND DateNaissance <= DATE_SUB(NOW(), INTERVAL 60 YEAR)";

// Exécution des requêtes pour le sexe féminin
$result_total_fe_moins_18 = mysqli_query($con, $sql_total_fe_moins_18);
$result_total_fe_18_25 = mysqli_query($con, $sql_total_fe_18_25);
$result_total_fe_25_30 = mysqli_query($con, $sql_total_fe_25_30);
$result_total_fe_30_45 = mysqli_query($con, $sql_total_fe_30_45);
$result_total_fe_45_60 = mysqli_query($con, $sql_total_fe_45_60);
$result_total_fe_plus_60 = mysqli_query($con, $sql_total_fe_plus_60);


// Vérification de l'exécution des requêtes pour le sexe masculin
if ($result_total_fe_moins_18 && $result_total_fe_18_25 && $result_total_fe_25_30 && $result_total_fe_30_45 && $result_total_fe_45_60 && $result_total_fe_plus_60) {
    // Récupération des résultats des requêtes pour le sexe masculin
    $row_total_fe_moins_18 = mysqli_fetch_assoc($result_total_fe_moins_18);
    $row_total_fe_18_25 = mysqli_fetch_assoc($result_total_fe_18_25);
    $row_total_fe_25_30 = mysqli_fetch_assoc($result_total_fe_25_30);
    $row_total_fe_30_45 = mysqli_fetch_assoc($result_total_fe_30_45);
    $row_total_fe_45_60 = mysqli_fetch_assoc($result_total_fe_45_60);
    $row_total_fe_plus_60 = mysqli_fetch_assoc($result_total_fe_plus_60);

    // Récupération du nombre de patients de sexe masculin dans chaque tranche d'âge
    $total_fe_moins_18 = $row_total_fe_moins_18['total_fe_moins_18'];
    $total_fe_18_25 = $row_total_fe_18_25['total_fe_18_25'];
    $total_fe_25_30 = $row_total_fe_25_30['total_fe_25_30'];
    $total_fe_30_45 = $row_total_fe_30_45['total_fe_30_45'];
    $total_fe_plus_60 = $row_total_fe_plus_60['total_fe_plus_60'];
    $total_fe_45_60 = $row_total_fe_45_60['total_fe_45_60'];
}

$sql_total_male_moins_18 = "SELECT COUNT(*) AS total_male_moins_18 FROM patients WHERE sexe='M' AND DateNaissance >= DATE_SUB(NOW(), INTERVAL 18 YEAR)";

// Requête pour récupérer le nombre de patients de sexe féminin ayant un âge entre 18 et 25 ans
$sql_total_male_18_25 = "SELECT COUNT(*) AS total_male_18_25 FROM patients WHERE sexe='M' AND DateNaissance BETWEEN DATE_SUB(NOW(), INTERVAL 25 YEAR) AND DATE_SUB(NOW(), INTERVAL 18 YEAR)";

// Requête pour récupérer le nombre de patients de sexe féminin ayant un âge entre 25 et 30 ans
$sql_total_male_25_30 = "SELECT COUNT(*) AS total_male_25_30 FROM patients WHERE sexe='M' AND DateNaissance BETWEEN DATE_SUB(NOW(), INTERVAL 30 YEAR) AND DATE_SUB(NOW(), INTERVAL 25 YEAR)";

// Requête pour récupérer le nombre de patients de sexe féminin ayant un âge entre 30 et 45 ans
$sql_total_male_30_45 = "SELECT COUNT(*) AS total_male_30_45 FROM patients WHERE sexe='M' AND DateNaissance BETWEEN DATE_SUB(NOW(), INTERVAL 45 YEAR) AND DATE_SUB(NOW(), INTERVAL 30 YEAR)";

$sql_total_male_45_60 = "SELECT COUNT(*) AS total_male_45_60 FROM patients WHERE sexe='M' AND DateNaissance BETWEEN DATE_SUB(NOW(), INTERVAL 60 YEAR) AND DATE_SUB(NOW(), INTERVAL 45 YEAR)";

$sql_total_male_plus_60 = "SELECT COUNT(*) AS total_male_plus_60 FROM patients WHERE sexe='M' AND DateNaissance <= DATE_SUB(NOW(), INTERVAL 60 YEAR)";

$result_total_male_moins_18 = mysqli_query($con, $sql_total_male_moins_18);
$result_total_male_18_25 = mysqli_query($con, $sql_total_male_18_25);
$result_total_male_25_30 = mysqli_query($con, $sql_total_male_25_30);
$result_total_male_30_45 = mysqli_query($con, $sql_total_male_30_45);
$result_total_male_45_60 = mysqli_query($con, $sql_total_male_45_60);
$result_total_male_plus_60 = mysqli_query($con, $sql_total_male_plus_60);

if ($result_total_male_moins_18 && $result_total_male_18_25 && $result_total_male_25_30 && $result_total_male_30_45 && $result_total_male_45_60 && $result_total_male_plus_60) {
    // Récupération des résultats des requêtes pour le sexe masculin
    $row_total_male_moins_18 = mysqli_fetch_assoc($result_total_male_moins_18);
    $row_total_male_18_25 = mysqli_fetch_assoc($result_total_male_18_25);
    $row_total_male_25_30 = mysqli_fetch_assoc($result_total_male_25_30);
    $row_total_male_30_45 = mysqli_fetch_assoc($result_total_male_30_45);
    $row_total_male_45_60 = mysqli_fetch_assoc($result_total_male_45_60);
    $row_total_male_plus_60 = mysqli_fetch_assoc($result_total_male_plus_60);

    $total_male_moins_18 = $row_total_male_moins_18['total_male_moins_18'];
    $total_male_18_25 = $row_total_male_18_25['total_male_18_25'];
    $total_male_25_30 = $row_total_male_25_30['total_male_25_30'];
    $total_male_30_45 = $row_total_male_30_45['total_male_30_45'];
    $total_male_plus_60 = $row_total_male_plus_60['total_male_plus_60'];
    $total_male_45_60 = $row_total_male_45_60['total_male_45_60'];
}

if($total_hommes > $total_femmes) 
	$T=$total_patients - $total_hommes; 
else $T=$total_patients - $total_femmes;

// Fermeture de la connexion à la base de données
mysqli_close($con);
?>

   <!-- ======= Header ======= -->
   <header id="header" class="header fixed-top d-flex align-items-center">

      <div class="d-flex align-items-center justify-content-between">
         <a href="dashboard.php" class="logo d-flex align-items-center">
            <img src="images/icons/med2.ico" alt="">
            <span class="d-none d-lg-block">Dossiers Médicaux</span>
         </a>
         <i class="bi bi-list toggle-sidebar-btn"></i>
      </div><!-- End Logo -->

      <nav class="header-nav ms-auto">
         <!-- Icons Navigation -->
         <div class="d-flex align-items-center">
            <!-- Bonjour -->
            <div class="nav-item pe-3">
               <a class="nav-link nav-profile d-flex align-items-center pe-0">
                  <i class="bi bi-person-circle"></i>
                  <span class="d-none d-md-block ps-2 underline-blood">Bonjour <?php echo $_SESSION['username']; ?></span>
               </a>
            </div>
            <!-- Déconnecter -->
            <div class="nav-item pe-3">
               <a class="nav-link nav-profile d-flex align-items-center pe-0" href="logout.php">
                  <i class="bi bi-box-arrow-right"></i>
                  <span class="d-none d-md-block ps-2">Déconnecter</span>
               </a>
            </div>
         </div>
      </nav>
      <!-- End Icons Navigation -->

   </header><!-- End Header -->

   <!-- ======= Sidebar ======= -->
   <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
            <a class="nav-link " href="dashboard.php">
               <i class="bi bi-grid"></i>
               <span>Tableau de bord</span>
            </a>
         </li><!-- End Dashboard Nav -->

         <li class="nav-item">
            <a class="nav-link collapsed" href="listePatient.php">
               <i class="bi bi-person-lines-fill"></i>
               <span>Liste de patients</span>
            </a>
         </li><!-- End list patient -->

         <li class="nav-item">
            <a class="nav-link collapsed" href="addPatient.php">
               <i class="bi bi-plus-lg"></i>
               <span>Ajouter un patient</span>
            </a>
         </li><!-- End ajouter -->

         <li class="nav-item">
            <a class="nav-link collapsed" href="print.php">
               <i class="bi bi-printer"></i><span>Imprimer documents</span>
            </a>
         </li><!-- End doc print Nav -->

         <li class="nav-item">
            <a class="nav-link collapsed" href="faq.php">
               <i class="bi bi-question-circle"></i>
               <span>F.A.Q</span>
            </a>
         </li><!-- End F.A.Q Page Nav -->

         <li class="nav-item">
            <a class="nav-link collapsed" href="contact.php">
               <i class="bi bi-envelope"></i>
               <span>Contact</span>
            </a>
         </li><!-- End Contact Page Nav -->

      </ul>

   </aside><!-- End Sidebar-->

   <main id="main" class="main">

      <div class="pagetitle">
         <h1>Tableau de bord</h1>
         <nav>
            <ol class="breadcrumb With-Home-Icon">
               <li class="breadcrumb-item"><a><i class="bi bi-house-door"></i> Accueil</a></li>
               <li class="breadcrumb-item active">Tableau de bord</li>
            </ol>
         </nav>
      </div><!-- End Page Title -->

      <section class="section dashboard">
         <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
               <div class="row">

                  <!-- Patient Card -->
                  <div class="col-xxl-6 col-md-6">
                     <div class="card info-card revenue-card">

                        <div class="card-body">
                           <h5 class="card-title underline-blood"><i class="ri-article-line"></i> Le nombre de patients</h5>

                           <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                 <span class="material-symbols-outlined">personal_injury</span>
                              </div>
                              <div class="ps-3">
                                 <h6><?php echo $total_patients ?> Patients</h6>
                                 <!--Nombre de patients-->
                              </div>
                           </div>
                        </div>

                     </div>
                  </div><!-- End Patient Card -->

                  <!-- Date Card -->
                  <div class="col-xxl-6 col-md-6">
                     <div class="card info-card sales-card">

                        <div class="card-body">
                           <h5 class="card-title"></i> Date / Heure</h5>

                           <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                 <i class="bi bi-calendar-minus"></i>
                              </div>
                              <div class="ps-3 fs-5 fw-bold">
                                 <span class="text-primary" id="DateID">Date</span><br>
                                 <span class="text-success" id="TimeID">Time</span>

                              </div>
                           </div>
                        </div>

                     </div>
                  </div><!-- End Date Card -->

                  <!-- Data Tables -->
                  <div class="col-12">
                     <div class="card recent-sales overflow-auto">

                        <div class="card-body">
                           <h6 class="card-title"><i class="material-symbols-outlined">patient_list</i> Tables des patients</h6>

                           <table class="table table-striped datatable">
                              <thead>
                                 <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Sexe</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php while ($row = mysqli_fetch_assoc($result4)) { ?>
                                 <tr>
                                    <th scope="row"><a href="#"><?php echo $row['idP']; ?></a></th>
                                    <td><?php echo $row['nom']; ?></td>
                                    <td><?php echo $row['prenom']; ?></td>
                                    <td><?php echo $row['sexe']; ?></td>
                                 </tr>
                                 <?php } ?>
                              </tbody>
                           </table>

                        </div>

                     </div>
                  </div><!-- End Patient Table -->

               </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

               <!-- Stats H/F -->
               <div class="card">

                  <div class="card-body pb-0">
                     <h5 class="card-title"><i class="material-symbols-outlined">pie_chart</i> Hommes / Femmes <span>| Statistique</span></h5>

                     <div id="trafficChart" style="min-height: 380px;" class="echart"></div>

                     <script>
                        document.addEventListener("DOMContentLoaded", () => {
                          echarts.init(document.querySelector("#trafficChart")).setOption({
                            tooltip: {
                              trigger: 'item'
                            },
                            legend: {
                              top: '5%',
                              left: 'center'
                            },
                            series: [{
                              type: 'pie',
                              radius: ['40%', '70%'],
                              avoidLabelOverlap: false,
                              label: {
                                show: false,
                                position: 'center'
                              },
                              emphasis: {
                                label: {
                                  show: true,
                                  fontSize: '18',
                                  fontWeight: 'bold'
                                }
                              },
                              labelLine: {
                                show: false
                              },
                              data: [{
                                  value: <?php echo $total_hommes; ?>,
                                  name: 'Hommes'
                                },
                                {
                                  value: <?php echo $total_femmes; ?>,
                                  name: 'Femmes'
                                },
                              ]
                            }]
                          });
                        });
                     </script>

                  </div>
               </div><!-- End Stats H/F circle graphe -->

               <!-- Tranche d age -->
               <div class="card">

                  <div class="card-body pb-0">
                     <h5 class="card-title"><i class="material-symbols-outlined">query_stats</i> Tranche d’âge</h5>

                     <div id="budgetChart" style="min-height: 520px;" class="echart"></div>

                     <script>
                        document.addEventListener("DOMContentLoaded", () => {
                          var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                            legend: {
                              data: ['Hommes', 'Femmes']
                            },
                            radar: {
                              indicator: [{
                                  name: '-18',
                                  max: <?php echo $T; ?>
                                },
                                {
                                  name: '18 - 25',
                                  max: <?php echo $T; ?>
                                },
                                {
                                  name: '25 - 30',
                                  max: <?php echo $T; ?>
                                },
                                {
                                  name: '30 - 45',
                                  max: <?php echo $T; ?>
                                },
                                {
                                  name: '45 - 60',
                                  max: <?php echo $T; ?>
                                },
                                {
                                  name: '+60',
                                  max: <?php echo $T; ?>
                                }
                              ]
                            },
                            series: [{
                              name: 'Tranche d’âge',
                              type: 'radar',
                              data: [{
                                  value: [<?php echo $total_male_moins_18;?>, <?php echo $total_male_18_25;?>, <?php echo $total_male_25_30;?>, <?php echo $total_male_30_45;?>, <?php echo $total_male_45_60;?>, <?php echo $total_male_plus_60;?>,],
                                  name: 'Hommes'
                                },
                                {
                                  value: [<?php echo $total_fe_moins_18;?>, <?php echo $total_fe_18_25;?>, <?php echo $total_fe_25_30;?>, <?php echo $total_fe_30_45;?>, <?php echo $total_fe_45_60;?>, <?php echo $total_fe_plus_60;?>,],
                                  name: 'Femmes'
                                }
                              ]
                            }]
                          });
                        });
                     </script>

                  </div>
               </div><!-- End Tranche age graphe -->

            </div><!-- End Right side columns -->

         </div>
      </section>

   </main><!-- End #main -->

   <!-- ======= Footer ======= -->
   <footer id="footer" class="footer">
      <div class="copyright">
         &copy; Copyright <strong><span>( ENSET Project 2022 )</span></strong>. All Rights Reserved
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

   <script>
      function updateTime() {
        let date = new Date();
        let dateString = date.toLocaleString('fr-FR',{weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'});
        let dateMots = dateString.split(" ");
        let dateResultat = "";
        dateMots.forEach(function(mot) { dateResultat += mot.charAt(0).toUpperCase() + mot.slice(1) + " "; });
        dateResultat = dateResultat.trim();
        document.getElementById('DateID').innerHTML = dateResultat;
        let timeString = date.toLocaleTimeString('fr-FR', {hour: 'numeric', minute: 'numeric', second: 'numeric'});
        let timeMots = timeString.split(":");
        let timeResultat = "";
        timeMots.forEach(function(mot) { timeResultat += mot.charAt(0).toUpperCase() + mot.slice(1) + ":"; });
        timeResultat = timeResultat.slice(0, -1);
        document.getElementById('TimeID').innerHTML = timeResultat;
      }
      setInterval(updateTime, 1000);
   </script>

</body>

</html>