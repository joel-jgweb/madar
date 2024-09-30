<?php
// Connexion à la base de données SQLite
$db = new PDO('sqlite:articles.sqlite');

// Récupérer les paramètres du formulaire de recherche
$auteurs = $_GET['auteurs'] ?? '';
$annee = $_GET['annee'] ?? '';
$libelle = $_GET['libelle'] ?? '';
$motsCles = $_GET['motsCles'] ?? ''; // Paramètre de recherche par mots-clés

// Début de la requête SQL
$query = "SELECT Libellé, Auteurs, Trimestre, annee, Numeros, fichiers, adresse FROM Listearticles WHERE 1=1";
$params = [];

// Filtrage par auteurs
if ($auteurs) {
    $query .= " AND Auteurs LIKE ?";
    $params[] = '%' . $auteurs . '%';
}

// Filtrage par année
if ($annee) {
    $query .= " AND annee = ?";
    $params[] = $annee;
}

// Filtrage par libellé
if ($libelle) {
    $query .= " AND Libellé LIKE ?";
    $params[] = '%' . $libelle . '%';
}

// Filtrage par mots-clés
if ($motsCles) {
    $query .= " AND MotsCles LIKE ?";
    $params[] = '%' . $motsCles . '%';
}

// Préparation et exécution de la requête
$stmt = $db->prepare($query);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Retourner les résultats en format JSON
echo json_encode($results);
?>
