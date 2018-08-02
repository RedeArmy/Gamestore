<script language="javascript">
   function activar(){
      document.getElementById('boton1').disabled = false;
    }
</script>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AD2</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/landing-page.min.css" rel="stylesheet">

  </head>

  <body id="start">

    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <div class="container"> 
		<i class="fa fa-amazon m-auto" style="color:white"></i> 
        <a class="navbar-brand js-scroll-trigger" href="#start">&nbsp; AWS Practice #2</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="about.html">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="service.html">Services</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <!-- Masthead -->
    <header class="masthead text-white text-center">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <h1 class="mb-5">Building The Perfect Clound For Save Your Photos!</h1>
          </div>
        </div>
      </div>
    </header>

    <!-- Icons Grid -->
    <section class="features-icons bg-light text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
              <div class="features-icons-icon d-flex">
                <i class="icon-cloud-upload m-auto text-primary"></i>
              </div>
              <h3>Upload Images</h3>
              <p class="lead mb-0">Upload all kind of images to your S3 bucket, no matter the size!</p>
            </div>
            
            <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="form-control-file" name="fileUpload" id="fileUpload" accept="image/*" onClick="activar()">
              </div>
              <div class="input-group-append">
                <input type="submit" class="btn btn-outline-primary" value="UPLOAD" name="submit" id="boton1" disabled="true">
              </div>
            </div>
            </form>

          </div>
          <div class="col-lg-6">
            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
              <div class="features-icons-icon d-flex">
                <i class="icon-trash m-auto text-primary"></i>
              </div>
              <h3>Ready to Delete</h3>
              <p class="lead mb-0">Delete your saved photos just with a click!</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Image Showcases -->
    <section class="showcase">
      <div class="container-fluid p-0">
        <div class="row no-gutters">

          <div class="col-lg-12 order-lg-1 my-auto showcase-text">
            <center><h2>PHOTO REPOSITORY</h2></center>
            <br>
            <?php
                include 'variables.php';
                
                $conn = mysqli_connect($Endpoint, $UserDB , $PswDB, $DBName);

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                else{
                    $sql = "SELECT * FROM PHOTO";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $html =  "<table class=\"table\" style=\"text-align:center;\">";
                        $html .=  "<thead class=\"thead-dark\">";
                        $html .= "<tr>";
                        $html .= "<th scope=\"col\">#</th>";
                        $html .= "<th scope=\"col\">Path</th>";
                        $html .= "<th scope=\"col\">Date</th>";
                        $html .= "<th scope=\"col\">Photo</th>";
                        $html .= "<th scope=\"col\">Action</th>";
                        $html .= "</tr>";
                        $html .= "</thead>";
                        $html .= "<tbody>";
                        while($row = $result->fetch_assoc()) {
                            $html .= "  <tr>";
                            $html .= "    <th scope=\"row\">". $row["id_photo"]. "</th>";
                            $html .= "    <td>". $row["path_s3"] . "</td>";
                            $html .= "    <td>". $row["date_upload"] . "</td>";
                            $html .= "    <td><img src=\"/bucket/".$row["path_s3"] ."\" height=\"100\" width=\"100\"></td>";
                            $html .= "    <td> <form action=\"delete.php\" method=\"post\" enctype=\"multipart/form-data\">";
                            $html .= "    <input type=\"hidden\" value=\"".$row["path_s3"]."\" name=\"path\">";
                            $html .= "    <input type=\"submit\" class=\"btn btn-outline-danger\" value=\"DELETE\" name=\"submit\">";
                            $html .= " </form>";
                            $html .= " </td>";
                            $html .= "  </tr>";
                        }
                        $html .=  "</tbody>";
                        $html .=  "</table>";
                        echo $html;
                    } else {
                        $alert =  "<div class=\"alert alert-warning\">";
                        $alert .= "<strong>Warning!</strong> No Photo Saved!";
                        $alert .= "</div>";
                        echo $alert;
                    }
                    $conn->close();
                }
            ?>
          </div>
        </div>

    </section>

    <!-- Footer -->
    <footer class="footer bg-dark">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
            <ul class="list-inline mb-2">
              <li class="list-inline-item">
                <a href="#">About</a>
              </li>
              <li class="list-inline-item">&sdot;</li>
              <li class="list-inline-item">
                <a href="#">Contact</a>
              </li>
              <li class="list-inline-item">&sdot;</li>
              <li class="list-inline-item">
                <a href="#">Terms of Use</a>
              </li>
              <li class="list-inline-item">&sdot;</li>
              <li class="list-inline-item">
                <a href="#">Privacy Policy</a>
              </li>
            </ul>
            <p class="text-muted small mb-4 mb-lg-0">&copy; Your Website 2018. All Rights Reserved.</p>
          </div>
          <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
            <ul class="list-inline mb-0">
              <li class="list-inline-item mr-3">
                <a href="#">
                  <i class="fa fa-facebook fa-2x fa-fw"></i>
                </a>
              </li>
              <li class="list-inline-item mr-3">
                <a href="#">
                  <i class="fa fa-twitter fa-2x fa-fw"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-instagram fa-2x fa-fw"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
