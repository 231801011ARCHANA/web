<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-q8i/X+965DzO0rtnkSN93Cb1zIOZkhmtdxG5N9p1C2jEqW3eOmamwl7x9e5Dyj7T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- code starts -->
     <header class="sticky-top">
        <input type="checkbox" id="toggler">
        <label class="bar" for="toggler"><ion-icon name="menu"></ion-icon></label>
        
        <a href="#" class="logo">Ecommerce</a>

        <nav class="navbar">
            <a href="#">Home</a>
            <a class="about" href="#">About
                <div class="popup-content" style="text-align: center; background-color: aliceblue;">
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. At, dolores.</p>
                </div>
            </a>
            <a href="#">Products</a>
            <a href="#">Review</a>
            <a href="#">Contact</a>
            <button type="button" class="btn btn-primary w-10"><a class="text-light" href="logout.php">Logout</a></button>
        
        </nav>

        <div class="icons">
            <a href="#"><ion-icon name="heart"></ion-icon></a>
            <a href="#"><ion-icon name="cart"></ion-icon></a>
            <a href="#changemodal" data-bs-toggle="modal" data-bs-target="#changeModal"><ion-icon name="person-circle"></ion-icon></a>
        </div>

     </header>

     <div style="color: rgb(232, 71, 135)" class="welcome bg-light m-2 px-5">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    </div>

     <!-- pop login -->
     <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                <form action="login.php" method="POST" class="p-3 rounded" style="background-color: rgb(18, 18, 81); color: rgb(213, 202, 202); height: 400px; width: 400px;">
                    <h1>Login</h1>                  
                    <form-group>
                        <label for="email">Email Id*</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </form-group>
                    <form-group>
                        <label for="password">Password*</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </form-group>
                    <button type="submit" class="btn btn-primary my-4 w-100">Submit</button>
                    <a class="form-control text-primary px-5" style="background:none; border: none;" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Don't have an account? Register now!</a>
                    <br>
                    <a class="form-control text-primary" style="background:none; border: none; padding-left: 120px;" href="#" data-bs-toggle="modal" data-bs-target="#changeModal">Forgot password?</a>
                </form>
            </div>
          </div>
        </div>
    </div>

    <!-- pop register -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                <form action="register.php" method="post" class="p-3 rounded" style="background-color: rgb(18, 18, 81); color: rgb(213, 202, 202); height: 550px; width: 400px;">
                    <h1>Register</h1>
                
                    <div class="form-group">
                        <label for="username">User Name*</label>
                        <input type="text" class="form-control" name="username" placeholder="User Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Id*</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile No.*</label>
                        <input type="tel" class="form-control" name="mobile" placeholder="Mobile No." required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password*</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password*</label>
                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                    <button class="btn btn-primary my-4 w-100" type="submit">Register</button>
                    <a class="form-control text-primary px-5" style="background:none; border: none;" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Already have an account? Login now!</a>
                </form>
                
            </div>
          </div>
        </div>
    </div>

    <!-- pop change -->

    <div class="modal fade" id="changeModal" tabindex="-1" aria-labelledby="changeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                <form action="change_password.php" method="POST" class="p-3 rounded" style="background-color: rgb(18, 18, 81); color: rgb(213, 202, 202); height: 460px; width: 400px;">
                    <h1>Change Password</h1>
                    <br>
                    <form-group>
                        <label for="email">Email Id*</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </form-group>
                    <form-group>
                        <label for="password">New Password*</label>
                        <input type="password" name="password" class="form-control" placeholder="password" required>
                    </form-group>
                    <form-group>
                        <label for="password">Confirm Password*</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="confirm password" required>
                    </form-group>
                    <button type="submit" class="btn btn-primary my-4 w-100">Change Password</button>
                    <a class="form-control text-primary" style="background:none; border: none; padding-left: 140px;" href="login.php">Login Now!</a>
                </form>                
            </div>
          </div>
        </div>
    </div>

    <div class="search my-2">
        <form action="" style="width: 300px; ">
            <div class="row">
                <div class="col">
                    <input class="form-control" type="search" placeholder="Search">
                </div>
                <div class="col">
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
     </div>
     <div class="img">
        <div id="demo" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
              <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="https://i.pinimg.com/originals/17/f0/5f/17f05fe00ece62503f2995f6e9fc70a7.jpg" alt="img1" class="w-100">
              </div>
              <div class="carousel-item">
                <img src="https://i.pinimg.com/originals/17/f0/5f/17f05fe00ece62503f2995f6e9fc70a7.jpg" alt="img2" class="w-100">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
            </button>
            <!-- <form action="" class="form-overlay p-3 rounded" style="float: right; background-color: rgb(18, 18, 81); color: rgb(213, 202, 202); height: 300px; width: 400px;">
                <h1>Login</h1>
                <form-group>
                    <label for="email">Email Id*</label>
                    <input type="email" class="form-control" placeholder="Email" required>
                </form-group>
                <form-group>
                    <label for="password">password*</label>
                    <input type="password" class="form-control" placeholder="password" required></input>
                </form-group>
                <button class="btn btn-primary my-4 w-100">Submit</button>
              </form>
          </div> -->
    </div>
    <div class="b1 py-4 my-2" style="background-color: antiquewhite; text-align: center;">
      <div class="container">
        <h2>ABOUT</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit vitae dolorem, possimus quia ea rem inventore a nemo quidem sed fugit unde magni, maiores aspernatur molestias enim odio illo. Nihil, magni quod quis quos hic placeat debitis fugit beatae, odit explicabo nam incidunt sunt accusamus eaque inventore cupiditate nostrum optio similique? Eum quia ut error temporibus excepturi labore cumque qui laudantium reiciendis dolorum impedit itaque, in incidunt fugit molestiae minus. Ipsam velit temporibus nisi aliquid iste autem voluptatum asperiores id, hic inventore consequatur, exercitationem ex at veritatis deserunt, excepturi distinctio. Minima ullam quos debitis fugiat, veritatis culpa reprehenderit provident impedit!</p>
      </div>
    </div>
    <div class="b2 p-5" style="background-color: rgb(210, 234, 251);">
      <div class="row">
        <div class="mb-2 col-12 col-sm-6 col-md-4">
            <div class="card h-100 w-100">
                <img style="height: 80px; width: 80px; padding-left: 10px; padding-top: 10px;" src="fruits.jpg" alt="webapp">
                <div class="card-body">
                    <h2 style="color: rgb(15, 15, 98);">Fruits</h2>
                    <p style="color: black;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis tempora laudantium aperiam adipisci assumenda distinctio earum odit obcaecati voluptas iusto?</p>
                </div>
            </div>
        </div>
        <div class="mb-2 col-12 col-sm-6 col-md-4">
            <div class="card h-100 w-100">
                <img style="height: 80px; width: 80px; padding-left: 10px; padding-top: 10px;" src="veg.jpg" alt="webapp">
                <div class="card-body">
                    <h2 style="color: rgb(15, 15, 98);">Vegetables</h2>
                    <p style="color: black;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet molestiae a inventore in, quaerat consectetur reiciendis ipsa quisquam corporis aspernatur.</p>
                </div>
            </div>
        </div>
        <div class="mb-2 col-12 col-sm-6 col-md-4">
            <div class="card h-100 w-100">
                <img style="height: 80px; width: 80px; padding-left: 10px; padding-top: 10px;" src="grocery.jpg" alt="webapp">
                <div class="card-body">
                    <h2 style="color: rgb(15, 15, 98);">Grocery</h2>
                    <p style="color: black;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam ab similique et? Dolorem, a illo. Nihil quasi quisquam nobis commodi.</p>
                </div>
            </div>
        </div>
        <div class="mb-2 col-12 col-sm-6 col-md-4">
            <div class="card h-100 w-100">
                <img style="height: 80px; width: 80px; padding-left: 10px; padding-top: 10px;" src="snack.jpg" alt="webapp">
                <div class="card-body">
                    <h2 style="color: rgb(15, 15, 98);">Snacks</h2>
                    <p style="color: black;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nisi consequuntur excepturi fugiat ea a dolor praesentium ducimus placeat natus voluptas.</p>
                </div>
            </div>
        </div>
        <div class="mb-2 col-12 col-sm-6 col-md-4">
            <div class="card h-100 w-100">
                <img style="height: 80px; width: 80px; padding-left: 10px; padding-top: 10px;" src="stationary.jpg" alt="webapp">
                <div class="card-body">
                    <h2 style="color: rgb(15, 15, 98);">Stationary</h2>
                    <p style="color: black;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi itaque quas excepturi suscipit laborum exercitationem, minus reiciendis aperiam modi ipsa.</p>
                </div>
            </div>
        </div>
        <div class="mb-2 col-12 col-sm-6 col-md-4">
            <div class="card h-100 w-100">
                <img style="height: 80px; width: 80px; padding-left: 10px; padding-top: 10px;" src="utensil.jpg" alt="webapp">
                <div class="card-body">
                    <h2 style="color: rgb(15, 15, 98);">Utensils</h2>
                    <p style="color: black;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates hic fugiat eum quibusdam officia odio ut deleniti inventore sequi doloribus?</p>
                </div>
            </div>
        </div>
    </div>
    <button class="btn text-primary pt-3 d-block mx-auto"><b>View All Products </b><span class="badge bg-primary"><ion-icon name="play-circle-outline"></ion-icon></span></button>
    </div>
    <hr>
    <footer>
      <div class="f1">
        <div class="row">
          <div class="col">
              <p>© 2025 All Rights Reserved.</p>
          </div>
          <div class="col d-flex justify-content-end">
              <ul class="list-inline">
                  <li class="list-inline-item"><a class="text-decoration-none" href="#">Privacy Policy</a></li>|
                  <li class="list-inline-item"><a class="text-decoration-none" href="#">Terms & Conditions</a></li>|
                  <li class="list-inline-item"><a class="text-decoration-none" href="#">Refund & Cancellation Policy</a></li>
              </ul>
          </div>
      </div>
      </div>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>