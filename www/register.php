<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<?php
$fnameErr = $lnameErr = $emailErr = $passErr = $contactErr = '';
$fname = $lname = $email = $contact = $password = $biodata = '';
function input_data($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["fname"])) {
    $fnameErr = "First name is required";
  } else {
    $fname = input_data($_POST["fname"]);
    if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
      $fnameErr = "Only alphabets and white space are allowed";
    }
  }
  if (empty($_POST["lname"])) {
    $lnameErr = "Last name is required";
  } else {
    $lname = input_data($_POST["lname"]);
    if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
      $lnameErr = "Only alphabets and white space are allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = input_data($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["contact"])) {
    $contactErr = "Contact no is required";
  } else {
    $contact = input_data($_POST["contact"]);
    if (!preg_match("/^[0-9]*$/", $contact)) {
      $contactErr = "Only numeric value is allowed.";
    }
    if (strlen($contact) < 11 and strlen($contact) > 12) {
      $contactErr = "Contact no. must be either 11 or 12 digits including country code.";
    }
  }

  if (empty($_POST["password"])) {
    $passErr = "Password is required";
  } else {
    $password = input_data($_POST["password"]);
    if (strlen($password) < 10) {
      $passErr = "Password must contain at least 10 characters.";
    }
  }

}
?>

