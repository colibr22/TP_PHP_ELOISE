<?php
require 'Model/pdo.php';

?>

<?php
$query = $pdo->query("SELECT nom_classe FROM classes");
$classes = $query->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Liste des classes :</h2>";
echo "<ul>";
foreach ($classes as $classe) {
    echo "<li>" . htmlspecialchars($classe['nom_classe']) . "</li>";
}
echo "</ul>";
?>