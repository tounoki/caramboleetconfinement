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
	<!-- jquery lazy chargement d'images -->
    <script type="text/javascript" src="includes/jquery.lazy.min.js"></script>
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
		
<h2>Le fonds Lucien Bailly</h2>

<!-- ################################################ CODE #####################################-->

<?php
include('./includes/inc.functions.php') ;
?>


<h3>Lucien Bailly, photographe briochin</h3>

<p>Photographe de l'aristocratie et de la modernité urbaine, Lucien Bailly (1881-1975) est avant tout reconnu pour ses qualités de portraitiste. C'est à Lamballe qu'il se forme à la technique photographique dans le studio de son père Auguste, avant de rejoindre l'atelier briochin d'Eresby-Snow. Un passage en tant qu'apprenti à l'atelier Fréon (Neuilly-sur-Seine), lui permet de parfaire sa formation avant de rentrer en 1912 en Bretagne installer son studio au 49 rue de la gare à Saint-Brieuc.
</p>
<p>Artisan-photographe, Lucien Bailly reçoit dans son studio l'aristocratie locale pour qui la photographie apparaît comme un moyen d'affirmation d'un statut social. La clientèle se presse pour immortaliser les grands moments de la vie : naissance, communion, apogée d'une carrière, mariage... Les mises en scène de ses client.e.s sont réalisées devant des fonds peints, rythmés par quelques accessoires les aidant à assumer des poses longues (chaise, prie-dieu, console...). Il en résulte un ensemble de portraits similaires mais différents, comme des variations sur un même thème.
Témoin des mutations industrielles, il s'adonne également à la photographie de reportage. La gare ferroviaire et ses cheminots, les Forges et Laminoirs et leurs ouvriers, ou encore les mines de plomb à Trémuson et leurs mineurs, sont autant de modèles et de décors venant dresser un portrait social et industriel de la ville et de ses environs.</p>

<h3>Un fonds conservé au musée d'art et d'histoire de Saint-Brieuc</h3>

<p>Le fonds Lucien Bailly comprend environ 10 000 pièces dont 7 000 négatifs (4500 sur plaques de verre au gélatino-bromure d'argent), des épreuves papiers simples ou à la gomme bichromatée. Les cahiers de comptes et de commandes du photographe, ainsi que divers documents complètent ce fonds provenant d'une donation de sa fille en 1991.</p>

<h3>Un travail sur les archives au présent</h3>

<p>Depuis 2016, nous travaillons en collaboration avec la Société des ami.e.s du musée de Saint-Brieuc sur le fonds photographique Lucien Bailly. La majeure partie des 8000 à 9000 plaques de verre a été nettoyée, numérisée et inventoriée lors d’ateliers avec les adhérent.e.s de l’association, qui ont à cette occasion été formé.e.s à la conservation préventive selon les normes muséales. Mener ce chantier des collections avec l’aide du public permet de faire vivre le patrimoine différemment et d’en partager la responsabilité. Dans la continuité de cette démarche, le musée encourage les publics à créer leurs propres usages de ce patrimoine partagé, lors d’événements comme <a href="http://museomixouest.org" target="_blank">Muséomix</a> ou en ligne ici même !</p>

<hr style="clear:both">

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
