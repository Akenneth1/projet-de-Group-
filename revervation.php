<?php require 'config.php'; ?>
<?php

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // 1. Récupérer l'état actuel de la salle
    $check_stmt = $pdo->prepare("SELECT is_available FROM booking WHERE id = ?");
    $check_stmt->execute([$id]);
    $room = $check_stmt->fetch();

    if ($room) {
        // Déterminer le nouvel état : inverser l'état actuel
        // Si is_available est 1 (Disponible), le nouvel état est 0 (Occupée)
        // Si is_available est 0 (Occupée), le nouvel état est 1 (Disponible)
        $new_status = $room['is_available'] == 1 ? 0 : 1;
        $action = $room['is_available'] == 1 ? 'Réservée' : 'Libérée';
        
        // 2. Mettre à jour l'état dans la base de données
        $update_stmt = $pdo->prepare("UPDATE booking SET is_available = ? WHERE id = ?");
        $update_stmt->execute([$new_status, $id]);
        
        $message = "La salle (ID: $id) a été $action avec succès. Nouvel état: " . ($new_status ? 'Disponible' : 'Occupée');
        $success = true;

    } else {
        $message = "il y'a une Erreur : Salle non trouvée.";
        $success = false;
    }

} else {
    $message = "il y a une Erreur : ID de salle manquant ou invalide.";
    $success = false;
}

?>

<h1>Modification de l'état de la salle</h1>
<p style="color: <?= $success ? 'green' : 'red' ?>; font-weight: bold;"><?= $message ?></p>

<p><a href="index.php">Retour à la liste</a></p>

<?php
// Redirection automatique pour un meilleur flux utilisateur
header("Refresh: 3; URL=index.php");
?>