<?php
$db = new PDO('sqlite:articles.sqlite');

$stmt = $db->query("SELECT DISTINCT annee FROM Listearticles ORDER BY annee");
$years = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($years);
?>