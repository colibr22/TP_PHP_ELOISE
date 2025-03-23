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

<?php
$query = $pdo->query("SELECT nom_classe FROM classes");
$classes = $query->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Liste des classes :</h2>";
echo "<ul>";
foreach ($classes as $classe) {
    echo "<li>" . htmlspecialchars($classe['nom_classe']) . "</li>";
}
echo "</ul>";
?>

<?php
$query = $pdo->query("SELECT nom, prenom FROM professeurs");
$professeurs = $query->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Liste des professeurs :</h2>";
echo "<ul>";
foreach ($professeurs as $professeur) {
    echo "<li>" . htmlspecialchars($professeur['nom']) . " " . htmlspecialchars($professeur['prenom']) . "</li>";
}
echo "</ul>";
?>
