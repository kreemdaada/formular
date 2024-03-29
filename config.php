<?php
// Datenbankverbindungsinformationen
$servername = "localhost"; // Hostname
$username = "root"; // Benutzername
$password = ""; // Passwort
$dbname = "e-rezept"; // Datenbankname

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung überprüfen
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
?>
