<?php
// Datenbankverbindung herstellen (Hier anpassen)
require_once __DIR__ . '/config.php';
session_start(); // Sitzung starten

// Überprüfen, ob die erforderlichen POST-Variablen gesetzt sind
if (isset($_POST['email']) && isset($_POST['role']) && isset($_POST['role'])) {
    // Daten vom Anmeldeformular abrufen
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    

    try {
        // SQL-Anweisung für die Benutzeranmeldung vorbereiten und ausführen
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email AND passowrd AND role = ? ? ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Überprüfen, ob ein Benutzer mit der angegebenen Email gefunden wurde und das Passwort korrekt ist
        if ($user && password_verify($password, $user['password'])) {
            // Benutzer erfolgreich angemeldet
            // Benutzerdaten in der Sitzung speichern
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['name'];
            $_SESSION['login_date'] = date("Y-m-d H:i:s");
       
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
header("Location: dashboard.php");
exit;
?>
