<?php session_start(); ?>
<?php require "config.php"; ?>

<?php
$error = ''; // Variable für Fehlermeldungen

if(isset($_POST['submit'])) {
    if(isset($_SESSION['id'])) {
       // $userId = $_SESSION['user_id']; 
        $skigebiet = $_POST['skigebiet'];
        $datum = $_POST['datum'];
        $startzeit = $_POST['startzeit'];
        $endezeit = $_POST['endezeit'];
        $kommentar = $_POST['kommentar'];

        // Überprüfen, ob eines der Felder leer ist
        if(empty($skigebiet) || empty($datum) || empty($startzeit) || empty($endezeit) || empty($kommentar)) {
            $_SESSION['error'] = "Alle Felder müssen ausgefüllt werden.";
            header("Location: index.php");
            exit();

        } else {
            // Ihr vorbereitetes Einfügestatement und die Weiterleitung
            $insert = $conn->prepare("INSERT INTO tblskitag (fkUserId, skigebiet, datum, startzeit, endezeit, kommentar) VALUES (:fkUserId, :skigebiet, :datum, :startzeit, :endezeit, :kommentar)");

            $insert->execute([
              //  ':fkUserId' => $userId,
                ':skigebiet' => $skigebiet,
                ':datum' => $datum,
                ':startzeit' => $startzeit,
                ':endezeit' => $endezeit,
                ':kommentar' => $kommentar,
            ]);

            header("Location: index.php");
        }
    } else {
       $_SESSION['error'] = "Sie müssen eingeloggt sein, um diese Aktion auszuführen.";
        header("Location: index.php");
        exit();
    }
}

?>