<?php

if (isset($_POST['action'])){

	// echo "<pre>";
	// print_r($_POST);
	// echo "</pre>";

	// echo "<pre>";
	// print_r($_FILES);
	// echo "</pre>";


	// echo "Le poids de la photo est de : ".$_FILES['photo']['size']." kilo octets.";
	// echo "<br />";

	// echo "Ce fichier est une ".$_FILES['photo']['type'];


		// Je range ces données dans des variables pour les réutiliser ultérieurement!
	$uploadFileType = $_FILES['photo']['type'];
	$uploadFilesSize = $_FILES['photo']['size'];
	$prenom = $_POST["prenom"];
	$nom = $_POST["nom"];
	$photo = $_FILES["photo"];

		// Je vérifie qu'aucune données ne manque et indique un message d'erreur si elles sont manquantes
		//  Je vérifie la validité des données 
		// nom et prénom = chaine de caractères de longueur min 2 max 10 
		// photo = size > 0 et type = jpeg || png || gif


		// 1. On vérifie le prénom
	if(empty($prenom)) {
		$erreur_prenom = "<span style='color: red;'>Le prénom est obligatoire !</span>";
	}
	elseif(strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 10) {
		$erreur_prenom_lenght = "<span style='color: red;'>Vérifiez la longueur de votre prénom ! </span>" ;
	}

		// 2. On vérifie le nom
	if(empty($nom)) {
		$erreur_nom = "<span style='color: red;'>Le nom est obligatoire !</span>";
	}
	elseif(strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 10) {
		$erreur_nom_lenght = "<span style='color: red;'>Vérifiez la longueur de votre nom ! </span>" ;
	}

		// 3. On vérifie la photo
	if(empty($photo)) {
		$erreur_photo = "<span style='color: red;'>Une photo est obligatoire !</span>";
	}
	elseif($uploadFilesSize < 1) {
		$erreur_photo = "<span style='color: red;'>Il n'y a pas d'image !</span>";
	}
	elseif(!strstr($uploadFileType, 'jpg') && !strstr($uploadFileType, 'jpeg') && !strstr($uploadFileType, 'png') && !strstr($uploadFileType, 'gif')){

		$erreurTypeFile = "<span style='color: red;'>Seuls les fichiers Jpeg, Png et Gif sont acceptés!</span>";
	}

		// 4. Si tout va bien on upload la photo ;)
	else{
		$admission = "<span style='color: blue;'>Merci pour votre inscription !</span>";
		move_uploaded_file($_FILES['photo']['tmp_name'], './uploads/'.$_FILES['photo']['name']);
	}


}




?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
	
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1>Inscription</h1>
				<form action="#" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="nom">Nom</label>
						<input class="form-control" type="text" id="nom" name ="nom" placeholder="Nom" >						
					    <?php if(isset($erreur_nom)) echo $erreur_nom ?>
					    <?php if(isset($erreur_nom_lenght)) echo $erreur_nom_lenght ?>
					</div>
					<div class="form-group">
						<label for="prenom">Prénom</label>
						<input class="form-control" type="text" id="prenom" name ="prenom" placeholder="Prénom" >
						<?php if(isset($erreur_prenom)) echo $erreur_prenom ?>
					    <?php if(isset($erreur_prenom_lenght)) echo $erreur_prenom_lenght ?>
					</div>
					<div class="form-group">
						<label for="photo">Votre photo de profil</label>
						<input type="file" id="photo" name="photo">
						<p class="help-block">L'image doit être inférieure à 1 Mo, sinon elle ne sera pas traité.<br/>
						Extension acceptées *.jpg, *.png, *.gif</p>
						<?php if(isset($erreurTypeFile)) echo $erreurTypeFile ?>
						<?php if(isset($erreur_photo)) echo $erreur_photo ?>
					</div>
					<div class="form-group">
						<button type="submit" name="action" class="btn btn-default">Envoyer</button>
						<?php if(isset($admission)) echo $admission ?>
					</div>
				</form>
			</div>
			
		</div>

		
	</div>

</body>
</html>