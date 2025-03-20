<?php
session_start();
require 'db.php';

// Verifica se l'utente è autenticato
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastRoute - Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            color: white;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .logout {
            float: right;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Benvenuti in FastRoute</h1>
    <p>Seleziona un'operazione dal menu qui sotto:</p>
    <a href="insert_shipment.php" class="button">Inserisci Spedizione</a>
    <a href="insert_delivery.php" class="button">Registra Consegna</a>
    <a href="insert_pickup.php" class="button">Registra Ritiro</a>
    <a href="verifica_stato.php" class="button">Verifica Stato Spedizione</a>
    <a href="cerca_spedizione.php" class="button">Cerca Consegne</a>
    <a href="dashboard.php" class="button">Dashboard Spedizioni</a>
    <a href="modifica_password.php" class="button">Cambia Password</a>
    <a href="logout.php" class="button logout">Logout</a>
</div>
</body>
</html>
modifica tutte le pagine insert si deve poter inserire usando il nome del mittente o destinatario