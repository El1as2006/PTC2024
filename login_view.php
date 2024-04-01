<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="package/dist/Sweetalert2.css">
    <script src="package/dist/Sweetalert2.min.js"></script>
</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="assets/images/IMG_3215.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="assets/images/logo.svg" alt="logo" class="logo">
              </div>
              <p class="login-card-description">Sign into your account</p>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> 
                  <div class="form-group">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary height1" type="button" id="togglePassword">
                                <i class="mdi mdi-eye"></i>
                            </button>
                        </div>
                    </div>
                  </div>
                  <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login"> 
                </form>
                <a href="forgetpass_view.php" class="forgot-password-link">Forgot password?</a>
                <p class="login-card-footer-text">Don't have an account? <a href="register_view.php" class="text-reset">Register here</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php
session_start();

$conn = include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   // Evitamos posibles ataques de inyección SQL mediante la preparación de la consulta
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);
  
   if (empty($username) || empty($password)) {
       echo "Please fill in all fields";
   } else {

       // Utilizamos consultas preparadas para evitar la inyección de SQL
       $sql = "SELECT * FROM usuarios WHERE username=?";
       $stmt = $conn->prepare($sql);
       $stmt->bind_param("s", $username);
       $stmt->execute();
       $result = $stmt->get_result();

       if ($result->num_rows == 1) {

           $row = $result->fetch_assoc();
           if (password_verify($password, $row['password'])) {

               // Iniciamos la sesión y almacenamos el nombre de usuario
               $_SESSION['username'] = $username;
               echo "<p>
               <script>
               swal({
               title: 'Succesful Login',
               text: 'Welcome',
               icon: 'success',
               button: 'Close',
               });
               </script>
               </p>"; 
            
               header("Location: index_view.php"); 
           } else 
           {
            echo "<p>
            <script>
            swal({
            title: 'Wrong Password',
            text: 'Please check your password',
            icon: 'warning',
            button: 'Close',
            });
            </script>
            </p>"; 
           }
       } else 
       {
        echo "<p>
        <script>
        swal({
        title: 'Non-existemt User',
        text: 'This user does not exist',
        icon: 'warning',
        button: 'Close',
        });
        </script>
        </p>"; 
       }
   }
}


$conn->close();
?>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function () {
        $('#togglePassword').click(function () {
            var passwordInput = $('#password');
            var passwordFieldType = passwordInput.attr('type');
            if (passwordFieldType === 'password') {
                passwordInput.attr('type', 'text');
                $(this).find('i').removeClass('mdi-eye').addClass('mdi-eye-off');
            } else {
                passwordInput.attr('type', 'password');
                $(this).find('i').removeClass('mdi-eye-off').addClass('mdi-eye');
            }
        });
    });
  </script>
</body>
</html>