<body>
  <!-- Section: Design Block -->
  <section class="">
    <!-- Jumbotron -->
    <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
      <div class="container">
        <div class="row gx-lg-5 align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <h1 class="my-5 display-3 fw-bold ls-tight">
              The best offer <br />
              <span class="text-primary">for your business</span>
            </h1>
            <p style="color: hsl(217, 10%, 50.8%)">
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Eveniet, itaque accusantium odio, soluta, corrupti aliquam
              quibusdam tempora at cupiditate quis eum maiores libero
              veritatis? Dicta facilis sint aliquid ipsum atque?
            </p>
          </div>

          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="card">
              <div class="card-body py-5 px-md-5">
                <!-- <form action="register.php" method="post"> -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method='post'
                  enctype="multipart/form-data" id="regform">
                  <!-- 2 column grid layout with text inputs for the first and last names -->
                  <div class="form-outline mb-4">
                    <span class="error">* required field </span>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" id="fname" class="form-control" name="fname" placeholder="Jane" required />
                        <label class="form-label" for="fname">First name <span class="error">* <?php echo $fnameErr; ?>
                          </span></label>

                      </div>
                    </div>
                    <div class="col-md-6 mb-4">
                      <div class="form-outline">
                        <input type="text" id="lname" class="form-control" name="lname" placeholder="Doe" required />
                        <label class="form-label" for="lname">Last name <span class="error">* <?php echo $lnameErr; ?>
                          </span></label>

                      </div>
                    </div>
                  </div>

                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="email" id="email" class="form-control" name="email" placeholder="jane@doe.com"
                      required />
                    <label class="form-label" for="email">Email address <span class="error">*
                        <?php echo $emailErr; ?> </span></label>
                  </div>

                  <!-- Contact input -->
                  <div class="form-outline mb-4">
                    <input type="tel" id="contact" class="form-control" name="contact"
                      placeholder="e.g., 601612345678 (11 or 12 digits including country code)" pattern="^\d{11,12}$"
                      required />
                    <!-- pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"-->
                    <label class="form-label" for="contact">Contact Number <span class="error">*
                        <?php echo $contactErr; ?> </span></label>
                  </div>

                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" id="password" class="form-control" name="password" required />
                    <label class="form-label" for="password">Password <span class="error">* <?php echo $passErr; ?>
                      </span></label>
                  </div>

                  <!-- User Info input -->
                  <div class="form-outline mb-4">
                    <!-- <input type="text" id="form3Example4" class="form-control"/> -->
                    <textarea class="form-control" id="biodata" rows="3" name="biodata"
                      placeholder="Tell us something about yourself."></textarea>
                    <label class="form-label" for="biodata">Enter Biodata (optional)</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input class="form-control" type="file" id="avatar" name="avatar">
                    <label for="formFile" class="form-label">Upload your Profile Picture (optional)</label>
                  </div>

                  <!-- Submit button -->
                  <button type="submit" class="btn btn-primary btn-block mb-4" name="signup">
                    <!-- The name attribute is crucial, as it is what PHP's isset function looks for when triggered. -->
                    Sign up
                  </button>
                  <a href="index.php">
                    <button type="button" class="btn btn-primary btn-block mb-4" name="login">Login</button>
                  </a>
                </form>
                <?php
                if (isset($_POST['signup'])) {
                  if ($fnameErr == '' && $lnameErr == '' && $emailErr == '' && $contactErr == '' && $passErr == '') {
                  } else {
                    echo "<h3> <b>You didn't fill up the form correctly!</b> </h3>";
                    echo "<br><h3>error [$fnameErr$lnameErr$emailErr$contactErr$passErr] error ends</h3>";
                    exit(1); // force quit
                  }
                } else {
                  exit(1);
                }
                include 'dbconfig.php';

                $fname = mysqli_real_escape_string($conn, $_POST['fname']); // mysqli_real_escape_string sanitizes input, minize risk of sql injection
                $lname = mysqli_real_escape_string($conn, $_POST['lname']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $contact = mysqli_real_escape_string($conn, $_POST['contact']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $biodata = mysqli_real_escape_string($conn, $_POST['biodata']);

                $password = password_hash($password, PASSWORD_ARGON2I);

                //Processing Avatar
                // Use finfo to determine the MIME type
                function isImage($fileTmpLoc)
                {
                  $finfo = finfo_open(FILEINFO_MIME_TYPE);
                  $mimeType = finfo_file($finfo, $fileTmpLoc);
                  finfo_close($finfo);

                  // Check if the MIME type starts with "image/"
                  if (strpos($mimeType, 'image/') === 0) {
                    return true;
                  } else {
                    echo "<script>alert('Only image files are allowed!');</script>";
                  }
                }

                if (!empty($_FILES['avatar']['name'])) {
                  // checks if any file was ever uploaded
                  $fileName = $_FILES['avatar']['name'];
                  $fileTmpLoc = $_FILES['avatar']['tmp_name'];
                  if (isImage($fileTmpLoc)) {
                    $targetDir = 'avatar/';
                    $uploadPath = $fileName ? ($targetDir . $fileName) : '';
                    // $output=print_r($_FILES['avatar'], true);
                    // error_log("This is tmp location: $output", 3, "C:\\wamp64\\logs\\custom_log.log");
                    if (!move_uploaded_file($fileTmpLoc, $uploadPath)) {
                      echo "<script>alert('Unable to upload image.')</script>";
                      error_log('Failed to upload image.', 0);
                      $uploadPath = '';
                    }
                  } else {
                    error_log('Only image files are allowed!');
                    $uploadPath = '';
                  }
                } else {
                  $test = $_FILES['avatar']['name'];
                  error_log("No file was ever sent by user. Image uploading skipped. $test", 0);
                  $uploadPath = '';
                }

                // $signupQuery = "INSERT INTO users(fname,lname,email,contact,password,biodata) VALUES ('$fname','$lname','$email','$contact','$password','$biodata')"; // this works even for special characters, concatenation method below is not mandatory
                $signupQuery = "INSERT INTO users (fname,lname,email,contact,password,biodata,avatar) VALUES ('" . $fname . "','" . $lname . "','" . $email . "','" . $contact . "','" . $password . "','" . $biodata . "','" . $uploadPath . "')";

                $result = mysqli_query($conn, $signupQuery);
                $conn->close();

                if ($result) {
                  echo "<script>alert('User Registration Successful!');
                  ;window.location.href='index.php'
                  </script>";
                } else {
                  echo "<script>alert('Unable to Register. Try Again!');</script>";
                }
                if (isset($_POST['login'])) {
                  header('Location: index.php'); //to redirect from one page to another similar to anchor tag
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Jumbotron -->
  </section>
  <!-- Section: Design Block -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>