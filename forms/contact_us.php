<?php
if (isset($_POST['email'])) {

  // EDIT THE 2 LINES BELOW AS REQUIRED
  $email_to = "thonmonyroth@gmail.com";
  $email_subject = $_POST['subject'];

  function problem($error)
  {
    echo "We are very sorry, but there were error(s) found with the form you submitted. ";
    echo "These errors appear below.<br><br>";
    echo $error . "<br><br>";
    echo "Please go back and fix these errors.<br><br>";
    die();
  }

  // validation expected data exists
  if (
    !isset($_POST['name']) ||
    !isset($_POST['email']) ||
    !isset($_POST['subject']) ||
    !isset($_POST['message'])
  ) {
    problem('We are sorry, but there appears to be a problem with the form you submitted.');
  }

  $name = $_POST['name']; // required
  $email = $_POST['email']; // required
  $subject = $_POST['subject']; // required
  $message = $_POST['message']; // required

  $error_message = "";
  $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if (!preg_match($email_exp, $email)) {
    $error_message .= 'The Email address you entered does not appear to be valid.<br>';
  }

  $string_exp = "/^[A-Za-z .'-]+$/";

  if (!preg_match($string_exp, $name)) {
    $error_message .= 'The Name you entered does not appear to be valid.<br>';
  }

  if (strlen($message) < 2) {
    $error_message .= 'The Message you entered do not appear to be valid.<br>';
  }

  if (strlen($error_message) > 0) {
    problem($error_message);
  }

  $email_message = "Form details below.\n\n";

  function clean_string($string)
  {
    $bad = array("content-type", "bcc:", "to:", "cc:", "href");
    return str_replace($bad, "", $string);
  }

  $email_message .= "Name: " . clean_string($name) . "\n";
  $email_message .= "Email: " . clean_string($email) . "\n";
  $email_message .= "Message: " . clean_string($message) . "\n";

  // create email headers
  $headers = 'From: ' . $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
  @mail($email_to, $email_subject, $email_message, $headers);
?>

<!-- include your success message below -->

Thank you for contacting us. We will be in touch with you very soon.

<?php
}
?>