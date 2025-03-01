<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>


<head>
  <!-- CSS here -->
  <link rel="stylesheet" href="css/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/css/magnific-popup.css">
  <link rel="stylesheet" href="css/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/css/themify-icons.css">
  <link rel="stylesheet" href="css/css/nice-select.css">
  <link rel="stylesheet" href="css/css/audioplayer.css">
  <link rel="stylesheet" href="css/css/flaticon.css">
  <link rel="stylesheet" href="css/css/gijgo.css">
  <link rel="stylesheet" href="css/css/animate.css">
  <link rel="stylesheet" href="css/css/slick.css">
  <link rel="stylesheet" href="css/css/slicknav.css">
  <link rel="stylesheet" href="css/css/style.css">
  <!-- <link rel="stylesheet" href="css/responsive.css"> -->
  <meta charset="utf-8">
  <title>Ukhay Event</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/Event.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800"
    rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/venobox/venobox.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: TheEvent
    Theme URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->

  <style>
    .image-container {
      position: relative;
      width: 100%;
      height: 0;
      padding-top: 100%;
      /* Set aspect ratio here (e.g., 1:1 aspect ratio) */
      overflow: hidden;
    }

    .image-container img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      /* Ensure the image covers the container */
    }
  </style>
</head>

<body>


  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <!-- Uncomment below if you prefer to use a text logo -->
        <!-- <h1><a href="#main">C<span>o</span>nf</a></h1>-->
        <a href="#intro" class="scrollto"><img src="img\Event.png" alt="" title="UKHY Event">UKHY Event</a>

      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#intro">Home</a></li>
          <!-- <li><a href="#about">About</a></li> -->
          <li><a href="#speakers">Speakers</a></li>

          <li><a href="#venue">Venue</a></li>
          <!-- <li><a href="#hotels">Hotels</a></li> -->
          <li><a href="#gallery">Gallery</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="new_bookings.php">Booking</a></li>
          <li><a href="#feedback">feedback</a></li>




          <?php if (isset($_SESSION['Uname'])) {
            ?>
            <li><a href="myad.php">My Booking</a></li>
            <li><a href="logout.php" style="color:red;font-weight: 900; font-size:15px;">Logout</a></li>
            <?php
          } else {
            ?>
            <li><a href="loginn.php">Login</a></li>
            <li><a href="signup.php">SignUp</a></li>
            <?php

          }
          ?>

        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section.....
  ============================-->

  <section id="intro">

    <div class="container">
      <div class="row no-gutters">
        <div class="col-xl-4 col-lg-3 col-md-6">
          <div class="single_video">

            <div class="hover_elements">
              <div class="video">
                <a class="popup-video" href=""> </a>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section><br>
  <div class="col-12">
    <center>
      <section>
        <video class="w-100" autoplay muted>
          <source src="event.mp4" type="video/mp4">
          Your browser does not support HTML video.
        </video>

      </section>
    </center>
  </div>
  <main id="main">

    <!--==========================
      About Section
    ============================-->
    <!-- <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h2>About The Event</h2>
            <p>Sed nam ut dolor qui repellendus iusto odit. Possimus inventore eveniet accusamus error amet eius aut
              accusantium et. Non odit consequatur repudiandae sequi ea odio molestiae. Enim possimus sunt inventore in
              est ut optio sequi unde.</p>
          </div>
          <div class="col-lg-3">
            <h3>Where</h3>
            <p>Downtown Conference Center, Surat</p>
          </div>
          <div class="col-lg-3">
            <h3>When</h3>
            <p>Monday to Wednesday<br>10-12 December</p>
          </div>
        </div>
      </div>
    </section> -->

    <!--==========================
      Speakers Section
    ============================-->
    <section id="speakers" class="wow fadeInUp">
      <div class="containspeakerser">
        <div class="section-header">
          <h2>Event Menagment Team..</h2>
          <p>Here are some of our speakers</p>
        </div>
        <div class="row">
          <?php
          include("conn.php");
          function removeImgPath($string)
          {
            return str_replace("../", "", $string);
          }
          $conn = connection();
          $sql = "select * from emp";
          $result = $conn->query($sql);

          while ($row = $result->fetch_assoc()) {
            ?>
            <div class="col-lg-4 col-md-4">
              <div class="speaker">
                <div class="image-container">
                  <img src="<?php $tmp = removeImgPath($row['image']);
                  echo $tmp; ?>" alt="Speaker" class="img-fluid">
                </div>
                <div class="details">
                  <h3>
                    <?php echo $row['name']; ?>
                  </h3>
                  <p>
                    <?php echo $row['dname']; ?>
                  </p>
                  <div class="social">
                    <!-- Your social media links or icons here -->
                  </div>
                </div>
              </div>
            </div>

            <?php
          }
          ?>
        </div>



    </section>

    </div>

    </div>

    </section>

    <!--==========================
      Venue Section
    ============================-->
    <section id="venue" class="wow fadeInUp">

      <div class="container-fluid">

        <div class="section-header">
          <h2>Event Venue</h2>
          <p>Event venue location info and gallery</p>
        </div>

        <div class="row no-gutters">
          <div class="col-lg-6 venue-map">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3718.548949522343!2d72.7829824752627!3d21.2497274804554!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04bf3cafd28cd%3A0xa4e0ddcf95fb09e9!2sVivekanand%20College!5e0!3m2!1sen!2sin!4v1705481901121!5m2!1sen!2sin"
              width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>

          <div class="col-lg-6 venue-info">
            <div class="row justify-content-center">
              <div class="col-11 col-lg-8">
                <h3>Downtown Conference Center, Surat</h3>
                <p>Iste nobis eum sapiente sunt enim dolores labore accusantium autem. Cumque beatae ipsam. Est quae sit
                  qui voluptatem corporis velit. Qui maxime accusamus possimus. Consequatur sequi et ea suscipit enim
                  nesciunt quia velit.</p>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="container-fluid venue-gallery-container">
        <div class="row no-gutters">

          <div class="col-lg-3 col-md-4">
            <div class="venue-gallery">
              <a href="img/venue-gallery/1.jpg" class="venobox" data-gall="venue-gallery">
                <img src="img/venue-gallery/1.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="venue-gallery">
              <a href="img/venue-gallery/2.jpg" class="venobox" data-gall="venue-gallery">
                <img src="img/venue-gallery/2.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="venue-gallery">
              <a href="img/venue-gallery/3.jpg" class="venobox" data-gall="venue-gallery">
                <img src="img/venue-gallery/3.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="venue-gallery">
              <a href="img/venue-gallery/4.jpg" class="venobox" data-gall="venue-gallery">
                <img src="img/venue-gallery/4.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="venue-gallery">
              <a href="img/venue-gallery/5.jpg" class="venobox" data-gall="venue-gallery">
                <img src="img/venue-gallery/5.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="venue-gallery">
              <a href="img/venue-gallery/6.jpg" class="venobox" data-gall="venue-gallery">
                <img src="img/venue-gallery/6.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="venue-gallery">
              <a href="img/venue-gallery/7.jpg" class="venobox" data-gall="venue-gallery">
                <img src="img/venue-gallery/7.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="venue-gallery">
              <a href="img/venue-gallery/8.jpg" class="venobox" data-gall="venue-gallery">
                <img src="img/venue-gallery/8.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

        </div>
      </div>

    </section>

   

    <!--==========================
      Gallery Section
    ============================-->
    <section id="gallery" class="wow fadeInUp">

      <div class="container">
        <div class="section-header">
          <h2>Gallery</h2>
          <p>Check our gallery from the recent events</p>
        </div>
      </div>

      <div class="owl-carousel gallery-carousel">
        
   <?php
    
        $conn = connection();
          $sql = "select * from tblgallery";
          $result = $conn->query($sql);

          while ($row = $result->fetch_assoc()) {
            ?>
           <a href="<?php $tmp = removeImgPath($row['gimgpath']);
                  echo $tmp; ?>" class="venobox" data-gall="gallery-carousel"><img src="<?php $tmp = removeImgPath($row['gimgpath']);
                  echo $tmp; ?>"
            alt=""></a>
          <?php
}
          ?>
       
        
      </div>

    </section>

    <!--==========================
      Sponsors Section
    ============================-->

    <!--==========================
      F.A.Q Section
    ============================-->
    <!--==========================
      Subscribe Section
    ============================-->
    <!-- <section id="subscribe">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h2>Newsletter</h2>
          <p>Rerum numquam illum recusandae quia mollitia consequatur.</p>
        </div>

        <form method="POST" action="#">
          <div class="form-row justify-content-center">
            <div class="col-auto">
              <input type="text" class="form-control" placeholder="Enter your Email">
            </div>

          </div>
        </form>

      </div>
    </section> -->

    <!--==========================
      Buy Ticket Section
    ============================-->


    <!-- Modal Order Form -->
    <div id="buy-ticket-modal" class="modal fade">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">

          </div>
          <div class="modal-body">
            <form method="POST" action="#">
              <div class="form-group">
                <input type="text" class="form-control" name="your-name" placeholder="Your Name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="your-email" placeholder="Your Email">
              </div>

            </form>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    </section>

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="section-bg wow fadeInUp">

      <div class="container">

        <div class="section-header">
          <h2>Contact Us</h2>
          <p></p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Address</h3>
              <address>VIVEKANAND COLLEGE, SURAT</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:+91 9574248115">+91 9574248115</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:prajapatiharsh1312@gmail.com">prajapatiharsh1312@gmail.com</a></p>
            </div>
          </div>

        </div>


        
        
       <!-- #contact -->

  </main>

  <?php
         include('admin/dbconnection.php');
          #include('conn.php');
         if (isset($_POST['submit'])) 
         {
           $name = $_POST['name'];
          $email = $_POST['email'];
          $subject = $_POST['subject'];
          $message = $_POST['message'];

          $sql = "insert into tblfeedback (name,email,subject,message) values(:name,:email,:subject,:message)";
          $query = $dbh->prepare($sql);
          $query->bindParam(':name', $name, PDO::PARAM_STR);
          $query->bindParam(':email', $email, PDO::PARAM_STR);
          $query->bindParam(':subject', $subject, PDO::PARAM_STR);
          $query->bindParam(':message', $message, PDO::PARAM_STR);

          $query->execute();
          $LastInsertId = $dbh->lastInsertId();
          if ($LastInsertId > 0) {
            echo '<script>alert("feedback has been added.")</script>';
          } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
          }
        }

        ?>  
  <div class="form">
          <!-- <div id="sendmessage">Your message has been sent. Thank you!</div> -->
          <div id="errormessage"></div>
          <div class="section-header">
          <h2>Feedback</h2>
          <p></p>
          <table >
        </div>
          <form  method="post" role="form" id="feedback" class="Feedback">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                  data-rule="minlen:4" data-msg="Please enter at least 4 chars" required>
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"
                  data-rule="email" data-msg="Please enter a valid email" required>
                <div class="validation"></div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" required>
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required"
                data-msg="Please write something for us" placeholder="Message" required></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center"><button type="submit" name="submit">Send Message</button></div>
          </form>
        </div>
      </table>
      </div>
    </section>


  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container3">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <img src="img/Event.png" alt="TheEvenet">
            <p></p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="#intro">Home</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#speakers">Speakers</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#venue">Vanue</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#gallery">Gallery</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="#contact">Contact</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="new_bookings.php">Booking</a></li> 
              <li><i class="fa fa-angle-right"></i> <a href="myad.php">My Booking</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#intro">Home</a></li>
             </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              <br>Vivekanad collage 
              Surat <br>
              <br>
              <strong>Phone:</strong> +91 9574248115<br>
              <strong>Email:</strong>prajapatiharsh1312@gmail.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>

        </div>
      </div>
    </div>
      

   

    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/venobox/venobox.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $(document).on('click', '.edit_data4', function () {
        var edit_id4 = $(this).attr('id');
        $.ajax({
          url: "view_newbookings.php",
          type: "post",
          data: { edit_id4: edit_id4 },
          success: function (data) {
            $("#info_update4").html(data);
            $("#editData4").modal('show');
          }
        });
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function () {
      $(document).on('click', '.edit_data2', function () {
        var edit_id2 = $(this).attr('id');
        $.ajax({
          url: "newbooking_action.php",
          type: "post",
          data: { edit_id2: edit_id2 },
          success: function (data) {
            $("#info_update2").html(data);
            $("#newbid_action").modal('show');
          }
        });
      });
    });
  </script>
  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>
</body>

</html>