<?php
// Connexion à la base de données SQLite
$db = new PDO('sqlite:articles.sqlite');

// Vérifier si un mot-clé a été sélectionné
if (isset($_GET['keywords'])) {
    $keyword = $_GET['keywords'];

    // Requête pour rechercher les articles correspondant au mot clé
    $query = 'SELECT * FROM Listearticles WHERE MotsCles LIKE :keyword';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':keyword', '%' . $keyword . '%');
    $stmt->execute();

    // Récupérer les résultats et les afficher
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($articles);
}
?>
