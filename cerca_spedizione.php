<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $giorni = $_POST['giorni'];

    // Connessione al database
    $conn = getConnection();

    // Query per contare le spedizioni consegnate negli ultimi N giorni
    $stmt = $conn->prepare("SELECT COUNT(*) AS Totale, DATE(DataConsegna) AS DataConsegna
                            FROM Spedizione
                            WHERE Stato = 'consegnato' AND DataConsegna >= NOW() - INTERVAL ? DAY
                            GROUP BY DATE(DataConsegna)");
    $stmt->execute([$giorni]);

    if ($stmt->rowCount() > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Data Consegna</th>
                    <th>Numero di Consegne</th>
                </tr>";
        $totaleConsegne = 0;
        while ($row = $stmt->fetch()) {
            echo "<tr>
                    <td>{$row['DataConsegna']}</td>
                    <td>{$row['Totale']}</td>
                  </tr>";
            $totaleConsegne += $row['Totale'];
        }
        echo "</table>";
        echo "<p>Numero totale di consegne negli ultimi $giorni giorni: $totaleConsegne</p>";
    } else {
        echo "Nessuna consegna trovata negli ultimi $giorni giorni.";
    }

    $conn = null; // Chiudi la connessione
}
?>
<form method="POST">
    Numero di giorni: <input type="number" name="giorni" required>
    <input type="submit" value="Cerca Consegne">
</form>