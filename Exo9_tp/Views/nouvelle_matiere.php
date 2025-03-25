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

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['libelle'])) {
        $libelle = htmlspecialchars($_POST['libelle']);
    
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "INSERT INTO matiere (lib) VALUES (:libelle)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':libelle', $libelle, PDO::PARAM_STR);
    
            if ($stmt->execute()) {
                echo "Nouvelle matière ajoutée avec succès !";
            } else {
                echo "Une erreur s'est produite lors de l'ajout.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Veuillez remplir le formulaire correctement.";
    }
    
    echo '<br><a href="../index.php">Retour à la page principale</a>';
?>


</body>
</html>