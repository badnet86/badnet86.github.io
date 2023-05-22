<?php
// PHP-Code für das Forum hier einfügen
// Beispielcode für das Forum:

// Verbindung zur Datenbank herstellen
$dbHost = 'http://localhost:80/phpmyadmin';
$dbUser = 'root';
$dbPass = '';
$dbName = 'forum';

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
  die('Verbindung zur Datenbank fehlgeschlagen: ' . mysqli_connect_error());
}

// Beitrag in die Datenbank einfügen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $message = $_POST['message'];

  $sql = "INSERT INTO posts (name, message) VALUES ('$name', '$message')";

  if (mysqli_query($conn, $sql)) {
    echo '<p class="success">Beitrag erfolgreich gesendet.</p>';
  } else {
    echo '<p class="error">Fehler beim Senden des Beitrags: ' . mysqli_error($conn) . '</p>';
  }
}

// Beiträge aus der Datenbank abrufen
$sql = "SELECT * FROM posts ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="forum">
  <h2>Forum</h2>

  <!-- Beiträge anzeigen -->
  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="post">
      <p class="name"><?php echo $row['name']; ?></p>
      <p class="message"><?php echo $row['message']; ?></p>
    </div>
  <?php } ?>

  <!-- Formular zum Hinzufügen eines Beitrags -->
  <form method="post" action="">
    <input type="text" name="name" placeholder="Name" required>
    <textarea name="message" placeholder="Nachricht" required></textarea>
    <button type="submit">Beitrag senden</button>
  </form>
</div>

<?php
// Datenbankverbindung schließen
mysqli_close($conn);
?>