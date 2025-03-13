<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mittenteID = $_POST['mittente_id'];
    $destinatarioID = $_POST['destinatario_id'];
    $stato = 'in partenza'; // Stato iniziale
    $dataSpedizione = date('Y-m-d H:i:s');

    // Connessione al database
    $conn = getConnection();

    // Inserimento della spedizione
    $stmt = $conn->prepare("INSERT INTO Spedizione (MittenteID, DestinatarioID, Stato, DataSpedizione) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$mittenteID, $destinatarioID, $stato, $dataSpedizione])) {
        echo "Spedizione inserita con successo.";
    } else {
        echo "Errore: " . $stmt->errorInfo()[2];
    }
}
?>
<form method="POST">
    ID Mittente: <input type="number" name="mittente_id" required>
    ID Destinatario: <input type="number" name="destinatario_id" required>
    <input type="submit" value="Inserisci Spedizione">
</form>
