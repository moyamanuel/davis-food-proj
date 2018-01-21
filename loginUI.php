<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>LoopLAB</title>
</head>
<body>
  
  <!-- HOME SECTION -->
  <section id="home-section">
    <div class="dark-overlay">
      <div class="home-inner">
        <div class="container">
          <div class="row">
            <div class="col-sm-8" text-white>
              <form method="post" action=""  onsubmit="return validate(this)">
                <div class="form-group text-white">
                    <label>Username:<sup class="text-danger">*</sup></label>
                    <input type="text" name="username"class="form-control" value="">
                </div>
                <div class="form-group text-white">
                    <label>Password:<sup class="text-danger">*</sup></label>
                    <input type="password" name="password" class="form-control">
                </div>
                <label>
                  <select name="select_box">
                     <option value="0">Login As User</option>
                     <option value="1">Login As Admin</option>
                     <option value="2">Login As Donor</option>
                 </select>
              <button type="submit" name="signin" class="btn btn-outline-primary">Submit</button>
                </form><br>

            </div>
            <div class="col-md-4">
              <div class="card card-primary card-form text-center">
                <div class="card-block">
                  <h3>Sign Up Today</h3>
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
                    <input type="submit" value="Submit" class="btn btn-outline-secondary btn-block">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="js/jquery.min.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
