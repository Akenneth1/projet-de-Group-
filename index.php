<?php 
// 
require 'config.php'; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Salles de Réunion</title>
    <link rel="stylesheet" href="style.css"> 
    <style>
        
        .disponible {
            
            background-color: #9a1010ff; 
        }
       
        .table-salles {
            border-collapse: collapse;
            width: 100%;
        }
        .table-salles th, .table-salles td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

    <h1>Liste des salles</h1>

    <p><a href="ajout-salle.php">Ajouter une salle</a></p>

    <table class="table-salles">
        <thead>
            <tr>
                <th>ID</th>
                <th>Numéro de salle</th>
                <th>Disponibilité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
        
            $stmt = $pdo->query("SELECT * FROM booking ORDER BY id");
            
            
            foreach ($stmt as $row):
            ?>
            
            <tr class="<?= $row['is_available'] ? 'disponible' : '' ?>;">
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['room_number']) ?></td>
                
                <td>
                    <?= $row['is_available'] ? 'Disponible' : 'Occupée' ?>
                </td>
                
                <td>
                    <?php if ($row['is_available']): ?>
                        <a href="supprimer-salle.php?id=<?= htmlspecialchars($row['id']) ?>">Supprimer</a>
                    <?php endif; ?>
                    
                    <a href="reservation.php?id=<?= htmlspecialchars($row['id']) ?>">
                        <?= $row['is_available'] ? 'Réserver' : 'Libérer' ?>
                    </a>
                </td>
            </tr>
            
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>