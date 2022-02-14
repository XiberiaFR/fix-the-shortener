<?php

// Insert 

$baseUrl = 'http://'.$_SERVER['HTTP_HOST'].'/?q=';
$code = uniqid();

$query = $database->prepare('INSERT INTO urls (code, target) VALUES (:code, :target)');
$query->execute([
	':code' => $code,
	':target' => htmlspecialchars(filter_var($_GET['target'], FILTER_SANITIZE_URL), ENT_QUOTES, 'UTF-8'),
]);


// On retourne une url constituée de l'adresse de base + le code généré
// en cliquant sur celle-ci, on peut accéder au site

header('Content-Type: application/json');
die(json_encode([
	'url' => $baseUrl.$code
]));