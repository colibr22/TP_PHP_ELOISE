<?php
require '../Model/pdo.php';
?>
            
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des données</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="../index.php">Retour TP9</a>
    <a href="../Views/registre.php">Créer un compte</a>
    <a href="../Views/login.php">Se connecter</a>

    <h1>Liste des étudiants et de leurs classes</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Classe</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT etudiants.nom, etudiants.prenom, classes.libelle AS classe 
                    FROM etudiants 
                    INNER JOIN classes ON etudiants.classe_id = classes.id";
            $stmt = $dbPDO->prepare($sql);
            $stmt->execute();
            $etudiants_classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($etudiants_classes as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['nom']) ?></td>
                    <td><?= htmlspecialchars($item['prenom']) ?></td>
                    <td><?= htmlspecialchars($item['classe']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    
    <h1>Professeurs avec leurs matières et leurs classes</h1>
    <table>
        <thead>
            <tr>
                <th>Professeur</th>
                <th>Matière</th>
                <th>Classe</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT professeurs.prenom, professeurs.nom, matiere.lib AS matiere, classes.libelle AS classe 
                    FROM professeurs 
                    INNER JOIN matiere ON professeurs.id_matiere = matiere.id 
                    INNER JOIN classes ON professeurs.id_classe = classes.id";
            $stmt = $dbPDO->prepare($sql);
            $stmt->execute();
            $profs_matiere_classe = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($profs_matiere_classe as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['prenom']) . ' ' . htmlspecialchars($item['nom']) ?></td>
                    <td><?= htmlspecialchars($item['matiere']) ?></td>
                    <td><?= htmlspecialchars($item['classe']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
