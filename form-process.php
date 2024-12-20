<?php
if (isset($_POST['email'])) {

    // REPLACE THIS 2 LINES AS YOU DESIRE
    $email_to = "andrewtherryhendayu@gmail.com";
    $email_subject = "Pesan baru datang";

    function problem($error)
    {
        echo "Terdapat masalah pada form data: <br><br>";
        echo $error . "<br><br>";
        echo "Perbaiki itu untuk melanjutkan.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['nama']) ||
        !isset($_POST['email']) ||
        !isset($_POST['pesan'])
    ) {
        problem('Oh looks like there is some problem with your form data.');
    }

    $name = $_POST['nama']; // required
    $email = $_POST['email']; // required
    $message = $_POST['pesan']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'Email kurang valid.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'Perbaiki Namamu.<br>';
    }

    if (strlen($message) < 1) {
        $error_message .= 'Tidak bisa mengirim jika hanya ada 1 karakter<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Form details following:\n\n";

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

    <!-- Replace this as your success message -->

    Terima Kasih atas pendapat anda.

<?php
}
?>