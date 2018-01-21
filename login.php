<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Davis Pantry</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">
  </head>

  <body>
    <?php include("includes/header.html");?>

<!-- Login Section -->
    <section id="home-section" class="mb-5">
        <div class="container">
          <div class="row">
            <div class="col-sm-7">
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="form-group">
              <label>Username:<sup class="text-danger">*</sup></label>
              <input type="text" name="username"class="form-control" value="">
          </div>
          <div class="form-group">
              <label>Password:<sup class="text-danger">*</sup></label>
              <input type="password" name="password" class="form-control">
          </div>
        <button type="submit" name="signin" class="btn btn-outline-primary">Submit</button>
          </form>
            </div>
            <div class="col-sm-1">
              <h6 class="mt-5 mb-5">OR</h6>
            </div>
            <div class="col-sm-4">
          <div class="card card-primary card-form text-center">
            <div class="card-block">
              <h3>Sign Up Today</h3>
              <p>Please fill out this form to register</p>
              <form method="post" >
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-lg" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
                </div>
                <div class="form-group">
                  <input type="password" name="password2" class="form-control form-control-lg" placeholder="Confirm Password">
                </div>
                <input type="submit" value="Submit" class="btn btn-outline-secondary btn-block">
              </form>
            </div>
          </div>
        </div>
          </div>

  </section>

  <?php include("includes/footer.html");?>

  </body>
</html>
