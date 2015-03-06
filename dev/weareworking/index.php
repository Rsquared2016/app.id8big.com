<?php
	header('HTTP/1.1 503 Service Temporarily Unavailable',true,503);
	header('Status: 503 Service Temporarily Unavailable');
	//Le decimos a los buscadores que traten de intentarlo a las 2 hora.
	header('Retry-After: 7200');

	/* Maqueteishon Framework 05/01/10 */

	/* META TAGS */
	define ("META_LANG", "es");
	define ("CHARSET", "UTF-8");
	define ("DESCRIPTION", "En construcción");
	define ("KEYWORDS", "En construcción");
	define ("TITLE", "En construcción");
	define ("AUTHOR", TITLE);
	
	//Change this URL.
	define ("RESOURCES_URL", 'http://local/elggbase/dev/weareworking/');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo META_LANG ?>" lang="<?php echo META_LANG ?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET ?>" />
<meta name="title" content="<?php echo TITLE ?>" />
<meta name="description" content="<?php echo DESCRIPTION ?>" />
<meta name="keywords" content="<?php echo KEYWORDS ?>" />
<meta name="language" content="<?php echo META_LANG ?>" />
<meta http-equiv="Content-Language" content="<?php echo META_LANG ?>" />
<meta name="revisit-after" content="7 days" />
<meta name="robot" content="Index,Follow" />
<meta name="robot" content="All" />
<meta name="Distribution" content="Global" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta name="rating" content="general" />
<meta name="author" http-equiv="Author" content="<?php echo AUTHOR?>"/>
<link rel="icon" type="image/x-icon" href="favicon.ico" />
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" href="styles.css" media="screen" rel="stylesheet" />
<title><?php echo TITLE;?></title>
<style>
@charset "utf-8";
/* Modified Meyer CSS reset (http://meyerweb.com/eric/tools/css/reset/) */
/* [G] - 08/03/2010 */
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, font, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td {
	margin: 0;
	padding: 0;
	border: none;
	outline: none;
	vertical-align: baseline;
	font-weight: normal;
}
input,
textarea {
	margin: 0;
	padding: 0;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before,
blockquote:after,
q:before,
q:after {
	content: '';
	content: none;
}
/* remember to define focus styles! */
:focus {
	outline: none;
}
/* remember to highlight inserts somehow! */
ins {
	text-decoration: none;
}
del {
	text-decoration: line-through;
}
/* tables still need 'cellspacing="0"' in the markup */
table {
	border-collapse: collapse;
	border-spacing: 0;
}
/* [G] I don't like anchor image borders... */
a img {
	border: none;
}
/*****************************************/
/* [G] Maqueteishon Framework Stylesheet */
/*****************************************/
body {
	/* 1em = 10px | 1.2em = 12px | 2em = 20px | etc. */
	font-size: 62.5%;
    background: url(<?php echo RESOURCES_URL ?>img/fon-body.png) 0 0 repeat-x #dbdcdb;
    font-family: Arial, Helvetica, sans-serif;
}
/* containers */
#container {
    height: 515px;
	margin: 0 auto;
    background: url(<?php echo RESOURCES_URL ?>img/img-en-construccion.jpg) 50% 0 no-repeat;
}
#container #globo {
    height: 124px;
    width: 272px;
	position: absolute;
    left: 50%;
    top: 20px;
    margin-left: -366px;
    background: url(<?php echo RESOURCES_URL ?>img/img-globo.png) 0 0 no-repeat;
}
#container #globo h1 {
    color: #000;
    font-size: 2.2em;
    font-weight: bold;
    padding: 35px 0 0 0;
    text-align: center;
}
/***********/
/* helpers */
/***********/
.limpia,
.cThis {
	clear: both;
	font-size: 0;
	height: 0;
	line-height: 0;
}
/* margins */
.nm {
	margin: 0 !important;
}
.nmRig {
	margin-right: 0 !important;
}
.nmLef {
	margin-left: 0 !important;
}
.nmTop {
	margin-top: 0 !important;
}
.nmBot {
	margin-bottom: 0 !important;
}
/* borders */
.nb {
	border: none !important;
}
.nbRig {
	border-right: none !important;
}
.nbLef {
	border-left: none !important;
}
.nbTop {
	border-top: none !important;
}
.nbBot {
	border-bottom: none !important;
}
/* paddings */
.np {
	padding: 0 !important;
}
.npRig {
	padding-right: 0 !important;
}
.npLef {
	padding-left: 0 !important;
}
.npTop {
	padding-top: 0 !important;
}
.npBot {
	padding-bottom: 0 !important;
}
/* background */
.nBg {
	background: none !important;
}
/* floats */
.flRig {
	float: right !important;
}
.flLef {
	float: left !important;
}
.flN {
	float: none !important;
}
/* font style */
.fsI {
	font-style: italic;
}
.fsU {
	text-decoration: underline;
}
.fsB {
	font-weight: bold;
}
/* do not show */
.no,
hr {
	display: none !important;
}
</style>
</head>
<body>
	<div id="container">
		<div id="globo"><h1>We are working!</h1></div>
	</div>
</body>
</html>