<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: index.php');
}
?>
<!doctype html>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8">
  <title>User Page</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/cover/">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <meta name="theme-color" content="#712cf9">
  <style>
    #avatar {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
    }

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }
  </style>

  <!-- Custom styles for this template -->
  <link href="https://getbootstrap.com/docs/5.3/examples/cover/cover.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-bg-dark">

  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
      <?php
      include 'dbconfig.php';

      $email = $_SESSION['email'];

      $userQuery = "SELECT * FROM users WHERE email='" . $email . "'";
      $result = mysqli_query($conn, $userQuery);
      $conn->close();

      while ($userArray = mysqli_fetch_assoc($result)) {
        $fname = $userArray['fname'];
        $lname = $userArray['lname'];
        $email = $userArray['email'];
        $contact = $userArray['contact'];
        $biodata = $userArray['biodata'];
        $avatar = $userArray['avatar'];
        if (empty($avatar)) {
          $avatar = 'avatar/default.webp';
        }
      }
      ?>
      <div>
        <h3 class="float-md-start mb-0">User Page</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
          <a class="nav-link fw-bold py-1 px-0 active" aria-current="page" href="#">Home</a><!--  -->
          <a class="nav-link fw-bold py-1 px-0" href="logout.php">Logout</a>

        </nav>
      </div>
    </header>

    <main class="px-3">
      <h1><?php echo "$fname $lname"; ?></h1><!-- Display User Name -->
      <img src="<?php echo $avatar; ?>" alt="profile picture" class="avatar" id="avatar">
      <div class="avatar-container" id="avatar-container">
      </div>

      <!-- width="300" height="300" -->
      <p class="lead" onclick="copyToClipboard(this.id)" id="email" style="cursor:pointer;" title="email"><?php echo $email; ?></p>
      <p class="lead" onclick="copyToClipboard(this.id)" id="contact" style="cursor:pointer;" title="contact"><?php echo $contact; ?>
      </p>
      <p class="lead" onclick="copyToClipboard(this.id)" id="contact" style="cursor:pointer;" title="biodata"><?php echo $biodata; ?>
      </p>

      <script>
        const copyToClipboard = async (id) => {
          try {
            const element = document.querySelector(`#${id}`);
            await navigator.clipboard.writeText(element.textContent);
            console.log("Text copied to clipboard!");

            // Custom notification (toast) after successful copy
            const toast = document.createElement('div');
            toast.textContent = "Text copied to clipboard!";
            toast.style.position = "fixed";
            toast.style.bottom = "20px";
            toast.style.right = "20px";
            toast.style.background = "#333";
            toast.style.color = "#fff";
            toast.style.padding = "10px";
            toast.style.borderRadius = "5px";
            toast.style.boxShadow = "0 4px 6px rgba(0, 0, 0, 0.1)";
            document.body.appendChild(toast);

            // Remove the toast after 3 seconds
            setTimeout(() => {
              toast.remove();
            }, 3000);
            // Optional: Display a success message to the user
          } catch (error) {
            console.error("Failed to copy to clipboard:", error);
            // Optional: Display an error message to the user
          }
        };
      </script>

    </main>

    <footer class="mt-auto text-white-50">
      <p>Cover template for <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>, by <a
          href="https://twitter.com/mdo" class="text-white">@mdo</a>.</p>
    </footer>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>