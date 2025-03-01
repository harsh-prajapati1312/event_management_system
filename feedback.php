


<?php
         include('admin/dbconnection.php');
          include('conn.php');
          include_once ("filter.php");
         if (isset($_POST['submit'])) 
         {
           $name = sanitizeAndFilterXSS($_POST['name']);
          $email = sanitizeAndFilterXSS($_POST['email']);
          $subject = sanitizeAndFilterXSS($_POST['subject']);
          $message = sanitizeAndFilterXSS($_POST['message']);

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
          <form  method="post" role="form" class="contactForm">
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

      </div>
    </section>