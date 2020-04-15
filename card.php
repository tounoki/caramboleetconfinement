<?php

include('./includes/inc.functions.php') ;

// on récupéère l'adresse de l'image avec filtre
$postcardId = dataClean( $_REQUEST['id'] ,"ALnum") ;

// bascule du fichier temporaire en fichier définitif si besoin
$postcardTemp = "temp/$postcardId.jpg" ;
$postcardSrc = "galerie/$postcardId.jpg" ;

if ( file_exists( $postcardTemp ) ) {
	rename( $postcardTemp , $postcardSrc ) ;
	rename( "temp/$postcardId.json" , "galerie/$postcardId.json" ) ;
}


$postcardSrc = "galerie/$postcardId.jpg" ;
if ( !file_exists( $postcardSrc ) ) {
	$postcardId = "00000404" ;
	$postcardSrc = "galerie/$postcardId.jpg" ;
	$titre = ", la fameuse 404" ;
} else $titre = "" ;

// tout
$file = "galerie/$postcardId.json" ;
// mettre le contenu du fichier dans une variable
$data = file_get_contents($file);
// décoder le flux JSON
$obj = json_decode($data); 
//print_r($obj) ;
// recomposition des éléments json
$imageSelectedName = $obj->Image ;
$imageSelectedSrc = "http://museo.tounoki.org/omeka/sideload/" . $imageSelectedName ;
// la carte : slogan + image

// on récupéère le texte-slogan
$sloganText = $obj->sloganText ;

?>
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
	<!-- RSN -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="Carambole & confinement">
	<meta name="twitter:image" content="http://museo.tounoki.org/test/<?php echo $postcardSrc ?>">
	
	<meta property="og:title" content="Carambole & confinement">
	<meta property="og:image" content="http://museo.tounoki.org/test/<?php echo $postcardSrc ?>" >
	<meta property="og:image:type" content="image/jpeg" />
	
	<link rel="stylesheet" href="includes/rsn-share.css">
	
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
		
<h2>Une carte à partager<?php echo $titre ?></h2>

<!-- ################################################ CODE #####################################-->

<img alt="<?php echo $sloganText ?>" src="<?php echo $postcardSrc ?>" />

<br/><br/>

<?php
// page courante
$here = "http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF']."?id=".$postcardId ;
// version lien court - ne marche qu'avec le htaccess valide
$here = str_replace( ".php?id=" , "-" , $here ) ;
?>

<!-- via https://sharingbuttons.io/ -->

<!-- Sharingbutton Facebook -->
<a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=<?php echo $here ; ?>" target="_blank" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>
    </div>
  </div>
</a>

<!-- Sharingbutton Twitter -->
<a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text=Un%20carambolage%20cr%C3%A9%C3%A9%20au%20mus%C3%A9e%20de%20Saint-Brieuc&amp;url=<?php echo $here ; ?>" target="_blank" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/></svg>
    </div>
  </div>
</a>

<!-- Sharingbutton Tumblr -->
<a class="resp-sharing-button__link" href="https://www.tumblr.com/widgets/share/tool?posttype=link&amp;title=Un%20carambolage%20cr%C3%A9%C3%A9%20au%20mus%C3%A9e%20de%20Saint-Brieuc&amp;caption=Un%20carambolage%20cr%C3%A9%C3%A9%20au%20mus%C3%A9e%20de%20Saint-Brieuc&amp;content=<?php echo $here ; ?>&amp;canonicalUrl=<?php echo $here ; ?>&amp;shareSource=tumblr_share_button" target="_blank" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--tumblr resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.5.5v5h5v4h-5V15c0 5 3.5 4.4 6 2.8v4.4c-6.7 3.2-12 0-12-4.2V9.5h-3V6.7c1-.3 2.2-.7 3-1.3.5-.5 1-1.2 1.4-2 .3-.7.6-1.7.7-3h3.8z"/></svg>
    </div>
  </div>
</a>

<!-- Sharingbutton E-Mail -->
<a class="resp-sharing-button__link" href="mailto:?subject=Un%20carambolage%20cr%C3%A9%C3%A9%20au%20mus%C3%A9e%20de%20Saint-Brieuc&amp;body=<?php echo $here ; ?>" target="_self" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--email resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22 4H2C.9 4 0 4.9 0 6v12c0 1.1.9 2 2 2h20c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM7.25 14.43l-3.5 2c-.08.05-.17.07-.25.07-.17 0-.34-.1-.43-.25-.14-.24-.06-.55.18-.68l3.5-2c.24-.14.55-.06.68.18.14.24.06.55-.18.68zm4.75.07c-.1 0-.2-.03-.27-.08l-8.5-5.5c-.23-.15-.3-.46-.15-.7.15-.22.46-.3.7-.14L12 13.4l8.23-5.32c.23-.15.54-.08.7.15.14.23.07.54-.16.7l-8.5 5.5c-.08.04-.17.07-.27.07zm8.93 1.75c-.1.16-.26.25-.43.25-.08 0-.17-.02-.25-.07l-3.5-2c-.24-.13-.32-.44-.18-.68s.44-.32.68-.18l3.5 2c.24.13.32.44.18.68z"/></svg>
    </div>
  </div>
</a>

