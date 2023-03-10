<?php 

use PHPMailer\PHPMailer\PHPMailer;

class Login extends Controller{

  public function index() {
    $this->view('auth/login');
  }

  public function createUserSession($user) {
    $notificationModel =  $this->model('user/Notification_model', 'Notification_model');
    $_SESSION['user'] = $user;
    // $_SESSION['notification'] = $notificationModel->getUserNotification($user['userNik'], $user['organizationId']);
    $_SESSION['notification'] = [];
    $_SESSION['notificationCount'] = sizeof($_SESSION['notification']);
  }

  public function auth() {
    $userModel = $this->model('user/User_model', 'User_model');
    $user = $userModel->userAuth($_POST['nik'], $_POST['password']);
    // var_dump($user);
    
    if ($user == null) {
      $_SESSION['falseLoginInfo'] = true;
      header("Location: " . BASEURL . 'login');
      exit;
    } else {
      $_SESSION['falseLoginInfo'] = false;
      $userModel->updateLastVisit($user);
      $this->createUserSession($user);
      isset($_SESSION['page']) ? header("Location: " . BASEURL . $_SESSION['page']) : header("Location: " . BASEURL);
      // print_r($user);
      exit;
    }
  }

  public function logout() {
    session_destroy();
    header("Location: " . BASEURL);
    exit;
  }

  public function resetPassword() {
    // Create a new PHPMailer instance
    $mail = new PHPMailer();

    // var_dump($_POST['resetPasswordDetail']);

    // check user credentials
    $userModel = $this->model('user/User_model', 'User_model');
    $user = $userModel->getUserBy('email', $_POST['resetPasswordDetail']) ?? null;
    // var_dump(!$user);
    !$user ? $user = $userModel->getUserBy('nik', $_POST['resetPasswordDetail']) ?? null : null;

    // var_dump($user['email']);

    if (isset($user)) {
      if (isset($user['email']) && $user['email'] != '') {
        $token = bin2hex(random_bytes(32));
        $expiration_time = time() + 300; // 5 minutes from now
        $reset_link = BASEURL . "login/resetPasswordLink?token=" . $token;
        $expiration_time = date('Y-m-d H:i:s', $expiration_time);
        
        // var_dump($expiration_time);

        $userModel->setResetPasswordToken($token, $user['nik'] , $user['email'], $expiration_time);

        // Set the SMTP settings
        $mail->isSMTP();
        $mail->Host        = "10.100.21.3";
        $mail->Port        = 25;
        $mail->SMTPSecure  = false;
        $mail->SMTPAutoTLS = false;
        $mail->SMTPAuth    = false;
        $mail->setFrom("admin.planet@enseval.com", "Planet Enseval -- no reply");

        $mail->addAddress($user['email']);
        $mail->Subject = 'Password Reset Link';
        $mail->Body = " <html>
                          <head>
                            <title>Reset Password Verification</title>
                          </head>
                          <body>
                            <p>Dear " . $user['nama'] . ",</p>
                            <br>
                            <p>You have requested to reset your password on Enseval Planet. Please click the link below to reset your password:</p>
                            <p> The link will expires in 5 minutes</p>
                            <br>
                            <p>" . $reset_link . "</p>
                            <br>
                            <p>If you did not initiate this request, please ignore this email and take necessary steps to secure your account.</p>
                            <br>
                            <p>Best regards,</p>
                            <p>Enseval Planet</p>
                          </body>
                        </html>
                        ";
        $mail->isHTML(true);
        // Send the email
        if ($mail->send()) {
            echo 'Email sent successfully';
            header("Location:" . BASEURL . 'login');
        } else {
            echo 'Error sending email: ' . $mail->ErrorInfo;
        }
      } else {
        echo 'email not found';
      }
      
    } else {
      echo "user not found";
    }
    
  }

  public function resetPasswordLink() {
    $token = $_GET['token'];

    $userModel = $this->model('user/User_model', 'User_model');
    $token = $userModel->getTokenDetail($token);

    $user = $userModel->getUserBy('email', $token['email']) ?? null;
    isset($user) ?? $user = $userModel->getUserBy('nik', $token['nik']) ?? null;

    if (isset($token) && strtotime('1970-01-01 ' . $token['expirationTime']) < time()) {
      $userModel->updateUserPassword($user['nik'], $user['nik']);
      echo "password change successfully to NIK = " . $user['nik'];
      $userModel->deleteResetPasswordToken($token);
    } else {
      echo "Sorry Link Expired";
    }
  }

}