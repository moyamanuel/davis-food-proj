<!DOCTYPE html>
<html lang="en" style="height:100%;">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/loginUI.js"></script>
    <title>Pantry-Login</title>
  </head>
  <body id="home-section">
    <?php require_once('assets/includes/header.html') ?>
    <!-- HOME SECTION -->
    <div class="container position-absolute" id="login-section">
      <div class="row">
        <div class="col mx-auto" style="max-width: 600px;">
          <div class="card card-form text-center mt-4">
            <div class="row">
              <div class="col text-center">
                <div class="mt-3">
                  <button type="button" class="btn btn-light btn-large" id="loginBtn">Log In</button>
                  <button type="button" class="btn btn-light btn-large" id="registerBtn">Register</button>
                </div>
              </div>
            </div>
            <div class="card-body" id="loginCard">
              <form method="post" action="" onsubmit="return validate(this)">
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-lg" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
                </div>
                <div class="form-group">
                  <select name="select_box">
                     <option value="0">Login As User</option>
                     <option value="1">Login As Admin</option>
                     <option value="2">Login As Donor</option>
                </select>
                </div>
                <input type="submit" value="Log In" class="btn btn-outline-primary btn-block">
              </form>
            </div>
            <div class="card-body" id="registerCard">
              <p>Please fill out this form to register</p>
              <form>
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-lg" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
                </div>
                <div class="form-group">
                  <input type="password" name="password2" class="form-control form-control-lg" placeholder="Confirm Password">
                </div>
                <div class="form-group">
                  <select name="select_box">
                     <option value="0">Register As User</option>
                     <option value="1">Register As Donor</option>
                </select>
                </div>
                <input type="submit" value="Register" class="btn btn-outline-primary btn-block">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="bg-white position-absolute w-100" id="main-footer">
        <div class="container bg-faded">
          <div class="row">
            <div class="col text-center">
              <div class="py-2" id="footer-text">
                <h5>Davis Pantry</h5>
                <p>Copyright &copy; 2018</p>
              </div>
            </div>
          </div>
        </div>
    </footer>
  </body>
</html>
