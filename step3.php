<?php
/*****************************************************************************************
** © 2020 POULAIN Nicolas – nicolas.poulain@ouvaton.org **
** **
** Ce fichier est une partie du logiciel libre MuseoThermoHygro, licencié **
** sous licence "CeCILL version 2". **
** La licence est décrite plus précisément dans le fichier : LICENSE.txt **
** **
** ATTENTION, CETTE LICENCE EST GRATUITE ET LE LOGICIEL EST **
** DISTRIBUÉ SANS GARANTIE D'AUCUNE SORTE **
** ** ** ** **
** This file is a part of the free software project MuseoThermoHygro,
** licensed under the "CeCILL version 2". **
**The license is discribed more precisely in LICENSES.txt **
** **
**NOTICE : THIS LICENSE IS FREE OF CHARGE AND THE SOFTWARE IS DISTRIBUTED WITHOUT ANY **
** WARRANTIES OF ANY KIND **
*****************************************************************************************/
?>
<!DOCTYPE html>
<html lang="fr-FR"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Générateur de cartes</title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="shortcut icon" href="includes/favicon.ico" type="image/x-icon">
	<link href="includes/bootstrap.css" rel="stylesheet">
	<link href="includes/bootstrap-responsive.css" rel="stylesheet">
	<link href="includes/style_museomix.css" rel="stylesheet"> 
	<link href="includes/style-annexe.css" rel="stylesheet"> 
	<link href="includes/style.css" rel="stylesheet">	
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://www.museomix.org/wp-content/themes/museomix-design-2/biblio/html5shiv.js"></script>
    <![endif]-->
	<script src="includes/jquery.js"></script>
	<script src="includes/scripts.js"></script>
	<meta name="robots" content="noindex,nofollow">
	<script src="includes/bootstrap.js"></script>
	<!-- carousel -->
	<script src="swiper-min/swiper.min.js"></script>
	<link rel="stylesheet" href="swiper-min/swiper.min.css">
</head>

<body style="padding-top: 40px; background: #eee;" data-spy="scroll" data-target=".sidebar-nav">

	<!--div style="">

		<h1 class="bloc-titre">
		
			<a href="http://www.museomix.org" class="bouton-titre">Museomix</a>
			
		</h1>

	</div-->

	
<div class="navbar navbar-inverse navbar-fixed-top" style="">
  <div class="navbar-inner" style="background: #FFEC00; border-color: #d4d4d4;">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
    <div class="container nav">

		<!--<li class="" style="">-->

<a class="bouton-nav bouton-nav-accueil brand" href="index.php">
<img src="includes/logo.png" class="logoHeader"></a>


    <div class="nav-collapse collapse">
	<ul class="nav">
	<li class=""><a href="step1.php" class="bouton-nav">On y va</a></li>
	<li class=""><a href="gallery.php" class="bouton-nav">Galerie</a></li>
	<li class=""><a href="fondsbailly.php" class="bouton-nav">Le fonds Bailly</a></li>
	<li class=""><a href="explications.php" class="bouton-nav">Quelques explications</a></li>
	<li class=""><a href="credits.php" class="bouton-nav">Crédits</a></li>
	
	
    </ul>
	</div>
	</div>
  </div>
</div>

  <div class="container" style="margin: 0; width: auto;">
	
    <div class="row">

<div class="span2 hidden-phone hidden-tablet sidebar-nav" style="float: left; min-height: 1px;">
</div>

<div class="bloc-page span9">
	<div class="contenu-page">
		<div class="bloc-contenu" style="">
		
<h2 style="text-align:center" ><img alt="maintenant clique pour partager" src="includes/step3.png" /></h2>

<!-- ################################################ CODE #####################################-->

<?php

include('./includes/inc.functions.php') ;

// on récupéère l'adresse de l'image avec filtre
$imageSelectedName = dataClean( $_REQUEST['imageSelectedName'] ,"ALnum") ;
$imageSelectedSrc = "http://museo.tounoki.org/omeka/sideload/" . $imageSelectedName ;

