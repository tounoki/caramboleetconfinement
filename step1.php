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
		
<h2 style="text-align:center" ><img alt="1. Choisis une image et clique dessus" src="includes/step1.png" /></h2>

<h2>En cours de développement, des fois ça ne marche pas...</h2>

<!-- ################################################ CODE #####################################-->


<?php

include('./includes/inc.functions.php') ;

// le fichier de data
// filtre protrait
$file = 'https://datarmor.cotesdarmor.fr/data-unpaginated/dataserver/cg22/data/22278_MuseeFondsBailly?$format=json&$filter=substringof(tolower(\'portrait\'),tolower(Reprsentations))' ;
// tout
//$file = 'https://datarmor.cotesdarmor.fr:443/data-unpaginated/dataserver/cg22/data/22278_MuseeFondsBailly?&$format=json' ;


// mettre le contenu du fichier dans une variable
$data = file_get_contents($file); 
// décoder le flux JSON
$obj = json_decode($data); 
//print_r($obj) ;
// accéder à 1 image au hasard
$rand = rand ( 0 , count($obj->d->results)-12 ) ;
$imageSelectedSrc = $obj->d->results[$rand]->Image ;


?>
<hr style="clear:both">
<?php
// step choisir une image
echo '<ul class="resource-list">' ;
for ($i = 0; $i < 12 ; $i++) {
	$buffer = explode( "/" , $obj->d->results[$rand+$i]->Image ) ; // debug de -> Strict Standards: Only variables should be passed by reference
	$imageSelectedName = end ( $buffer );
	echo '	    <li style="float:left;width:220px;height:240px;text-align:center" class=" ">' ;
	echo '		<a rel="tooltip" title="" href="step2.php?image='.$imageSelectedName.'">
				<img style="max-width:200px;max-height:200px;" src="'.$obj->d->results[$rand+$i]->Image.'" alt="">
				</a>' ;     
	echo '		<div>' ;
	echo '			<span  style="font-size:0.7em ;" ><a href=""></a></span>' ;
	echo '						<div class="check" ></div>' ; // check ou pas
	echo "		</div>\n    </li>\n" ;
}

echo "</ul>\n" ;

// on vide la mémoire, comme ça quoi, ça m'a pris une petite gestion mémoire...
$data = NULL ; $obj = NULL ;

?>
<hr style="clear:both">



<!-- ################################################ CODE #####################################-->

</div> <!-- close container -->
</div> <!-- close content -->
</div> <!-- close content -->
</div> <!-- close content -->
</div> <!-- close content -->


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
