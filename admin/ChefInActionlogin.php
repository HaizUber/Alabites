<?php include('../config/constants.php'); 


    //CHeck whether the Submit Button is Clicked or NOt
    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the Data from Login form
        // $username = $_POST['username'];
        // $password = md5($_POST['password']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' AND restaurant_id = 3";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. COunt rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User AVailable and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it

            //REdirect to HOme Page/Dashboard
            header('location:'.SITEURL.'admin/manage-ciaorder.php');
        }
        else
        {
            //User not Available and Login FAil
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //REdirect to HOme Page/Dashboard
            header('location:'.SITEURL.'admin/login.php');
        }


    }

?>

<html>
    <head>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login Page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../css/vendor/aos/aos.css" rel="stylesheet">
  <link href="../css/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../css/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


        <title>Login - Food Order System</title>
    </head>

    <body>
        
    <section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-6">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                <form action="" method="post">
                  <fieldset>
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <img src="../images/cia.jpg" alt="" style="width: 200px">
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div class="form-group mb-4">
                    <input type="text" id="username" name="username" placeholder="Username" class="form-control form-control-lg" />
                  </div>

                  <div class="form-group mb-4">
                    <input type="password" id="password" name="password" placeholder="Password" class="form-control form-control-lg" />
                  </div>

                  <div class="form-group pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit" name="submit">Login</button>
                  </div>
                  </fieldset>
                  <a class="small text-muted" href="#!">Forgot password?</a><br>
                  <a href="#!" class="small text-muted">Terms of use.</a><br>
                  <a href="#!" class="small text-muted">Privacy policy</a><br>
                  
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    </body>
</html>

<?php 

?>