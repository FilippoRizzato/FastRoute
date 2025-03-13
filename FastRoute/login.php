<?php
session_start();
require 'db.php'; // Assicurati che il file db.php contenga la funzione getConnection()

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connessione al database
    $conn = getConnection();

    // Verifica delle credenziali nel database
    $stmt = $conn->prepare("SELECT * FROM Utente WHERE Email = ?");
    $stmt->execute([$email]);
    $utente = $stmt->fetch(PDO::FETCH_ASSOC); // Usa FETCH_ASSOC per ottenere un array associativo

    // Debug: Stampa l'utente per verificare i dati
    // var_dump($utente); // Rimuovi o commenta questa riga in produzione

    if ($utente) {
        // Verifica della password in chiaro
        if ($password === $utente['Password']) {
            // Autenticazione riuscita
            $_SESSION['user_id'] = $utente['ID'];
            // Reindirizza all'homepage
            header("Location: home_page.php"); // Sostituisci con il percorso corretto della tua homepage
            exit; // Ferma l'esecuzione dello script
        } else {
            echo "Credenziali non valide: password errata.";
        }
    } else {
        echo "Credenziali non valide: email non trovata.";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<h1>Login</h1>
<form method="POST">
    Email: <input type="email" name="email" required>
    Password: <input type="password" name="password" required>
    <input type="submit" value="Login">
</form>
</body>
</html>