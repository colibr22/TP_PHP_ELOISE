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
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];

                    $update_sql = "UPDATE etudiants SET nom = :nom, prenom = :prenom WHERE id = :id";
                    $update_stmt = $pdo->prepare($update_sql);
                    $update_stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                    $update_stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                    $update_stmt->bindParam(':id', $id, PDO::PARAM_INT);

                    if ($update_stmt->execute()) {
                        echo "<p>Informations mises à jour avec succès.</p>";
                    } else {
                        echo "<p>Erreur lors de la mise à jour des informations.</p>";
                    }
                }
                ?>
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
