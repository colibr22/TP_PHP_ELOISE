<?php
require '../Model/pdo.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM etudiants WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$etudiant) {
        echo "Étudiant non trouvé.";
        exit;
    }
} else {
    echo "ID invalide.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    $sql = "UPDATE etudiants SET nom = ?, prenom = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$nom, $prenom, $id])) {
        echo "Modification réussie !";
    } else {
        echo "Erreur lors de la modification.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier Étudiant</title>
</head>
<body>
    <h2>Modifier l'Étudiant</h2>
    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($etudiant['nom']) ?>" required><br>

        <label>Prénom :</label>
        <input type="text" name="prenom" value="<?= htmlspecialchars($etudiant['prenom']) ?>" required><br>

        <input type="submit" value="Mettre à jour">
    </form>
    <br>
    <a href="../liste_etudiants.php">Retour à la liste</a>
</body>
</html>

</body>
</html>