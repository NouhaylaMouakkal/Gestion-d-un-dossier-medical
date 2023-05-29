<?php
    // host name, database username, password, and database name.         /
    $con = mysqli_connect("localhost:3307","root","","WEB");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

/*  I have created those table and run all the tests.

DATABASE NAME : web

TABLE NAME ---> auth

Colonne
user (Primaire)	varchar(30)			
mdp	varchar(30)		



TABLE NAME ---> patients

Colonne
idP (Primaire)	int(11)			
nom	varchar(25)				
prenom	varchar(25)				
sexe	varchar(1)			
DateNaissance	date			
ville	varchar(25)			
adresse	varchar(255)


*/
	
?>
