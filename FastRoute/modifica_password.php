<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];

    // Connessione al database
    $conn = getConnection();

    // Verifica della password attuale
    $stmt = $conn->prepare("SELECT Password FROM Utente WHERE ID = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $utente = $stmt->fetch();

    if ($utente && password_verify($currentPassword, $utente['Password'])) {
        // Aggiorna la password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE Utente SET Password = ? WHERE ID = ?");
        $stmt->execute([$hashedPassword, $_SESSION['user_id']]);
        echo "Password cambiata con successo.";
    } else {
        echo "Password attuale non valida.";
    }
}
?>
<form method="POST">
    Password attuale: <input type="password" name="current_password" required>
    Nuova password: <input type="password" name="new_password" required>
    <input type="submit" value="Cambia Password">
</form>
