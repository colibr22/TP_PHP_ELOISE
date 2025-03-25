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
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['nom'], $_POST['prenom'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $classe_id = 1;
    
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "INSERT INTO etudiants (nom, prenom, classe_id) VALUES (:nom, :prenom, :classe_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':classe_id', $classe_id, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                echo "Nouvel élève ajouté avec succès !";
            } else {
                echo "Une erreur s'est produite lors de l'ajout.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Veuillez remplir correctement le formulaire.";
    }
    
    echo '<br><a href="../index.php">Retour à la page principale</a>';
?>

</body>
</html>