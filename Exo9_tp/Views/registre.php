<?php
require '../Model/pdo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = 'user';

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = $pdo->prepare("INSERT INTO user (username, password, role) VALUES (:username, :password, :role)");
    $query->execute(['username' => $username, 'password' => $hashedPassword, 'role' => $role]);

    echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Inscription</h1>
    <form method="POST">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
