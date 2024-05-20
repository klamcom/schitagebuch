<?php require "includes/header.php"; ?>
<?php require "config.php"; ?>

<?php
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_SESSION['error']) . '</div>';
    unset($_SESSION['error']); 
}

if(isset($_SESSION['email'])) {
    echo ("<p>" . "Hallo" . " " . htmlspecialchars($_SESSION['vorname']) . " " . htmlspecialchars($_SESSION['nachname']) . "</p>"); 

    if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        echo ("<p>" . "Sie sind ein Admin" . "</p>");

        //$data = $conn->query("SELECT tblskitag.*, tbluser.vorname, tbluser.nachname FROM tblskitag JOIN tbluser ON tblskitag.fkUserId = tbluser.id ORDER BY tbluser.vorname, tbluser.nachname");

        $stmt = $conn->prepare("SELECT tblskitag.*, tbluser.vorname, tbluser.nachname FROM tblskitag JOIN tbluser ON tblskitag.fkUserId = tbluser.id ORDER BY tbluser.vorname, tbluser.nachname");
        $stmt->execute();

        
    } else {
        $userId = $_SESSION['user_id'];
        $stmt = $conn->prepare("SELECT * FROM tblskitag WHERE fkUserId = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();


        //$userId = $_SESSION['user_id'];

        //$data= $conn->query("SELECT * FROM tblskitag WHERE fkUserId = '$userId'");

    }    
?>

    <div class="container">
        <?php if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'): ?>
        <form method="POST" action="insert.php" class="form-inline">
            <div class="form-group mx-sm-3 mb-2">
                <label for="skigebiet2" class="sr-only"></label>
                <input type="text" class="form-control" name="skigebiet" id="skigebiet2" placeholder="Skigebiet">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="datum2" class="sr-only"></label>
                <input type="date" class="form-control" name="datum" id="datum2" placeholder="Datum">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="startzeit2" class="sr-only"></label>
                <input type="time" class="form-control" name="startzeit" id="startzeit2" placeholder="Startzeit">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="endezeit2" class="sr-only"></label>
                <input type="time" class="form-control" name="endezeit" id="endezeit2" placeholder="Endezeit">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label class="form-label" for="kommentar2"></label>
                <textarea name="kommentar" id="kommentar2" class="form-control" placeholder="Kommentar"></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary mb-5 mx-3">Neuer Eintrag</button>
        </form>
        <?php endif; ?>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <th>User</th>
                    <?php endif; ?>
                    <th>Skigebiet</th>
                    <th>Datum</th>
                    <th>Startzeit</th>
                    <th>Endezeit</th>
                    <th>Kommentar</th>
                    <th>Löschen</th>
                    <th>Bearbeiten</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $stmt->fetch(PDO::FETCH_OBJ)): ?>
                <tr>
                    <td><?php echo $row->id; ?></td>
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <td><?php echo $row->vorname . " " . $row->nachname; ?></td>
                    <?php endif; ?>
                    <td><?php echo $row->skigebiet; ?></td>
                    <td><?php echo date("d.m.Y", strtotime($row->datum)); ?></td>
                    <td><?php echo $row->startzeit; ?></td>
                    <td><?php echo $row->endezeit; ?></td>
                    <td><?php echo $row->kommentar; ?></td>
                    <td><button onclick="confirmDelete('delete.php?del_id=<?php echo $row->id; ?>')" class="btn btn-danger">löschen</button></td>
                    <td><a href="update.php?upd_id=<?php echo $row->id; ?>" class="btn btn-warning">bearbeiten</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>

        </table>

    </div>

        
<?php 

} else {
    echo "<p>Sie müssen eingeloggt sein, um diese Seite sehen zu können.</p>";
}
?>

<?php if (!isset($_SESSION['email'])): ?>
    <img src="skitagebuch.webp" class="img-fluid" alt="Skitagebuch">
<?php endif; ?>

<!-- Löschbestätigungs-ModalS -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Eintrag löschen bestätigen</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Sind Sie sicher, dass Sie diesen Eintrag löschen möchten?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">Löschen</button>
      </div>
    </div>
  </div>
</div>
<script>
  // Funktion, die aufgerufen wird, wenn der Löschen-Button geklickt wird
  function confirmDelete(delUrl) {
    $('#deleteConfirmationModal').modal('show');

    document.getElementById('confirmDelete').onclick = function() {
      window.location.href = delUrl;
    };
  }
</script>

<?php require "includes/footer.php"; ?>
