<?php
session_start();
require 'db.php';

// Connessione al database
$conn = getConnection();

// Query per ottenere tutte le spedizioni
$stmt = $conn->query("SELECT s.ID, c1.Nome AS Mittente, c2.Nome AS Destinatario, s.Stato, s.DataSpedizione, s.DataConsegna, s.DataRitiro
                       FROM Spedizione s
                       JOIN Cliente c1 ON s.MittenteID = c1.ID
                       JOIN Cliente c2 ON s.DestinatarioID = c2.ID");

if ($stmt->rowCount() > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Mittente</th>
                <th>Destinatario</th>
                <th>Stato</th>
                <th>Data Spedizione</th>
                <th>Data Consegna</th>
                <th>Data Ritiro</th>
            </tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr>
                                <td>{$row['ID']}</td>
                <td>{$row['Mittente']}</td>
                <td>{$row['Destinatario']}</td>
                <td>{$row['Stato']}</td>
                <td>{$row['DataSpedizione']}</td>
                <td>{$row['DataConsegna']}</td>
                <td>{$row['DataRitiro']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nessuna spedizione trovata.";
}

$conn = null; // Chiudi la connessione
?>
