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
        <?php
            $sql = "SELECT nom, prenom FROM etudiants";
            $stmt = $dbPDO->prepare($sql);
            $stmt->execute();
            $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($etudiants as $etudiant) {
                echo "<li>" . htmlspecialchars($etudiant['prenom']) . " " . htmlspecialchars($etudiant['nom']) . "</li>";
            }
        ?>
        
    </ul>
</body>
</html>
