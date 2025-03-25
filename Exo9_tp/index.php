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
    <h1>Partie 2</h1>
    <h3>Liste des étudiants</h3>
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
    <h3>Liste de toute les classes</h3>
    <ul>
        <?php
            $sql = "SELECT libelle FROM classes";
            $stmt = $dbPDO->prepare($sql);
            $stmt->execute();
            $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($classes as $classe) {
                echo "<li>" . htmlspecialchars($classe['libelle']) . "</li>";
            }
        ?>
    </ul>
    <h3>Liste de toute les professeurs</h3>
    <ul>
        <?php
            $sql = "SELECT nom, prenom FROM professeurs";
            $stmt = $dbPDO->prepare($sql);
            $stmt->execute();
            $profs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($profs as $prof) {
                echo "<li>" . htmlspecialchars($prof['prenom']) . " " . htmlspecialchars($prof['nom']) . "</li>";
            }
        ?>
    </ul>
    <h3>Proffesseurs avec leurs matieres et leurs classes</h3>
    <ul>
        <?php
            $sql = "SELECT professeurs.prenom, professeurs.nom, matiere.lib, classes.libelle FROM professeurs JOIN matiere ON professeurs.id_matiere = matiere.id JOIN classes ON professeurs.id_classe = classes.id;";
            $stmt = $dbPDO->prepare($sql);
            $stmt->execute();
            $profs_matiere_classe = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($profs_matiere_classe as $item) {
                echo "<li>" . htmlspecialchars($item['professeurs.prenom']) . " " . htmlspecialchars($item['professeurs.nom']) . " enseigne " . htmlspecialchars($item['matiere.lib']) . " dans la classe " . htmlspecialchars($item['classes.libelle']) . "</li>";
            }
        ?>
    </ul>
    <h1>Partie 3</h1>
    <form action="Views/nouvelle_matiere.php" method="POST">
    <input type="text" name="lib" placeholder="Nom de la matière" required>
    <button type="submit">Ajouter</button>
    </form>

</body>
</html>
