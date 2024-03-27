
<?php
// Datenbankverbindung herstellen (Hier anpassen)
$pdo = new PDO('mysql:host=localhost;dbname=e-rezept', 'root', '');

// Daten vom Registrierungsformular abrufen
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Passwort hashen

// SQL-Anweisung für die Benutzerregistrierung vorbereiten und ausführen
$stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->execute([$name, $email, $password]);

echo "User registered successfully";
?>
