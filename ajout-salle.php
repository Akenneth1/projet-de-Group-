<?php require 'config.php'; ?>
<?php
$message = '';

if (!empty($_POST['room_number'])) {
    $room_number = $_POST['room_number'];
    
    // 1. Vérification si le numéro de salle existe déjà
    $check_stmt = $pdo->prepare("SELECT COUNT(*) FROM booking WHERE room_number = ?");
    $check_stmt->execute([$room_number]);
    $count = $check_stmt->fetchColumn();
    
    if ($count > 0) {
        $message = "Il y'a  une Erreur : Le numéro de salle **$room_number** existe déjà.";
    } else {
        // 2. Insertion de la nouvelle salle
        $stmt = $pdo->prepare("INSERT INTO booking (room_number) VALUES (?)");
        $stmt->execute([$room_number]);
        
        // Redirection après succès
        header("Location: index.php");
        exit;
    }
}
?>
<h1>Ajouter une salle</h1>
<?php if (!empty($message)): ?>
    <p style="color: red; font-weight: bold;"><?= $message ?></p>
<?php endif; ?>

<form method="POST">
    <label>Numéro de salle :</label>
    <input type="text" name="room_number" required>
    <button type="submit">Ajouter</button>
</form>
<p><a href="index.php">Retour à la liste</a></p>