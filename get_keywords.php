<?php
// Connexion à la base de données SQLite
$db = new PDO('sqlite:articles.sqlite');

// Requête pour obtenir les mots clés
$query = 'SELECT DISTINCT motscles FROM motscles';
$result = $db->query($query);

// Créer un tableau pour stocker les mots-clés
$keywords = array();

foreach ($result as $row) {
    $keywords[] = $row['motscles'];
}

// Retourner les mots-clés sous forme de JSON
echo json_encode($keywords);
?>
