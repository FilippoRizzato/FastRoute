<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastRoute - Home</title>
</head>
<body>
<h1>Benvenuti in FastRoute</h1>
<p>Scopri i nostri servizi di spedizione e consegna.</p>

<h2>Richiesta Informazioni</h2>
<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $messaggio = $_POST['messaggio'];

    // Connessione al database
    $conn = getConnection();

    // Inserimento della richiesta nel database
    $stmt = $conn->prepare("INSERT INTO RichiestaInformazioni (Nome, Email, Messaggio) VALUES (?, ?, ?)");
    if ($stmt->execute([$nome, $email, $messaggio])) {
        echo "<p>Richiesta inviata con successo. Ti contatteremo presto!</p>";
    } else {
        echo "<p>Errore nell'invio della richiesta: " . $stmt->errorInfo()[2] . "</p>";
    }

    $conn = null; // Chiudi la connessione
}
?>
<form method="POST">
    Nome: <input type="text" name="nome" required>
    Email: <input type="email" name="email" required>
    Messaggio: <textarea name="messaggio" required></textarea>
    <input type="submit" value="Invia Richiesta">
</form>
</body>
</html>
