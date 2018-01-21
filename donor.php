<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Davis Pantry</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="assets/css/style.css">
  </head>

    <body>
      <?php include("assets/includes/header.html");?>

      <section id="home-section" class="mb-5">
          <div class="container">
            <div class="row mb-4">
                <div class="col text-center">
                    <h1>Food Posting Page</h1>
                </div>
            </div>
            <div class="row">
                <form class="mx-auto" method="POST">
                  <div class="form-group">
                    <label for="foodDesc">Food Description</label>
                    <input type="email" class="form-control" name="foodDesc">
                  </div>
                  <div class="form-group">
                    <label for="picture">Picture</label>
                    <input type="file" class="form-control-file" name="foodPic">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
    </body>
  </html>
