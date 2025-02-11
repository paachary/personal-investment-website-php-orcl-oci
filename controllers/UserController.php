<?php
class UserController
{
  protected $db;
  public function __construct()
  {
    $config = require basePath('config/_db.php');
    $this->db = new Database($config);
  }

  public function registerView()
  {
    loadView('users/register');
  }

  public function loginView()
  {
    loadView('users/login');
  }

  public function register()
  {

    $userName = $_POST["userName"];
    $password = $_POST["password"];
    $confirmPassword =  $_POST["confirmPassword"];

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $dateofbirth =  $_POST["dateofbirth"];

    $gender = $_POST["gender"];
    $phoneNumber = $_POST["phoneNumber"];
    $emailId =  $_POST["emailId"];

    $contactaddress = $_POST["contactaddress"];
    $city = $_POST["city"];
    $pincode =  $_POST["pincode"];

    $errors = [];

    //validations

    if (!Validation::email($emailId)) {
      $errors['emailId'] = "Please enter a valid email address!";
    }

    if (!Validation::string($firstName, 1)) {
      $errors['firstName'] = 'First Name is mandatory!';
    }

    if (!Validation::string($lastName, 1)) {
      $errors['lastName'] = 'Last Name is mandatory!';
    }

    if (!Validation::string($phoneNumber, 10)) {
      $errors['phoneNumber'] = 'Phone number must be atleast 10 characters!';
    }
    if (!Validation::string($contactaddress, 1)) {
      $errors['contactaddress'] = 'Contact Address is mandatory!';
    }

    if (!Validation::string($city, 1)) {
      $errors['city'] = 'City is mandatory!';
    }

    if (!Validation::string($pincode, 1)) {
      $errors['pincode'] = 'Pin Code is mandatory!';
    }

    if (!Validation::string($dateofbirth, 1)) {
      $errors['dateofbirth'] = 'Date of Birth is mandatory!';
    }

    if (!Validation::string($userName, 1)) {
      $errors['userName'] = 'Username is mandatory!';
    }

    if (!Validation::string($password, 8, 20)) {
      $errors['password'] = 'Password must be at least 6 characters!';
    }

    if (!Validation::match($password, $confirmPassword)) {
      $errors['confirmPassword'] = 'Passwords do not match!!';
    }

    if (!empty($errors)) {
      loadView('users/register', [
        'errors' => $errors,
        'user' => [
          'userName' => $userName,
          'firstName' => $firstName,
          'lastName' => $lastName,
          'dateofbirth' => $dateofbirth,
          'gender' => $gender,
          'phoneNumber' => $phoneNumber,
          'emailId' => $emailId,
          'contactaddress' => $contactaddress,
          'city' => $city,
          'pincode' => $pincode

        ]
      ]);
      exit;
    }

    $user = [
      'userName' => strtoupper($userName),
      'firstName' => strtoupper(
        $firstName
      ),
      'lastName' => strtoupper(
        $lastName
      ),
      'dateofbirth' => $dateofbirth,
      'gender' => strtoupper($gender),
      'phoneNumber' => $phoneNumber,
      'emailId' => strtoupper(
        $emailId
      ),
      'contactaddress' => strtoupper(
        $contactaddress
      ),
      'city' => strtoupper(
        $city
      ),
      'pincode' => $pincode,
      'password' => password_hash($password, PASSWORD_DEFAULT)
    ];

    $retVal = $this->db->registerNewUser($user);

    if ($retVal === 1) {
      $errors['userName'] = 'The user with that name already exists !';
      loadView('users/register', [
        'errors' => $errors
      ]);
      exit;
    };

    // // Set user session
    Session::set('user', [
      'userId' => $this->db->userId,
      'userName' => strtoupper($userName),
      'firstName' => strtoupper(
        $firstName
      ),
      'lastName' => strtoupper(
        $lastName
      ),
      'dateofbirth' => $dateofbirth,
      'gender' => $gender,
      'phoneNumber' => $phoneNumber,
      'emailId' => strtoupper(
        $emailId
      ),
      'contactaddress' => strtoupper(
        $contactaddress
      ),
      'city' => strtoupper(
        $city
      ),
      'pincode' => $pincode,
    ]);

    Session::setFlashMessage('success_message', 'User ' . strtoupper($userName)  . ' registered successfully!');


    $this->db->setApplicationContext($this->db->userId, strtoupper($userName));

    redirect('/');
  }


  public function login()
  {
    $userName = strtoupper($_POST['userName']);
    $password = $_POST['password'];

    $errors = [];

    // Validation

    if (!Validation::string($password, 8, 20)) {
      $errors['password'] = 'Password must be at least 8 characters';
    }

    // Check for errors
    if (!empty($errors)) {
      loadView('users/login', [
        'errors' => $errors
      ]);
      exit;
    }

    $userDetails = $this->db->getUserDetails($userName);

    if (empty($userDetails)) {
      $errors['userName'] = 'Incorrect credentials';
      loadView('users/login', [
        'errors' => $errors
      ]);
      exit;
    }

    $userDetails = $userDetails[0];

    // Check if password is correct
    if (!password_verify($password, $userDetails["PASSWORD"])) {
      $errors['userName'] = 'Incorrect credentials';
      loadView('users/login', [
        'errors' => $errors
      ]);
      exit;
    }

    // Set user session
    Session::set('user', [
      'userId' => $userDetails["USER_ID"],
      'userName' => $userDetails["USER_NAME"],
      'firstName' => $userDetails["FIRST_NAME"],
      'lastName' => $userDetails["LAST_NAME"],
      'dateofbirth' => $userDetails["DOB"],
      'gender' => $userDetails["GENDER"],
      'phoneNumber' => $userDetails["PHONE_NBR"],
      'emailId' => $userDetails["EMAIL"],
      'contactaddress' => $userDetails["ADDRESS"],
      'city' => $userDetails["CITY"],
      'pincode' => $userDetails["PIN_CODE"],
    ]);

    $this->db->setApplicationContext($userDetails["USER_ID"], $userDetails["USER_NAME"]);

    Session::setFlashMessage('success_message', $userName . ' logged in successfully!');

    redirect('/');
  }

