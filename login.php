<?php
// Datenbankverbindung herstellen (Hier anpassen)
try {
    $pdo = new PDO('mysql:host=localhost;dbname=e-rezept', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Verbindung zur Datenbank fehlgeschlagen: " . $e->getMessage();
    die(); // Skript beenden, wenn die Datenbankverbindung fehlschlägt
}

// Überprüfen, ob die erforderlichen POST-Variablen gesetzt sind
if (isset($_POST['email']) && isset($_POST['password'])) {
    // Daten vom Anmeldeformular abrufen
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // SQL-Anweisung für die Benutzeranmeldung vorbereiten und ausführen
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Überprüfen, ob ein Benutzer mit der angegebenen Email gefunden wurde und das Passwort korrekt ist
        if ($user && password_verify($password, $user['password'])) {
            // Benutzer erfolgreich angemeldet
            // Begrüßung anzeigen
            echo "Willkommen, " . $user['name'] . "!";

            // Weiterleitung auf eine andere Seite
            header("Location: dashboard.php");
            exit; // Sicherstellen, dass nach der Weiterleitung kein weiterer Code ausgeführt wird
        } else {
            // Fehlermeldung bei ungültigen Anmeldeinformationen
            http_response_code(401);
            echo "Ungültige Anmeldeinformationen";
        }
    } catch (PDOException $e) {
        echo "Fehler beim Abrufen der Benutzerdaten: " . $e->getMessage();
    }
} else {
    echo "Erforderliche POST-Variablen nicht gesetzt";
}
?>
