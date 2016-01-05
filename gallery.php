<?php

$imagesDir = 'uploads/';

$images = glob($imagesDir.'*');
print_r($images);

if (isset($_FILES['user_picture']['tmp_name'])) {
	

	$uploadFilesTmpName = $_FILES['user_picture']['tmp_name'];
	$uploadFileName = $_FILES['user_picture']['name'];
	$uploadFileType = $_FILES['user_picture']['type'];
	$uploadFileSize = $_FILES['user_picture']['size'];

			// 3. On vérifie la photo
	if(!strstr($uploadFileType, 'jpg') && !strstr($uploadFileType, 'jpeg') && !strstr($uploadFileType, 'png') && !strstr($uploadFileType, 'gif')){

		$erreurTypeFile = "<span class='bg-danger'>Seuls les fichiers Jpeg, Png et Gif sont acceptés!</span>";
	}	
	if($uploadFilesSize > 10000000) {
		$erreurPoidsPhoto = "<span class='bg-danger'>Le fichier dépasse le poids maximum !</span>";
	}
	elseif (move_uploaded_file($uploadFilesTmpName, $imagesDir.time().$uploadFileName)) {
		$admission = "<span class='bg-info'>Merci pour votre photo !</span>";		
	}
	else{
		$erreur_photo = "<span class='bg-danger'>Votre photo n'a pas été chargé correctement!</span>";
	}

}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Gallery</title>
</head>
<body>
	<h5>Envoyer une image</h5>
	<form method="POST" action="#" enctype="multipart/form">
		<input type="file" name="user_picture" />
		<input type="submit" name="action" value="envoyer" />
	</form>


	<?php foreach ($images as $keyImages => $image) : ?>
			
					<img class='img-thumbnail' id="" width="320" height="180" src="<?php echo $image; ?>" frameborder="0"/></img>

	<?php endforeach?>


</body>
</html>