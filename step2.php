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

//API
// à coder en constantes globales dans fichier de config pour après
/*
$apiName = "deepapi" ; // deepapi | ovh
$apiUrl = 'https://api.deepai.org/api/colorizer' ;
$apiKey = "" ;
*/
$apiName = "ovh" ; // deepapi | ovh
$apiUrl = "https://api-market-place.ai.ovh.net/image-colorization" ;
$apiKey = "" ;

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
		
<h2 style="text-align:center" ><img alt="Choisis ton slogan puis crée ta carte postale" src="includes/step2.png" /></h2>

<!-- ################################################ CODE #####################################-->


<?php

include('./includes/inc.functions.php') ;

// on récupéère l'adresse de l'image avec filtre
$imageSelectedName = dataClean( $_REQUEST['image'] ,"ALnum") ;
$imageSelectedSrc = "http://museo.tounoki.org/omeka/sideload/" . $imageSelectedName ;

$buffer = url_exists($imageSelectedSrc) ;
if ( $buffer === false ) die('Oups une erreur est arrivée...') ; // test existence du fichier image


if ( empty($apiUrl) || empty($apiName) || empty($apiKey) ) die('Vous devez configurer l API de colorisation') ;

// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
$ch = curl_init();

if ( $apiName == "deepapi" ) {
	
	curl_setopt($ch, CURLOPT_URL, $apiUrl );
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"image=$imageSelectedSrc");

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$headers = array();
	$headers[] = $apiKey ;
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = json_decode( curl_exec($ch) ) ;

	// on extrait l'adresse www de l'image colorisée
	$imageColoriseSrc = $result->output_url ;

	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
}

if ( $apiName == "ovh" ) {

	// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/ mais pas que pq j'ai transpiré aussi un peu sur l'API
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $apiUrl );
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"url\":\"$imageSelectedSrc\",\"render_factor\":35}") ;

	$headers = array();
	$headers[] = 'Accept: image/jpg';
	$headers[] = $apiKey ;
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$result = curl_exec($ch);

	$temp = imagecreatefromstring( $result ) ;
	$temp2 = image_resize( $temp , 800, 800 ) ;

	if (curl_errno($ch)) {
		header('content-type:text/html');
		echo 'Error:' . curl_error($ch);
		die() ;
	}
	$nameTemp = random_string(6) ;
	imagejpeg( $temp2 , "./temp/$nameTemp.jpg" ) ;
	$imageColoriseSrc = $racine."/temp/$nameTemp.jpg" ; // mettre chemin complet / à faire
	curl_close($ch);
}

$legende = array(
	"Mon secret contre l'adversité, c'est ma joie de vivre",
	"Jardinage, yoga, méditation... et j'ai toujours envie de giffler quelqu'un",
	"Commencez chaque jour par un sourire, après c'est selon l'humeur...",
	"Après le confinement, j'arrête !",
	"On entend les oiseaux chanter !",
	"Nous pensions que le monde pouvait continuer ainsi indéfiniment...",
	//"Mieux vaut être belle et rebelle que moche et re-moche",
	//"Après le confinement, je me rase la moustache",
	//"Des vacances, c'est ça qu'il nous faut...",
	"Avec la couleur, on va mieux...",
	//"Soyons fous",
	//"Tu me vois bouger ?",
	//"Cache tes pouvoirs, n'en parle pas \nFais attention, le secret survivra...",
	//"Protégez-vous !",
	//"J'ai un sentiment d'éternité...",
	"Même confiné.e, je me pomponne",
	//"Même confiné, je me pomponne",
	"On a dit rassemblements interdits !",
	//"Pas sûr pour les 1 mètre de distance...",
	//"Pas sûre pour les 1 mètre de distance...",
	//"Mon plus beau costume, rien que pour aller faire les courses !",
	//"Promis, je suis sage pendant que maman télé-travaille",
	//"Vous avez dit distanciation sociale ?",
	//"Mais siiiii, on se tient à carreaux pendant que papa télé-travaille",
	//"Sages comme des images...",
	//"On s'amuse comme on peut à la maison",
	"L'école à la maison, c'est relax...",
	//"En fait, c'est un fond peint... Sinon en vrai on est confiné.e.s",
	"Ma plus belle robe, juste pour sortir les poubelles !",
	//"Ça, c'est moi quand je regarde au loin mon weekend à Rome pour les vacances de Pâques",
	//"Oup's, j'ai oublié qu'une barbe, ça pousse...",
	//"Nouveau look pour intérieur élégant",
	"Ça va ! On est juste descendu dans la cour pour la photo...",
	//"Tranquille Émile, zen à la maison !",
	//"Le temps pour réviser ses classiques",
	"Le temps de l'introspection...",
	//"Vous avez dit Baby-boom ?",
	"On a dit toujours sur soi l'attestation de sortie",
	"Ma plus belle redingote pour descendre chercher le courrier !",
	//"Le temps de tester de nouvelles coiffures...",
	//"Pile, c'est moi, face, c'est toi qui sort pour faire les courses",
	//"Je vous présente mon nouvel ami, le tabouret",
	//"Je vous présente ma nouvelle amie, la chaise",
	//"Et vous, vous faites quoi pendant le confinement ?",
	//"Mon plus beau chapeau, même à l'intérieur, NA !",
	//"Sois la source qui répand la lumière, tel un phare",
	"Notre raison de vivre est de jouir de chaque instant"
	) ;
