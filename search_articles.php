<?php
$db = new PDO('sqlite:articles.sqlite');

$auteurs = $_GET['auteurs'] ?? '';
$annee = $_GET['annee'] ?? '';
$libelle = $_GET['libelle'] ?? '';
$motsCles = $_GET['motsCles'] ?? '';

$query = "SELECT Libellé, Auteurs, Trimestre, annee, Numeros, fichiers, adresse FROM Listearticles WHERE 1=1";
$params = [];

if ($auteurs) {
    $query .= " AND Auteurs LIKE ?";
    $params[] = '%' . $auteurs . '%';
}
if ($annee) {
    $query .= " AND annee = ?";
    $params[] = $annee;
}
if ($libelle) {
    $query .= " AND Libellé LIKE ?";
    $params[] = '%' . $libelle . '%';
}
if ($motsCles) {
    $query .= " AND MotsCles LIKE ?";
    $params[] = '%' . $motsCles . '%';
}

$stmt = $db->prepare($query);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
?>
