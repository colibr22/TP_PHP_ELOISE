<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require '../Model/pdo.php';

    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['id_classe'])) {
    $stmt = $pdo->prepare("INSERT INTO etudiants (nom, prenom, id_classe) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['id_classe']]);
    echo "Étudiant ajouté avec succès ! <br><a href='../index.php'>Retour</a>";
    }
    ?>

</body>
</html>