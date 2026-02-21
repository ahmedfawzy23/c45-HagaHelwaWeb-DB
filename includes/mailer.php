<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
function sendOtp($email, $otp)
{

    try {
        //Server settings
        // Looking to send emails in production? Check out our Email API/SMTP product!
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.gmail.com';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 587;
        $phpmailer->Username = '01ahmedfawzy23@gmail.com';
        $phpmailer->Password = 'lwdeafviuhdfkmnd';                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $phpmailer->setFrom('hagaHelwa@gmail.com', 'Mailer');
        $phpmailer->addAddress($email);     //Add a recipient

        $body = "
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
  <title>Email Preview</title>
</head>
<body style='margin:0; padding:0; background-color:#0f0f13; font-family: Georgia, serif;'>

  <table role='presentation' width='100%' cellpadding='0' cellspacing='0'
    style='background-color:#0f0f13; padding: 48px 16px;'>
    <tr>
      <td align='center'>

        <table role='presentation' width='100%' style='max-width:580px;' cellpadding='0' cellspacing='0'>

          <!-- Top gold accent bar -->
          <tr>
            <td style='
              background: linear-gradient(90deg, #c8a96e 0%, #e8c98a 50%, #c8a96e 100%);
              height: 4px;
              border-radius: 4px 4px 0 0;
            '></td>
          </tr>

          <!-- Card -->
          <tr>
            <td style='
              background-color: #18181f;
              border: 1px solid #2a2a35;
              border-top: none;
              border-radius: 0 0 12px 12px;
              padding: 48px 48px 40px;
            '>

              <table role='presentation' width='100%' cellpadding='0' cellspacing='0'>

                <!-- Monogram -->
                <tr>
                  <td style='padding-bottom: 36px;'>
                    <div style='
                      display: inline-block;
                      width: 44px; height: 44px;
                      background: linear-gradient(135deg, #c8a96e, #e8c98a);
                      border-radius: 10px;
                      text-align: center;
                      line-height: 44px;
                      font-size: 20px;
                      font-weight: bold;
                      color: #0f0f13;
                      font-family: Georgia, serif;
                    '>M</div>
                  </td>
                </tr>

                <!-- Headline -->
                <tr>
                  <td style='padding-bottom: 12px;'>
                    <h1 style='
                      margin: 0;
                      font-family: Georgia, 'Times New Roman', serif;
                      font-size: 28px;
                      font-weight: normal;
                      color: #f0ebe0;
                      letter-spacing: -0.5px;
                      line-height: 1.25;
                    '> " . $otp . " </h1>
                  </td>
                </tr>

                <!-- Accent line -->
                <tr>
                  <td style='padding-bottom: 28px;'>
                    <div style='width:40px; height:1px; background: linear-gradient(90deg, #c8a96e, transparent);'></div>
                  </td>
                </tr>

                <!-- Body copy -->
                <tr>
                  <td style='padding-bottom: 32px;'>
                    <p style='
                      margin: 0;
                      font-family: Georgia, serif;
                      font-size: 16px;
                      line-height: 1.75;
                      color: #a09a8e;
                    '>
                      This is the HTML message body
                      <strong style='color: #e8c98a; font-weight: normal; font-style: italic;'>in bold!</strong>
                      — crafted with care and delivered straight to your inbox.
                    </p>
                  </td>
                </tr>

                <!-- CTA -->
                <tr>
                  <td style='padding-bottom: 40px;'>
                    <a href='#' style='
                      display: inline-block;
                      padding: 13px 32px;
                      background: linear-gradient(135deg, #c8a96e, #e8c98a);
                      color: #0f0f13;
                      text-decoration: none;
                      font-family: Georgia, serif;
                      font-size: 14px;
                      letter-spacing: 1.5px;
                      text-transform: uppercase;
                      border-radius: 6px;
                    '>Take Action</a>
                  </td>
                </tr>

                <!-- Footer -->
                <tr>
                  <td style='border-top: 1px solid #2a2a35; padding-top: 28px;'>
                    <p style='
                      margin: 0;
                      font-family: Georgia, serif;
                      font-size: 12px;
                      color: #4a4a58;
                      line-height: 1.6;
                    '>
                      You received this email because you opted in.<br/>
                      <a href='#' style='color: #c8a96e; text-decoration: none;'>Unsubscribe</a>
                      &nbsp;·&nbsp;
                      <a href='#' style='color: #c8a96e; text-decoration: none;'>Privacy Policy</a>
                    </p>
                  </td>
                </tr>

              </table>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

</body>
</html>
";
        //Content
        $phpmailer->isHTML(true);                                  //Set email format to HTML
        $phpmailer->Subject = 'Your OTP Code';
        $phpmailer->Body    = $body;
        $phpmailer->AltBody = 'Your OTP Code is: ' . $otp;

        $phpmailer->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
