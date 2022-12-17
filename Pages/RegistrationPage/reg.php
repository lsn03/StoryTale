<?php
session_start();

include '../../db.php';

//echo var_dump($_POST);


$errorArray = array();

if (!isset($_POST["nickname"])) {
  $errorArray[] =  array("firstname" => false);
}
if (!isset($_POST["password"])) {
  $errorArray[] = (array("password" => false));
}
if (!isset($_POST["password_confirm"])) {
  $errorArray[] = (array("password_confirm" => false));
}
if (!isset($_POST["email"])) {
  $errorArray[] = (array("email" => false));
}
if (!isset($_POST["birthday"])) {
  $errorArray[] = (array("birthday" => false));
}

if (count($errorArray) > 0) {
  $connection->close();
  
  header("Location: registration_page.php");
  die;
}

if (count($errorArray) == 0) {
  $userNickname = $_POST["nickname"];
  $userEmail = $_POST["email"];
  $userPassword = password_hash($_POST["password"], PASSWORD_BCRYPT);
  $userBirthday = $_POST["birthday"];
  $find = mysqli_query($connection, "select * from user_data where email = '$userEmail'");

  if (!ValidateUserName($userNickname)) {
    $errorArray[] = (array("validUserName" => false));
  }
  if (!ValidateUserEmail($userEmail)) {
    $errorArray[] = (array("validUserEmail" => false));
  }
  if (!ValidateUserBirthday($userBirthday)) {
    $errorArray[] = (array("validUserBirthday" => false));
  }
  if (count($errorArray) > 0) {
    echo json_encode($errorArray);
    $connection->close();
    header("Location: registration_page.php");
    die;
  }


  $find = mysqli_query($connection, "select * from user_data where email = '$userEmail'");
  $user = $find->fetch_assoc();
  if (!($_POST["password"] == $_POST["password_confirm"])) {
    $errorArray[] = array("PasswordIsEqual" => false);
  } else if (isset($user['email'])) {
    $errorArray[] = array("EmailIsFree" => false);
  } else {

    if (count($errorArray) > 0) {
     
      $connection->close();
      header("Location: registration_page.php");
      die;
    }

    $userPassword = password_hash($_POST["password"], PASSWORD_BCRYPT);
    //$userBirthday = ReverseBirthday($userBirthday);
    $query = "insert into user_data set nickname = '$userNickname', email = '$userEmail', password = '$userPassword',birthday = '$userBirthday'";

    $res = $connection->query($query);

    if ($res) {
     
      $_SESSION["user"] = $userEmail;
      header('Location: ../../index.php');
    }
  }
}
if (count($errorArray) > 0) {
  echo json_encode($errorArray);
  $connection->close();
  die;
}
function ValidateUserBirthday($birthday)
{
  // birrthday = 2003-04-21


  $res = explode("-", $birthday);
  return checkdate((int)$res[1], (int)$res[2], (int)$res[0]);
}
function ReverseBirthday($birthday)
{
  // 21.04.2003
  $res = explode(".", $birthday);
  $temp = "$res[2]-$res[1]-$res[0]";
  return $temp;
}
function ValidateUserName($fn)
{

  $res1 = preg_match('/^([а-яА-ЯЁёa-zA-Z_]+)$/u', $fn);
  
 
  return $res1;
}
function ValidateUserEmail($email)
{
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}
