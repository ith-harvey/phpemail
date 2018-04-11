<?php

  function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }

/*
  Simple Contact Form Layout
*/
  function submitForm () {
    console_log('running!!!');
    $error = "";
    $success = "";

     if ($_POST) {

     /*
        All forms mandatory
        append to error message if not filled out

        If you do not wish for a field to be mandatory you must take
        The field name out of the ones listed below. either by
        commenting out like I did with CITY. or taking it out completely
     */

      if(!$_POST["email"]) {
          $error .= "An email address is required <br>";
      }
      if(!$_POST["message"]) {
        $error .= "The content field is required <br>";
      }
      if(!$_POST["name"]) {
        $error .= "The name field is required <br>";
      }
      if(!$_POST["company"]) {
        $error .= "The company field is required <br>";
      }
     // if(!$_POST["city"]) {
     //   $error .= "The city field is required <br>";
     // }
      if(!$_POST["state"]) {
        $error .= "The state field is required <br>";
      }
      if(!$_POST["phone"]) {
        $error .= "The phone field is required <br>";
      }

    // validate there is a email and that it is valid.
    // If the email is not valid, return false and append to error message

      if ($_POST['email'] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
          $error .= "The email address is not valid <br>";
      }


  // if there are ANY errors, display them in the error message.

   if ($error != "") {
     $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><p><strong>There were error(s) in your form</strong></p>'.$error.'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';


     // with no erros, send the email to company email with the fields filled out.

   } else {
     $emailTo = "patrick@tmimscorp.com";
     $subject = "SUBJECT HERE";
     $content = "About Company: ".$_POST['message']."\n";
     $content .= "Full Name: ".$_POST['name']."\n";
     $headers = "From: ".$_POST['email']."\n";
   }

    // If everything has passed so far
    // and there is content in all fields,
    // we accept the email and give success message.
     // Otherwise, send error message

     if (mail($emailTo, $subject, $content, $headers)) {
       $response = '<div class="alert alert-success alert-dismissible fade show" role="alert"><p> Your message was sent, we\'ll get back to you as soon as we can!</p><button type="button" class="close alert-close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" class="alert-close">×</span></button></div>';
   } else {
       $response = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><p> Your message couldn\'t be sent - please try again later.</p><button type="button" class="close alert-close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" class="alert-close">×</span></button></div>';
   }
  }
  // echo $response;

  echo '<script type="text/javascript">',
        '$(document).ready(function(){',
        '$(\'#submit\').trigger(\'click\');',
        'console.log("hello");',
        '$(body).append(\'<h1>balls</h1>\');',
        '});',
        '</script>'
;
}
?>