  public function index()
  {
    loadView('users/display', [
      'users',
      Session::get('user')
    ]);
  }

  public function edit()
  {
    loadView('users/edit', [
      'users',
      Session::get('user')
    ]);
  }

  public function store()
  {
    $allowedFields = ['phoneNumber', 'emailId', 'contactaddress', 'pincode', 'city', 'userId'];

    $newUserProfileFields = array_intersect_key($_POST, array_flip($allowedFields));

    $newUserProfileFields = array_map('sanitize', $newUserProfileFields);

    $user = Session::get('user');

    $userId = $user['userId'];

    $status = $this->db->updateUserDetails(
      userId: $userId,
      phoneNumber: $newUserProfileFields['phoneNumber'],
      emailId: strtoupper($newUserProfileFields['emailId']),
      pincode: $newUserProfileFields['pincode'],
      contactaddress: strtoupper(
        $newUserProfileFields['contactaddress']
      ),
      city: strtoupper(
        $newUserProfileFields['city']
      )
    );

    if ($status === 0) {
      Session::setFlashMessage('success_message', 'Record Updated Successfully!');

      Session::set('user', [
        'userId' => $user["userId"],
        'userName' => $user["userName"],
        'firstName' => $user["firstName"],
        'lastName' => $user["lastName"],
        'dateofbirth' => $user["dateofbirth"],
        'gender' => $user["gender"],
        'phoneNumber' => $newUserProfileFields['phoneNumber'],
        'emailId' => strtoupper($newUserProfileFields['emailId']),
        'contactaddress' => strtoupper(
          $newUserProfileFields['contactaddress']
        ),
        'city' => strtoupper(
          $newUserProfileFields['city']
        ),
        'pincode' => $newUserProfileFields['pincode'],
      ]);
    } else {
      Session::setFlashMessage('error_message', 'Record Not Updated!');
    }
    redirect("/users");
  }


  public function passwordReset()
  {
    loadView('users/passwordReset');
  }


  public function updatePassword()
  {
    $user = Session::get('user');

    $userDetails = $this->db->getUserDetails($user['userName'])[0];

    $oldPassword = $_POST['password'];

    // Check if password is correct
    if (!password_verify($oldPassword, $userDetails["PASSWORD"])) {
      $errors['oldpassword'] = 'Incorrect credentials';
      loadView('users/passwordReset', [
        'errors' => $errors
      ]);
      exit;
    }

    $newPassword = $_POST['newpassword'];

    $confirmNewPassword = $_POST['confirmnewpassword'];


    if (!Validation::string($newPassword, 8, 20)) {
      $errors['newpassword'] = 'Password must be at least 6 characters!';
    }

    if (!Validation::match($newPassword, $confirmNewPassword)) {
      $errors['confirmNewPassword'] = 'Passwords do not match!!';
    }

    // Check for errors
    if (!empty($errors)) {
      loadView('users/passwordReset', [
        'errors' => $errors
      ]);
      exit;
    }

    $latestPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    if (password_verify($oldPassword, $latestPassword)) {
      $errors['oldpassword'] = 'Old and New passwords should not be the same!!';
      loadView('users/passwordReset', [
        'errors' => $errors
      ]);
      exit;
    }


    $status = $this->db->resetPassword($user['userId'], $userDetails["PASSWORD"], $latestPassword);

    if ($status === 0)
      Session::setFlashMessage('success_message', 'Password reset successful!');
    else
      Session::setFlashMessage('error_message', 'Password reset unsuccessful!');

    return redirect('/');
  }

  public function forgotPassword()
  {
    loadView('/users/forgotpassword');
  }

  public function sendPassword()
  {
    $userName = $_POST['userName'];

    $email = $_POST['email'];

    $userDetails = $this->db->getUserDetails($userName);

    if (empty($userDetails)) {
      $errors['userName'] = 'Invalid Username or email! Try again!!';
      loadView('users/forgotPassword', [
        'errors' => $errors
      ]);
      exit;
    }

    $userDetails = $userDetails[0];

    if (!Validation::match(strtolower($email), strtolower($userDetails['EMAIL']))) {
      $errors['email'] = 'Invalid Username or email! Try again!!';
      loadView('users/forgotPassword', [
        'errors' => $errors
      ]);
      exit;
    }

    $newPassword = "t%3e#0rt@r";

    $latestPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $status = $this->db->resetPassword($userDetails['USER_ID'], $userDetails["PASSWORD"], $latestPassword);
    if ($status === 0) {
      Session::setFlashMessage('success_message', 'Password reset successful!');
      $to = $userDetails['EMAIL'];
      $subject = "Password Retrieval";
      $txt = "Hi: <br> Please find your temporary password below. <br><p>" . $newPassword . " <br> <br>. Be sure to reset the password immediately!";

      $headers = "From: <<????>>";
      mail($to, $subject, $txt, $headers);
      return redirect("/auth/login");
    } else
      Session::setFlashMessage('error_message', 'Password reset unsuccessful!');
  }


  public function logout()
  {
    $this->db->clearApplicationContext($this->db->userId);

    $this->db->userId = 0;
    Session::setFlashMessage('success_message', ' You have been logged out successfully!');
    Session::clearAll();
    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);
    redirect('/');
  }
}
