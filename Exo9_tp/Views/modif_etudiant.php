<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    require '../Model/pdo.php';
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT nom, prenom FROM etudiants WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($etudiant) {
            ?>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>Modifier un étudiant</title>
            </head>
            <body>
                <h1>Modifier les informations de l'étudiant</h1>
                <form action="modif_etudiant.php?id=<?= $id ?>" method="POST">
                    <input type="text" placeholder="Nom" name="nom" value="<?= htmlspecialchars($etudiant['nom']) ?>" required>
                    <input type="text" placeholder="Prenom" name="prenom" value="<?= htmlspecialchars($etudiant['prenom']) ?>" required>
                    <button type="submit">Modifier</button>
                </form>
            </body>
            </html>
            <?php
        } else {
            echo "Étudiant introuvable.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "ID invalide.";
}
echo '<br><a href="../index.php">Retour à la page principale</a>';

?>
