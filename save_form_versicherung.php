<?php
// Verbindung zur Datenbank herstellen (hier anpassen)
$pdo = new PDO('mysql:host=localhost;dbname=e-rezept', 'root', '');

// Daten vom Formular abrufen
$anrede = $_POST['anrede'];
$vollstaendigName = $_POST['vollstaendigName'];
$versicherung = $_POST['versicherung'];

// Bild-Upload für die Versicherung
$targetDir = "uploads/";
$versicherungsbildName = basename($_FILES["bildUpload"]["name"]);
$targetFilePath = $targetDir . $versicherungsbildName;

if (move_uploaded_file($_FILES["bildUpload"]["tmp_name"], $targetFilePath)) {
    // Bild erfolgreich hochgeladen
} else {
    echo "Fehler beim Hochladen des Versicherungsbildes.";
}

// Bild-Upload für den Patienten
$patientenbildName = basename($_FILES["bildVonPatienten"]["name"]);
$targetFilePath2 = $targetDir . $patientenbildName;

if (move_uploaded_file($_FILES["bildVonPatienten"]["tmp_name"], $targetFilePath2)) {
    // Bild erfolgreich hochgeladen
} else {
    echo "Fehler beim Hochladen des Patientenbildes.";
}

// SQL-Anweisung für die Speicherung der Daten vorbereiten und ausführen
$stmt = $pdo->prepare("INSERT INTO patientenversicherung (anrede, vollstaendigName, versicherung, bildVersicherung, bildPatient) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$anrede, $vollstaendigName, $versicherung, $targetFilePath, $targetFilePath2]);

echo "Daten erfolgreich gespeichert.";
?>
