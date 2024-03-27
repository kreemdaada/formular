<?php
// Datenbankverbindung herstellen (Hier anpassen)
$pdo = new PDO('mysql:host=localhost;dbname=e-rezept', 'root', '');
// Daten vom Formular oder Mock-Daten abrufen
$data = [
    'patientId' => 123456,
    'medikamentName' => 'Ibuprofen',
    'termin' => '2024-03-31 10:30:00',
    'arztId' => 789,
    'empfehlungApo' => 'Nehmen Sie das Medikament mit einer Mahlzeit ein.',
    'emailApo' => 'apotheke@example.com',
    'vollstaendigerName' => 'Max Mustermann'
];
// SQL-Anweisung für das Einfügen des Rezepts vorbereiten
$stmt = $pdo->prepare("INSERT INTO rezepte (patientId, medikamentName, termin, arztId, empfehlungApo, emailApo, vollstaendigerName) 
                      VALUES (:patientId, :medikamentName, :termin, :arztId, :empfehlungApo, :emailApo, :vollstaendigerName)");

// Parameter binden, um SQL-Injection zu vermeiden
$stmt->bindParam(':patientId', $data['patientId']);
$stmt->bindParam(':medikamentName', $data['medikamentName']);
$stmt->bindParam(':termin', $data['termin']);
$stmt->bindParam(':arztId', $data['arztId']);
$stmt->bindParam(':empfehlungApo', $data['empfehlungApo']);
$stmt->bindParam(':emailApo', $data['emailApo']);
$stmt->bindParam(':vollstaendigerName', $data['vollstaendigerName']);

// Ausführen der vorbereiteten Anweisung
if ($stmt->execute()) {
    echo "Rezept erfolgreich erstellt.";
} else {
    echo "Fehler beim Erstellen des Rezepts.";
}
?>