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

<?php
$query = $pdo->query("SELECT professeurs.nom AS prof_nom, professeurs.prenom AS prof_prenom, matieres.nom_matiere, classes.nom_classe
    FROM professeurs
    INNER JOIN matieres ON professeurs.id_matiere = matieres.id
    INNER JOIN classes ON matieres.id_classe = classes.id
");
$professeurDetails = $query->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Professeurs avec leur matière et classe :</h2>";
echo "<ul>";
foreach ($professeurDetails as $detail) {
    echo "<li>" 
        . htmlspecialchars($detail['prof_nom']) . " " . htmlspecialchars($detail['prof_prenom']) 
        . " enseigne " . htmlspecialchars($detail['nom_matiere']) 
        . " pour la classe " . htmlspecialchars($detail['nom_classe']) 
        . "</li>";
}
echo "</ul>";
?>
