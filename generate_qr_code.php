<?php
require_once dirname(__DIR__,2) . '/config.php';
// Daten aus dem Versicherungsformular und dem Patientenrezeptformular kombinieren (als Beispiel)
$versicherungsDaten = array(
    'anrede' => $_POST['anrede'] ?? '',
    'vollstaendigName' => $_POST['vollstaendigName'] ?? '',
    'versicherung' => $_POST['versicherung'] ?? ''
);

$rezeptDaten = array(
    'patientId' => $_POST['patientId'] ?? '',
    'medikamentName' => $_POST['medikamentName'] ?? ''
    // Weitere Rezeptdaten hier hinzufügen
);

// Kombinierte Daten als JSON-Objekt erstellen
$kombinierteDaten = array(
    'versicherungsDaten' => $versicherungsDaten,
    'rezeptDaten' => $rezeptDaten
);

// JSON-Daten für den QR-Code erstellen
$jsonDaten = json_encode($kombinierteDaten);

// QR-Code mit den kombinierten JSON-Daten generieren
include('phpqrcode/qrlib.php'); // Stellen Sie sicher, dass der Pfad korrekt ist
QRcode::png($jsonDaten, 'qrcode.png');

echo '<img src="qrcode.png" alt="QR Code">';
?>