<!-- Sharingbutton Pinterest -->
<a class="resp-sharing-button__link" href="https://pinterest.com/pin/create/button/?url=<?php echo $here ; ?>&amp;media=<?php echo $here ; ?>&amp;description=Un%20carambolage%20cr%C3%A9%C3%A9%20au%20mus%C3%A9e%20de%20Saint-Brieuc" target="_blank" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--pinterest resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12.14.5C5.86.5 2.7 5 2.7 8.75c0 2.27.86 4.3 2.7 5.05.3.12.57 0 .66-.33l.27-1.06c.1-.32.06-.44-.2-.73-.52-.62-.86-1.44-.86-2.6 0-3.33 2.5-6.32 6.5-6.32 3.55 0 5.5 2.17 5.5 5.07 0 3.8-1.7 7.02-4.2 7.02-1.37 0-2.4-1.14-2.07-2.54.4-1.68 1.16-3.48 1.16-4.7 0-1.07-.58-1.98-1.78-1.98-1.4 0-2.55 1.47-2.55 3.42 0 1.25.43 2.1.43 2.1l-1.7 7.2c-.5 2.13-.08 4.75-.04 5 .02.17.22.2.3.1.14-.18 1.82-2.26 2.4-4.33.16-.58.93-3.63.93-3.63.45.88 1.8 1.65 3.22 1.65 4.25 0 7.13-3.87 7.13-9.05C20.5 4.15 17.18.5 12.14.5z"/></svg>
    </div>
  </div>
</a>

<hr style="clear:both">

<p>Cette image est issue du fonds photographique Lucien Bailly. 
Ce fonds est habituellement visible au musée d'art et d'histoire de Saint-Brieuc.
</p>
<p>La phrase qui l'accompagne a été choisie, voire inventée par un visiteur, comme vous, dans le temps présent, peut-être loin de l'historicité du document. Elle est la tentative de tisser un lien ou de créer une résonnance entre un objet photographique patrimonial et notre présent vécu, ressenti ici et maintenant.</p>
<p>
<strong>En outre, cette image en tant que telle n'existe pas</strong>, il s'agit d'une colorisation obtenue à partir du traitement informatique opéré par une "intelligence artificielle". N'hésitez pas à lire la page <a href="explications.php">Explications</a> pour en apprendre davantage.
<br/>
Vous retrouverez ci-dessous l'image originale ainsi que les données d'inventaire selon les normes muséales diffusées par le musée dans l'état actuel des connaissances.
</p>

<div style="float:left;width:250px;height:250px;padding:5px 10px 10px 10px;border:1px solid grey;text-align:center;margin-right:10px">
	<img style="max-width:230px;max-height:230px" alt="" src="<?php echo $imageSelectedSrc ?>" />
</div>


<?php

// requiert les data d'inventaire
$file = 'https://datarmor.cotesdarmor.fr/data-unpaginated/dataserver/cg22/data/22278_MuseeFondsBailly?$format=json&$filter=substringof(tolower(\''.$imageSelectedName.'\'),tolower(Image))' ;
// mettre le contenu du fichier dans une variable
$data = file_get_contents($file); 
// décoder le flux JSON
$obj = json_decode($data); 
// var_dump( $obj ) ;
// accéder à 1 image au hasard
// $obj->d->results[$rand]->Image ;

echo "<p><strong>Numéro d'inventaire</strong> {$obj->d->results[0]->intitul}</p>" ;
echo "<p><strong>Domaine</strong> {$obj->d->results[0]->Domaine}</p>" ;
echo "<p><strong>Dénomination</strong> {$obj->d->results[0]->Dnomination}</p>" ;
echo "<p><strong>Auteur</strong> {$obj->d->results[0]->Auteurexcutantcollecteur}</p>" ;
echo "<p><strong>Période de création</strong> {$obj->d->results[0]->Priodedecrationexcution}</p>" ;
echo "<p><strong>Matériaux et techniques</strong> {$obj->d->results[0]->Matriauxettechniques}</p>" ;
echo "<p><strong>Mesures</strong> {$obj->d->results[0]->Mesures}</p>" ;
echo "<p><strong>Inscriptions</strong> {$obj->d->results[0]->Inscriptions}</p>" ;
echo "<p><strong>Description</strong> {$obj->d->results[0]->Description}</p>" ;
echo "<p><strong>Représentations</strong> {$obj->d->results[0]->Reprsentations}</p>" ;
//echo "<p><strong>Type de propriété</strong> {$obj->d->results[0]->Typedeproprit}</p>" ;
echo "<p><strong>Type de propriété</strong> Propriété de la commune</p>" ;
echo "<p><strong>Modes d'acquisition</strong> {$obj->d->results[0]->Modesdacquisition}</p>" ;
echo "<p><strong>Institution propriétaire</strong> {$obj->d->results[0]->Institutionpropritaire}</p>" ;
echo "<p><strong>Etablissement affectataire</strong> {$obj->d->results[0]->Etablissementaffectataire}</p>" ;
echo "<p><strong>Licence</strong> {$obj->d->results[0]->LicenceImage}</p>" ;
echo "<p><strong>Source des données</strong> <a href=\"$file\">{$file}</a></p>" ;

?>

<hr style="clear:both">

<p>Et voici les mêmes informations telles qu'une machine aime les lire...</p>

<?php
echo "<pre>" ;
var_dump( $obj ) ;
echo "</pre>" ;
?>

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
