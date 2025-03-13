<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $spedizioneID = $_POST['spedizione_id'];
    $dataConsegna = date('Y-m-d H:i:s');

    // Connessione al database
    $conn = getConnection();

    // Aggiornamento dello stato della spedizione
    $stmt = $conn->prepare("UPDATE Spedizione SET Stato = 'consegnato', DataConsegna = ? WHERE ID = ?");
    if ($stmt->execute([$dataConsegna, $spedizioneID])) {
        echo "Consegna registrata con successo.";
    } else {
        echo "Errore: " . $stmt->errorInfo()[2];
    }
}
?>
<form method="POST">
    ID Spedizione: <input type="number" name="spedizione_id" required>
    <input type="submit" value="Registra Consegna">
</form>
