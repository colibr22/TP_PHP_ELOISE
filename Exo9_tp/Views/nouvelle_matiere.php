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

    if (!empty($_POST['lib'])) {
        $lib = $_POST['lib'];
        $stmt = $pdo->prepare("INSERT INTO matiere (lib) VALUES (?)");
        $stmt->execute([$lib]);
        echo "Matière ajoutée avec succès !";
        echo "<br><a href='../index.php'>Retour</a>";
    }
?>

</body>
</html>