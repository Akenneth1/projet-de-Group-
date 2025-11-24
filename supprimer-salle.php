<?php require 'config.php'; ?>
<?php

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // 1. Vérification de la disponibilité de la salle
    $check_stmt = $pdo->prepare("SELECT is_available FROM booking WHERE id = ?");
    $check_stmt->execute([$id]);
    $room = $check_stmt->fetch();

    if ($room) {
        if ($room['is_available'] == 1) {
            // La salle est disponible, on peut la supprimer
            $delete_stmt = $pdo->prepare("DELETE FROM booking WHERE id = ?");
            $delete_stmt->execute([$id]);
            $message = " La salle (ID: $id) a été supprimée avec succès.";
            $success = true;
        } else {
            // La salle n'est pas disponible , la suppression ne peut pas se faire
            $message = "il y'a une Erreur : La salle (ID: $id) est occupée et ne peut pas être supprimée.";
            $success = false;
        }
    } else {
        $message = "il y'a une Erreur : Salle non trouvée.";
        $success = false;
    }

} else {
    $message = "il y a une Erreur : ID de salle manquant ou invalide.";
    $success = false;
}

// Affichage d'un message puis redirection
?>
<h1>Suppression d'une salle</h1>
<p style="color: <?= $success ? 'green' : 'red' ?>; font-weight: bold;"><?= $message ?></p>

<p><a href="index.php">Retour à la liste</a></p>

<?php
// Redirection après 3 secondes
header("Refresh: 3; URL=index.php");

?>