if ( $apiName == "deepapi" ) {
	// on récupéère l'adresse de l'image colorisée
	// de la forme https://api.deepai.org/job-view-file/edfdf90c-b807-4b50-9d19-bef4746cc7fe/outputs/output.jpg
	// on la sécurise avec un bricolage
	$imageColorisePathArray = explode( "/" , $_REQUEST['imageColoriseSrc'] ) ;
	$imageColorisePathArray[2] = "api.deepai.org" ;
	$imageColorisePathArray[4] = dataClean( $imageColorisePathArray[4] ,"alnum") ;
	$imageColorisePathArray[5] = "outputs" ;
	$imageColorisePathArray[6] = "output.jpg" ;
	$imageColoriseSrc = implode( "/" , $imageColorisePathArray ) ;
}
if ( $apiName == "ovh" ) { // petite sécurisation
	$imageColoriseSrc = dataClean( $_REQUEST['imageColoriseSrc'] , "url" ) ;
	if ( strpos( $imageColoriseSrc , $_SERVER['SERVER_NAME'] ) === FALSE ) {
		die("Alerte de sécurité") ;
	}
}
//print_r($imageColoriseSrc) ;

// on récupéère le texte-slogan
$sloganText = strip_tags($_REQUEST['sloganText']) ;


/*
//pour tests, valeurs sans API
$imageSelectedSrc = "http://museo.tounoki.org/omeka/sideload/M0196_2015-0-1197_1.jpg" ;
$imageColoriseSrc = "https://api.deepai.org/job-view-file/2d3cfac8-1d5a-436e-82b7-3e25132f2587/outputs/output.jpg" ;
$sloganText = "Jardinage, yoga, méditation... et j'ai toujours envie de giffler quelqu'un" ;
*/


//$imageSelectedResource = imagecreatefromjpeg ( $imageSelectedSrc ) ;
$imageColoriseResource = imagecreatefromjpeg ( $imageColoriseSrc ) ;

/* fil du prog
Crée image avec
Imagecreatefromtruecolor

Imagefill pour remplir

Imagecopy pour insérer le jpg couleur

Imagettfbbox pour centrer le texte
Voir commentaire 16 pour centrage text

Imagettf pour insérer le texte

Imagejpeg pour enregistrer l'image
*/

if ( imagesy($imageColoriseResource) > imagesx($imageColoriseResource) ) { // format vertical
	
	// on crée l'image
	$postcard = @imagecreatetruecolor(1200, 840)
      or die('Impossible de créer un flux d\'image GD');
	
	// on remplit de noir
	$noir = imagecolorallocate( $postcard , 0, 0, 0);
	imagefill( $postcard , 0, 0, $noir ) ;
	
	// intégre l'image colorisée - taille 1
	imagecopy ( $postcard , $imageColoriseResource , 20 , 20 , 0 , 0 , imagesx($imageColoriseResource) , imagesy($imageColoriseResource) ) ;
	
	// on  met le texte
	$sloganText = wrap( 30 ,  0 , "./font/Kollektif-Bold.ttf" , $sloganText , 560 ) ; // insère les retour chariot
	$sloganBbox = imagettfbbox ( 30 , 0 , "./font/Kollektif-Bold.ttf" , $sloganText ) ;
	
	$width = abs($sloganBbox[4] - $sloganBbox[0]);
	$height = abs($sloganBbox[5] - $sloganBbox[1]);
	$heightPos = 840 - 150 - $height ; // calcul de la position du texte en fonction du bbox
	
	$blanc = imagecolorallocate( $postcard , 255, 255, 255);
	imageTTFText( $postcard , 30 , 0 , 630 , $heightPos , $blanc , "./font/Kollektif-Bold.ttf" , $sloganText ) ;
	
	// on enregistre l'image
	$postcardId = random_string() ;
	$postcardFilename = $postcardId.".jpg" ;
	imagejpeg ( $postcard , "./temp/".$postcardFilename , 95 ) ;
	
	// Libération de la mémoire
	imagedestroy( $postcard ) ;
	
} else { // format horizontal
	
		// on crée l'image
	$postcard = @imagecreatetruecolor(1200, 840)
      or die('Impossible de créer un flux d\'image GD');
	
	// on remplit de noir
	$noir = imagecolorallocate( $postcard , 0, 0, 0);
	imagefill( $postcard , 0, 0, $noir ) ;
	
	// intégre l'image colorisée - taille 1
	imagecopy ( $postcard , $imageColoriseResource , 200 , 40 , 0 , 0 , imagesx($imageColoriseResource) , imagesy($imageColoriseResource) ) ;
	
	// on  met le texte
	$sloganText = wrap( 30 ,  0 , "./font/Kollektif-Bold.ttf" , $sloganText , 950 ) ; // insère les retour chariot
	$sloganBbox = imagettfbbox ( 30 , 0 , "./font/Kollektif-Bold.ttf" , $sloganText ) ;
	$width = abs($sloganBbox[4] - $sloganBbox[0]);
	$height = abs($sloganBbox[5] - $sloganBbox[1]);
	
	$sloganTab = explode( "\n" , $sloganText ) ;
	
	$sloganLineHeight = round($height / count($sloganTab)) ;
	$heightPos = round(700 - $height/2 ) ; // -X px -> ajout à la louche
	while ( $heightPos + $height > 840 ) {
		$heightPos -= 5 ;
	}
	//var_dump($sloganLineHeight) ;
	//print_r($sloganTab) ;
	
	$i = 0 ; // init le nbre de lignes
	$blanc = imagecolorallocate( $postcard , 255, 255, 255);
	foreach ( $sloganTab as $sloganLine ) {
		
		$sloganLineBbox = imagettfbbox ( 30 , 0 , "./font/Kollektif-Bold.ttf" , $sloganLine ) ;
		
		$width = abs($sloganLineBbox[4] - $sloganLineBbox[0]);
		$height = abs($sloganLineBbox[5] - $sloganLineBbox[1]);
		 // calcul de la position du texte en fonction du bbox - spaceheight coef 1.2 ou 120%
		$widthPos = 600 - $width/2 ;
		$heightPos += $sloganLineHeight ;
		
		imageTTFText( $postcard , 30 , 0 , $widthPos , $heightPos , $blanc , "./font/Kollektif-Bold.ttf" , $sloganLine ) ;
		//var_dump($widthPos) ;
		//var_dump($heightPos) ;
		$i++ ;
	}
	
	// ajoute 2 ronds pour faire joli
	imagefilledarc ( $postcard , 20 , 420 , 15 , 15 , 0 , 360 , $blanc , IMG_ARC_PIE ) ;
	imagefilledarc ( $postcard , 1180 , 420 , 15 , 15 , 0 , 360 , $blanc , IMG_ARC_PIE ) ;
	
	// on enregistre l'image
	$postcardId = random_string() ;
	$postcardFilename = $postcardId.".jpg" ;
	imagejpeg ( $postcard , "./temp/".$postcardFilename , 95 ) ;
	
	// Libération de la mémoire
	imagedestroy( $postcard ) ;
	
}
// détruit fichier local si copie du serveur de ovh
if ( $apiName == "ovh" ) { // petite sécurisation
	//de la forme http://127.0.0.1/cartes/temp/FoDxdD.jpg
	$tabName = explode("/", $imageColoriseSrc ) ;
	if ( file_exists( "./temp/".$tabName[ count($tabName)-1 ] ) )
		unlink( "./temp/".$tabName[ count($tabName)-1 ] ) ;
}

