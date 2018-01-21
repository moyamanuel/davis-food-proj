<!DOCTYPE html>
<html lang="en" style="height:100%;">
  <head>
    <meta charset="utf-8">
    <title>Davis Pantry</title>
    <?php require_once 'adminlogin.php'; ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">
  </head>

  <body id="home-section">
    <?php require_once('assets/includes/header.html') ?>
    <!-- HOME SECTION -->
    <div class="container" id="login-section">
      <div class="row">
        <div class="col mx-auto" style="max-width: 600px;">
          <div class="card card-form text-center mt-4">
            <div class="row">
              <div class="col">
                <div class="card-body">
                  <h1 class="mb-3 text-center">Food Posting</h1>
                  <?php insertImage(); ?>
                    <form class="mx-auto" method="POST" action="" enctype="multipart/form-data">
                      <div class="form-group">
                        <input type="text" class="form-control" name="foodDesc" placeholder="Food Description">
                      </div>
                      <div class="form-group text-left">
                        <label for="picture">Upload a photo of the food</label>
                        <input type="file" class="form-control-file" name="foodPic">
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
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
