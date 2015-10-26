<?php

// twig template example

require_once 'vendor/autoload.php';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);


// Class Books
class m {
	public $lat = 0.0;
	public $lng = 0.0;

	public function __construct ($lat, $lng) {
		$this->lat = $lat;
		$this->lng = $lng;
	} 
};

include "conexion.php";

$markers = array();
            $stmt = "SELECT id_usuario,longitud,latitud,tiempo FROM posiciones where id_usuario='8'";
            $stmt2 = $pdo->prepare($stmt);
            $stmt2->execute();
            
                            foreach($stmt2->fetchAll(PDO::FETCH_ASSOC) as $row){
                            
                            $marker = new m ($row[latitud],$row[longitud]);
                            array_push($markers,$marker);
                            
                };

//$count = count($markers);
//var_dump($markers);

// render
echo $twig->render('index.html', array('markers' => $markers));

?>