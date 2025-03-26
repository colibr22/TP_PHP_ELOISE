<?php
session_start();
require '../Model/pdo.php';

if (!isset($_SESSION['users'])) {
    header('Location: login.php');
    exit;
}

$etudiants = $pdo->query("SELECT id, nom, prenom, classe_id FROM etudiants")->fetchAll(PDO::FETCH_ASSOC);
$classes = $pdo->query("SELECT id, nom FROM classes")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $classe_id = $_POST['classe_id'];

    $query = $pdo->prepare("INSERT INTO etudiants (nom, prenom, classe_id) VALUES (:nom, :prenom, :classe_id)");
    $query->execute(['nom' => $nom, 'prenom' => $prenom, 'classe_id' => $classe_id]);
    header('Location: admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $classe_id = $_POST['classe_id'];

    $query = $pdo->prepare("UPDATE etudiants SET nom = :nom, prenom = :prenom, classe_id = :classe_id WHERE id = :id");
    $query->execute(['nom' => $nom, 'prenom' => $prenom, 'classe_id' => $classe_id, 'id' => $id]);
    header('Location: admin.php');
    exit;
}

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    $query = $pdo->prepare("DELETE FROM etudiants WHERE id = :id");
    $query->execute(['id' => $id]);
    header('Location: admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="logout.php">Déconnexion</a>
    <h1>Page Admin</h1>

    <h2>Ajouter un étudiant</h2>
    <form method="POST">
        <input type="hidden" name="action" value="add">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required>
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required>
        <label for="classe_id">Classe :</label>
        <select name="classe_id" id="classe_id" required>
            <?php foreach ($classes as $classe): ?>
                <option value="<?= htmlspecialchars($classe['id']) ?>"><?= htmlspecialchars($classe['nom']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Ajouter</button>
    </form>

    <h2>Liste des étudiants</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Classe</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etudiants as $etudiant): ?>
                <tr>
                    <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                    <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
                    <td>
                        <?php
                        $classeNom = '';
                        foreach ($classes as $classe) {
                            if ($classe['id'] === $etudiant['classe_id']) {
                                $classeNom = htmlspecialchars($classe['nom']);
                                break;
                            }
                        }
                        echo $classeNom;
                        ?>
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($etudiant['id']) ?>">
                            <input type="text" name="nom" value="<?= htmlspecialchars($etudiant['nom']) ?>" required>
                            <input type="text" name="prenom" value="<?= htmlspecialchars($etudiant['prenom']) ?>" required>
                            <select name="classe_id" required>
                                <?php foreach ($classes as $classe): ?>
                                    <option value="<?= htmlspecialchars($classe['id']) ?>" <?= $classe['id'] == $etudiant['classe_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($classe['nom']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit">Modifier</button>
                        </form>
                    </td>
                    <td>
                        <a href="admin.php?delete_id=<?= htmlspecialchars($etudiant['id']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
