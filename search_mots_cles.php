<?php
$db = new PDO('sqlite:../articles.sqlite');

$query = $_GET['query'];
$stmt = $db->prepare("SELECT DISTINCT field1 FROM MotsCles WHERE field1 LIKE ? ORDER BY field1");
$stmt->execute(['%' . $query . '%']);
$motsCles = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($motsCles);
?>
