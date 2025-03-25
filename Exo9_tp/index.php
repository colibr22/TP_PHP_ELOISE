<?php
require 'Model/pdo.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
</head>
<body>
    <h1>Liste des étudiants</h1>
    <ul>
        <?php foreach ($etudiants as $etudiant): ?>
            <li><?= htmlspecialchars($etudiant['prenom'] . ' ' . $etudiant['nom']) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
