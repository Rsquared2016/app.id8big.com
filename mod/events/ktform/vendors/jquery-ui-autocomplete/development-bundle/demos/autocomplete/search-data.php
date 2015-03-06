<?php

$q = strtolower($_GET["term"]);


$result = array(
		//Separador.
  		array(
            "text" => "Usuarios",
  			"rel" => "ignore",
  			"type" => "li-events-header",
          ),
  		array(
  			//Does we need the label and value ?
  			"url" => "http://www.facebook.com/profile.php?id=100000348706861",
            "icon" => "http://profile.ak.fbcdn.net/hprofile-ak-snc4/48823_100000348706861_8223391_q.jpg",
            "subtext" => "3 amigos en comun",
            "text" => "Juan Carrivale", //label
            "type" => "user",
            "guid" => 100000348706861 //value
          ),
          array(
          	"url" => "http://www.facebook.com/profile.php?id=100001778793894",
            "icon" => "http://profile.ak.fbcdn.net/hprofile-ak-snc4/195464_100001778793894_6340034_q.jpg",
            "subtext" => "4 amigos en comun",
            "text" => "Juan Carlos Cadena",
            "type" => "user",
            "guid" => 100001778793894
          ),
          array(
          	"url" => "http://www.facebook.com/jcpreti",
            "icon" => "http://profile.ak.fbcdn.net/static-ak/rsrc.php/v1/yo/r/UlIqmHJn-SK.gif",
            "subtext" => "3 amigos en comun",
            "text" => "Juan Carlos Preti",
            "type" => "user",
            "guid" => 1405571538
          ),
          array(
          	"alternates" => "patto",
            "category" => "Ciudad de Santa Fe",
            "url" => "http://www.facebook.com/jcporpatto",
            "icon" => "http://profile.ak.fbcdn.net/hprofile-ak-snc4/161820_1083338478_6133905_q.jpg",
            "subtext" => "1 amigo en comun",
            "text" => "Juan Carlos Porpatto",
            "type" => "user",
            "guid" => 1083338478
          ),
		//Separador.
  		array(
            "text" => "Page",
  			"rel" => "ignore",
  			"type" => "li-events-header",
          ),
          array(
          	"alternates" => "musico/banda",
            "category" => "Musico/Banda",
            "url" => "http://www.facebook.com/pages/Juan-Carlos-Baglietto/35736681214",
            "icon" => "http://profile.ak.fbcdn.net/hprofile-ak-snc4/71179_35736681214_8025752_q.jpg",
            "subtext" => "A 4.658 personas les gusta esto.",
            "text" => "Juan Carlos Baglietto",
            "type" => "page",
            "guid" => 35736681214
          ),
          array(
          	"alternates" => "musico/banda",
            "category" => "Musico/Banda",
            "url" => "http://www.facebook.com/pages/Juan-Carlos-Batman/24284652250",
            "icon" => "http://profile.ak.fbcdn.net/hprofile-ak-snc4/50254_24284652250_245_q.jpg",
            "subtext" => "A 39.170 personas les gusta esto.",
            "text" => "Juan Carlos Batman",
            "type" => "page",
            "guid" => 24284652250
          ),
          array(
          	"url" => "http://www.facebook.com/profile.php?id=1370376928",
            "icon" => "http://profile.ak.fbcdn.net/static-ak/rsrc.php/v1/yo/r/UlIqmHJn-SK.gif",
            "subtext" => "",
            "text" => "Juan Carlos Dieguez",
            "type" => "user",
            "guid" => 1370376928
          ),
		//Separador.
  		array(
  			"url" => "search/?q=$q",
            "text" => "Ver mas resultados para $q",
  			"rel" => "ignore",
  			"type" => "li-events-footer",
          ),

);


echo json_encode($result);

?>
