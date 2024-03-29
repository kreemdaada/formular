<?php
require_once __DIR__ . '/config.php';

// Überprüfen, ob die erforderlichen POST-Variablen gesetzt sind
if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'], $_POST['role'])) {
    // Daten vom Registrierungsformular abrufen
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Passwort hashen
    $role = $_POST['role']; // Hier wird die ausgewählte Rolle abgerufen

    // Überprüfen, ob das Passwort übereinstimmt
    if ($_POST['password'] !== $_POST['confirmPassword']) {
        echo "Die Passwörter stimmen nicht überein.";
        exit;
    }

    try {
        // SQL-Anweisung für die Benutzerregistrierung vorbereiten und ausführen
        $stmt = $pdo->prepare("INSERT INTO `users` (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $password, $role]);

        echo "Benutzer erfolgreich registriert";

        // Weiterleitung zur Anmeldeseite
        header("Location: login.php");
        exit;
    } catch (PDOException $e) {
        echo "Fehler beim Registrieren: " . $e->getMessage();
    }
} else {
    echo "Erforderliche POST-Variablen nicht gesetzt";
}
?>
