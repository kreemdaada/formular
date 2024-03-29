<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- Fügen Sie hier Ihre CSS-Dateien oder Stile hinzu -->
</head>
<body>
  <h2>Willkommen im Dashboard</h2>

  <?php
  // Einbinden der Konfigurationsdatei für die Datenbankverbindung
  require_once dirname(__DIR__, 2) . '/config.php';

  // Start der Sitzung
  session_start();
  
  // Überprüfen, ob der Benutzer angemeldet ist, andernfalls zur Login-Seite weiterleiten
  if (!isset($_SESSION['user_id'])) {
      header("Location: login.html");
      exit();
  } else {
      // Benutzer angemeldet, Begrüßungsnachricht mit Benutzernamen und Anmeldedatum anzeigen
      $user_id = $_SESSION['user_id'];
      $username = $_SESSION['username'];
      $login_date = $_SESSION['login_date'];
      echo "<p>Willkommen, $username! Du bist am $login_date angemeldet.</p>";
  }
  ?>

  <!-- Hier können Sie weitere Inhalte für das Dashboard einfügen -->
</body>
</html>
