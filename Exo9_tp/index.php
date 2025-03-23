<?php
require 'Model/pdo.php';

$query = $pdo->query("SELECT nom, prenom FROM etudiants");
$etudiants = $query->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Liste des étudiants :</h2>";
echo "<ul>";
foreach ($etudiants as $etudiant) {
    echo "<li>" . htmlspecialchars($etudiant['nom']) . " " . htmlspecialchars($etudiant['prenom']) . "</li>";
}
echo "</ul>";
?>
