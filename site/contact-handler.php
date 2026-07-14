<?php
/**
 * contact-handler.php
 * Receives the "Request a Quote" form from index.php, validates it,
 * emails it via Gmail SMTP (using PHPMailer), then redirects back.
 *
 * ---------------------------------------------------------------------
 * SETUP (one-time):
 *  1. Download PHPMailer from:
 *     https://github.com/PHPMailer/PHPMailer/releases
 *     and place its /src folder next to this file, so you have:
 *       PHPMailer/src/PHPMailer.php
 *       PHPMailer/src/SMTP.php
 *       PHPMailer/src/Exception.php
 *
 *  2. Create a Gmail App Password (NOT your normal Gmail password):
 *     Google Account -> Security -> 2-Step Verification (turn on) ->
 *     App Passwords -> generate one for "Mail".
 *
 *  3. Fill in SMTP_USERNAME and SMTP_APP_PASSWORD below.
 * ---------------------------------------------------------------------
 */

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ---- Configuration ------------------------------------------------------
$to      = 'demelpressurewash@gmail.com';   // where quote requests land
$siteUrl = 'index.php';                       // redirect target after submit

// The Gmail account PHPMailer logs into to SEND the email.
// This can be the SAME address as $to, or a separate sending account.
const SMTP_USERNAME     = 'your-sending-address@gmail.com';
const SMTP_APP_PASSWORD = 'xxxx xxxx xxxx xxxx'; // 16-char App Password, not your real password

// ---- Only accept POST requests ------------------------------------------
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . $siteUrl);
    exit;
}

// ---- Collect + sanitize input --------------------------------------------
function clean($value) {
    $value = trim($value ?? '');
    $value = str_replace(["\r", "\n"], ' ', $value); // block header injection
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$name    = clean($_POST['name']    ?? '');
$phone   = clean($_POST['phone']   ?? '');
$email   = clean($_POST['email']   ?? '');
$service = clean($_POST['service'] ?? '');
$message = clean($_POST['message'] ?? '');

// Honeypot spam trap (hidden "website" field in the form — real visitors
// leave it blank, bots usually fill every field)
if (!empty($_POST['website'] ?? '')) {
    header('Location: ' . $siteUrl . '?sent=1#contact');
    exit;
}

// ---- Validate required fields --------------------------------------------
if (
    $name === '' ||
    $phone === '' ||
    $email === '' ||
    $service === '' ||
    !filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL)
) {
    header('Location: ' . $siteUrl . '?sent=0#contact');
    exit;
}

// ---- Build and send the email via PHPMailer ------------------------------
$subject = "New Quote Request — $service";
$body = "New request from the website contact form:\n\n"
      . "Name:    $name\n"
      . "Phone:   $phone\n"
      . "Email:   $email\n"
      . "Service: $service\n\n"
      . "Details:\n$message\n";

$sent = false;
try {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USERNAME;
    $mail->Password   = SMTP_APP_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom(SMTP_USERNAME, 'De Pressure Wash Website');
    $mail->addAddress($to);
    $mail->addReplyTo($email, $name); // hitting "reply" goes to the customer

    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->isHTML(false);

    $mail->send();
    $sent = true;
} catch (Exception $e) {
    // Log the real error for debugging locally; don't show it to visitors
    error_log('PHPMailer error: ' . $mail->ErrorInfo);
    $sent = false;
}

// ---- Redirect back to the site with a result flag -------------------------
header('Location: ' . $siteUrl . '?sent=' . ($sent ? '1' : '0') . '#contact');
exit;