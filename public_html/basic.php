<?php
// handle the post request 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // initialize everything
  // set the error variable array
  $errors = array();
  // functions
  function clean_input($user_input) {
    $user_input = trim($user_input);
    $user_input = stripslashes($user_input);
    $user_input = htmlspecialchars($user_input);
    return $user_input;
  }
  // check if the user input is empty, clean it up and set the variables.
  // first name
  if(!empty($_POST['first_name'])) {
    $first_name = clean_input($_POST['first_name']);
  } else {
    array_push($errors, "First name cannot be empty.");
  }
  // last name
  if(!empty($_POST['last_name'])) {
    $last_name = clean_input($_POST['last_name']);
  } else {
    array_push($errors, "Last name cannot be empty.");
  }
  // email address
  if(!empty($_POST['email'])) {
    // check if this is a legit email address
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $email = clean_input($_POST['email']);
    } else {
      array_push($errors, "The e-mail address is not valid.");
    }
  } else {
    array_push($errors, "E-mail cannot be empty.");
  }
  // form message
  if(!empty($_POST['message'])) {
    $message = clean_input($_POST['message']);
  } else {
    array_push($errors, "Please enter your message.");
  }
  // send the email
  if(count($errors) == 0) {
    // wrap the message
    $message = wordwrap($message);
    // creat email body
    $mail_body = '
     Full name: '.$first_name.' '.$last_name.' <br>
     E-mail Address: '.$email.' <br>
     Message: '.$message.'
    ';
    // send the mail
    $sent = mail("youtube@erikthiart.com", "Contact form submission", $message);
    if($sent) {
      $confirm_message = 'Thank you for your message, '.$first_name.' - we have received it sucessfully.';
    } else {
      // display a useful message. (dont lose the client)
      array_push($errors, "Your message was not sent - please contact us directly (error: 44)");
    }
  }
}
?>
<?php include 'header.php'; ?>
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Simple contact form</h1>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-sm">
      <?php if(!empty($errors)): ?>
        <div class="alert alert-danger" role="alert">
            <?php 
              foreach($errors as $error) {
                echo $error . "<br>";
              }
            ?>
        </div>
      <?php endif;?>
      <?php if(!empty($confirm_message)):?>
        <div class="alert alert-success" role="alert">
            <?=$confirm_message;?>
        </div>
      <?php endif;?>
      <form action="" method="post">
        <div class="form-group">
          <label for="">First Name</label>
          <input type="text" class="form-control" id="first_name" name="first_name">
        </div>
        <div class="form-group">
          <label for="">Last Name</label>
          <input type="text" class="form-control" id="last_name" name="last_name">
        </div>
        <div class="form-group">
          <label for="">Email address</label>
          <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea class="form-control" id="message" name="message" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>