<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $spedizioneID = $_POST['spedizione_id'];
    $dataRitiro = date('Y-m-d H:i:s');

    // Connessione al database
    $conn = getConnection();

    // Aggiornamento dello stato della spedizione
    $stmt = $conn->prepare("UPDATE Spedizione SET Stato = 'in transito', DataRitiro = ? WHERE ID = ?");
    if ($stmt->execute([$dataRitiro, $spedizioneID])) {
        echo "Ritiro registrato con successo.";
    } else {
        echo "Errore: " . $stmt->errorInfo()[2];
    }
}
?>
<form method="POST">
    ID Spedizione: <input type="number" name="spedizione_id" required>
    <input type="submit" value="Registra Ritiro">
</form>
