<?php require "includes/header.php"; ?>
<?php require "config.php"; ?>

<?php 

    if(isset($_SESSION['email'])) {
        header("location: index.php");
    }


    if(isset($_POST['submit'])) {
      if($_POST['email'] == '' OR $_POST['password'] == '') {
        echo "Ein oder mehrere Felder sind leer";

      } else {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $login = $conn->query("SELECT * FROM tbluser WHERE email = '$email'");

        $login->execute();

        $data = $login->fetch(PDO::FETCH_ASSOC);


        if($login->rowCount() > 0) {
          
            if(password_verify($password, $data['mypassword'])) {
              
              $_SESSION['email'] = $data['email'];
              $_SESSION['vorname'] = $data['vorname'];
              $_SESSION['nachname'] = $data['nachname'];
              $_SESSION['user_id'] = $data['id']; 
              $_SESSION['role'] = $data['role'];            

              header("location: index.php");
            } else {
              echo "Email oder Passwort ist falsch";
            } 


        } else {
          echo "Email oder Passwort ist falsch";
        }


      }
    }



?>


<main class="form-signin w-50 m-auto">
  <form method="POST" action="login.php">
    <h1 class="h3 mt-5 fw-normal text-center">Bitte Einloggen</h1>

    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Emailadresse</label>
    </div>
    
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Passwort</label>
    </div>

    <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Einloggen</button>
    <h6 class="mt-3">Wenn du keinen Account hast  <a href="register.php">Erstelle hier einen</a></h6>
  </form>
</main>
<?php require "includes/footer.php"; ?>
