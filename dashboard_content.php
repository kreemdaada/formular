<?php
// Einbinden der Datei register.php, die die Datenbankverbindung herstellt
require_once __DIR__. '/register.php';
require_once __DIR__ . '/config.php';

// Starten der Sitzung, um auf Session-Variablen zugreifen zu können
session_start();

// Überprüfen, ob die Benutzer-ID in der Sitzung gesetzt ist
if (!isset($_SESSION['user_id'])) {
    // Benutzer nicht angemeldet, leite ihn zur Anmeldeseite weiter oder führe andere Aktionen durch
    header("Location: login.html");
    exit();
}

// Benutzerrolle abrufen basierend auf der Session-ID
$user_id = $_SESSION['user_id'];
$sql = "SELECT role FROM users WHERE user_id = $user_id"; // Annahme: Tabelle 'users' und Spalte 'role' für die Benutzerrolle
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Benutzerrolle abrufen
    $row = $result->fetch_assoc();
    $user_role = $row['role'];

    // Nur die Benutzerrolle ausgeben, keine HTML-Inhalte generieren
    if ($user_role == 'doctor') {
        echo "doctor";
        // Weitere Inhalte für Ärzte hier einfügen
    } elseif ($user_role == 'pharmacy') {
        echo "pharmacy";
        // Weitere Inhalte für Apotheken hier einfügen
    } else {
        echo "Unbekannte Benutzerrolle.";
    }
} else {
    echo "Benutzer nicht gefunden.";
}

// Datenbankverbindung schließen
$conn->close();
?>