if ( !empty($postcardId) ) {
	// enregistre un fichier texte avec les correspondances nom généré / nom de fichier Bailly / slogan
	$postcardData = array( 'id' => $postcardId , 'Image' => $imageSelectedName , 'sloganText' => $sloganText ) ;

	$fp = fopen("./temp/$postcardId.json", 'w') ;
	fwrite( $fp , json_encode( $postcardData ) ) ;
	fclose( $fp );
}
?>

<img src="./temp/<?php echo $postcardFilename ?>" />

<hr style="clear:both">

<h2>
	<a href="card-<?php echo $postcardId ?>" >Enregistre et partage</a> 
	ou 
	<a href="supprtemp.php?id=<?php echo $postcardId ?>" >Ne pas garder</a>
</h2>


<p>Cette image est issue du fonds photographique Lucien Bailly. 
Ce fonds est habituellement visible au musée d'art et d'histoire de Saint-Brieuc.
</p>

<!-- ################################################ CODE #####################################-->

</div> <!-- close container -->
</div> <!-- close content -->
</div> <!-- close content -->
</div> <!-- close content -->
</div> <!-- close content -->

<script>

</script>


<footer class="foot">
	<div class="container">
		<div class="row">
			<div class="span3">
				<h3>Une appli...</h3>
				<p>Appli <em>Caramboles et confinement</em> (GPL V3)</p>
					
			</div>

			<div class="span3">
				<h3>...ouverte...</h3>
				<p>
				Cette application a été écrite avec des sources ouvertes et des logiciels libres. C'est important !
				<br/>
				<a rel="source" href="https://github.com/tounoki">Lien à venir</a>
				</p>				
			</div>

			<div class="span3">
				<h3>...créée par</h3>
				<p>L'équipe du musée d'art et d'histoire de Saint-Brieuc
				</p>
				<p>A retrouver sur facebook</p>	
			</div>


		</div>

	</div>


</footer>

</body></html>
