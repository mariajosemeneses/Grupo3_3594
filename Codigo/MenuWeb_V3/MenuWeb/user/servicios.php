<?php

require 'includes/user/agregarP.php';

$servicios = obtenerMenu();

//var_dump($servicios);

echo json_encode($servicios);

