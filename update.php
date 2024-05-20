<?php

require "config.php";

if(isset($_GET['upd_id'])) {

    $id = $_GET['upd_id'];

    $data = $conn->query("SELECT * FROM tblskitag WHERE id = '$id'");

    $row = $data->fetch(PDO::FETCH_OBJ);
    


    if(isset($_POST['submit'])) {

        $skigebiet = $_POST['skigebiet'];
        $datum = $_POST['datum'];
        $startzeit = $_POST['startzeit'];
        $endezeit = $_POST['endezeit'];
        $kommentar = $_POST['kommentar'];

        $update = $conn->prepare("UPDATE tblskitag SET skigebiet = :skigebiet, datum = :datum, startzeit = :startzeit, endezeit = :endezeit, kommentar = :kommentar WHERE id = '$id'");

         $update->execute([
          ':skigebiet' => $skigebiet,
          ':datum' => $datum,
          ':startzeit' => $startzeit,
          ':endezeit' => $endezeit,
          ':kommentar' => $kommentar,
         ]);

        header("Location: index.php");

    } 

}

?>

<?php require "includes/header.php"; ?>

<form method="POST" action="update.php?upd_id=<?php echo $id; ?>" class="form-inline">
            <div class="form-group mx-sm-3 mb-2">
                <label for="skigebiet" class="sr-only"></label>
                <input type="text" class="form-control" name="skigebiet" id="skigebiet2" placeholder="Skigebiet" value="<?php echo $row->skigebiet; ?>">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="datum" class="sr-only"></label>
                <input type="date" class="form-control" name="datum" id="datum2" placeholder="Datum" value="<?php echo $row->datum; ?>">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="startzeit" class="sr-only"></label>
                <input type="time" class="form-control" name="startzeit" id="startzeit2" placeholder="Startzeit" value="<?php echo $row->startzeit; ?>">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="endezeit" class="sr-only"></label>
                <input type="time" class="form-control" name="endezeit" id="endezeit2" placeholder="Endezeit" value="<?php echo $row->endezeit; ?>">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label class="form-label" for="kommentar"></label>
                <textarea name="kommentar" id="kommentar2" class="form-control" placeholder="Kommentar"><?php echo $row->kommentar; ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary mb-5 mx-3">Änderung speichern</button>
            <a href="index.php" class="btn btn-secondary mb-5 mx-3">zurück</a>
        </form>

<?php require "includes/footer.php"; ?>