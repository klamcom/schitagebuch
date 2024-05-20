<?php require "includes/header.php"; ?>

<?php require "config.php"; ?>


<?php 

    if(isset($_SESSION['email'])) {
      header("location: index.php");
    }

    
    if(isset($_POST['submit'])) {

      if($_POST['email'] == '' OR $_POST['vorname'] == '' OR $_POST['nachname'] == '' OR $_POST['password'] == '') {
        echo "Ein oder mehrere Felder sind leer";
        
      } else {


        $email = $_POST['email'];
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $password = $_POST['password'];

        $insert = $conn->prepare("INSERT INTO tbluser (email, vorname, nachname, mypassword) 
         VALUES (:email, :vorname, :nachname, :mypassword)");

         $insert->execute([
          ':email' => $email,
          ':vorname' => $vorname,
          ':nachname' => $nachname,
          ':mypassword' => password_hash($password, PASSWORD_DEFAULT),
         ]);

      }
    }


?>
<main class="form-signin w-50 m-auto">
  <form method="POST" action="register.php">
    <h1 class="h3 mt-5 fw-normal text-center">Bitte hier Registrieren</h1>

    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>

    <div class="form-floating">
      <input name="vorname" type="text" class="form-control" id="floatingInput" placeholder="Vorname">
      <label for="floatingInput">Vorname</label>
    </div>

    <div class="form-floating">
      <input name="nachname" type="text" class="form-control" id="floatingInput" placeholder="Nachname">
      <label for="floatingInput">Nachname</label>
    </div>

    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Registrieren</button>
    <h6 class="mt-3">Hast du bereit einen Account?  <a href="login.php">Einloggen</a></h6>

  </form>
</main>
<?php require "includes/footer.php"; ?>