?>

<br/><br/>

<div style="float:left;margin:10px">
<img style="max-width:200px;max-height:200px" src="<?php echo $imageSelectedSrc ?>" />
</div>

<?php
if ( !empty($imageColoriseSrc) ) {
	?>
	<div style="float:left;margin:10px">
	<img style="max-width:450px;max-height:450px" src="<?php echo $imageColoriseSrc ?>" />
	</div>
	<?php 
}
else {
	echo "<h2>Notre intelligence artificielle a été trop artificielle... et n'a pas pu colorier votre choix... revenez demain...</h2>" ;
}

?>


<hr style="clear:both">

<div class="swiper-container">
  <div class="swiper-wrapper">
      <!--First Slide-->
		<?php
		foreach ($legende as $slide) {
			echo '<div class="swiper-slide">' ;
			echo '<h3 style="padding:0 50px 0 50px">'.nl2br($slide).'</h3></div>' ;
		}
	  
	  ?>
	  
      <!--Etc..-->
  </div>
  <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

<form action="step3.php" method="post">

	<div class="button">
        <button type="submit" onClick="newSlide(mySwiper);return false;" >Afficher mon slogan</button>
		<button type="submit" >Créer ma carte postale</button>
    </div>
	<div>
        <label for="slogan">Pour personnaliser la phrase qui accompagne l'image, taper votre texte ci-dessous puis cliquer sur <em>Afficher mon slogan</em>
		<br/>
		Si le résultat vous satisfait vous pouvez ensuite <em>Créer la carte postale</em></label>
        <textarea id="slogan" name="slogan" placeholder="Vous pouvez écrire ici un slogan personnalisé..."></textarea>
    </div>
	
	<input type="hidden" id="txtA" name="txtA" size="200" /><br/>
	<input type="hidden" id="sloganText" name="sloganText" size="200" /><br/>
	<input type="hidden" id="imageColoriseSrc" name="imageColoriseSrc" size="200" value="<?php echo $imageColoriseSrc ?>" /><br/>
	<input type="hidden" id="imageSelectedName" name="imageSelectedName" size="200" value="<?php echo $imageSelectedName ?>" /><br/>
	
</form>

<!-- ################################################ CODE #####################################-->

</div> <!-- close container -->
</div> <!-- close content -->
</div> <!-- close content -->
</div> <!-- close content -->
</div> <!-- close content -->

<script>
var mySwiper = new Swiper ('.swiper-container', {
    // options here
	init: true,
	direction: 'horizontal',
	touchEventsTarget: 'container',
	initialSlide: 0,
	speed: 300,
	uniqueNavElements: true,
	navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
	loop: true,
}) ;

<?php
$rand = rand ( 0 , count($legende) ) ;
?>
mySwiper.slideTo( <?php echo $rand ?> , 300 , true ) ;

function newSlide( mySwiper ) {
	mySwiper.addSlide( mySwiper.realIndex +1 , '<div class="swiper-slide"><h3 style="padding:0 50px 0 50px">'+  $('#slogan').val() +'</h3></div>')  ;
	mySwiper.slideTo( mySwiper.realIndex +2 , 300 , true ) ;
};

mySwiper.on('slideChange', function () {
	console.log( mySwiper.realIndex ) ;
	$('#txtA').val('index du slide :' + mySwiper.realIndex ) ;
	var i = mySwiper.realIndex + 2 ;
	$('#sloganText').val( $("div.swiper-wrapper div:nth-child(" + i +")").text() ) ;
	$('#slogan').val("") ;
});
 
// initialise le texte en cache ds le formulaire (bug du premier message vide avant manip')
$('#txtA').val('index du slide :' + mySwiper.realIndex ) ;
var k = mySwiper.realIndex + 2 ;
$('#sloganText').val( $("div.swiper-wrapper div:nth-child(" + k +")").text() ) ;

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
