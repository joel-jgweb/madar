<?php
$db = new PDO('sqlite:articles.sqlite');

$stmt = $db->query("SELECT DISTINCT Auteurs FROM Listearticles ORDER BY Auteurs");
$authors = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($authors);
?>