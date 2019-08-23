<?php
session_start();
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require '../../vendor/autoload.php';
require '../settings/config.php'; 
require '../models/User.php'; 
require_once('../services/RegisterService.php');  
require_once('../services/LoginService.php');  
$app = new \Slim\App;

$app->get('/', function (Request $request, Response $response) {
$response->getBody()->write("Hello world");
return $response;
});

$app->post( '/Register',function (Request $request) {

    if (isset( $_POST['submit'] )) 
    {
      $registerService = new RegisterService($request);
      $complete = $registerService->RegisterUser();
      
      if($complete){
        header("Location: /events/login.php");
        exit();
      } 
      else{
        header("Location: /events/register.php");
        exit();
      }
     
    }
   
});

$app->post( '/Login',function (Request $request) {

  if (isset( $_POST['submit'] )) 
  {
    $loginService = new LoginService($request);
    $complete = $loginService->loginUser();
    
    if($complete){
      header("Location: /events/index.php");
      exit();
    } 
    else{
      header("Location: /events/login.php");
      exit();
    }
   
  }
 
});

$app->post( '/Logout',function (Request $request) {

  unset($_SESSION["loggedUser"]);
  header("Location: /events/index.php");
  exit();
  
});

$app->post( '/ActiveUser',function (Request $request) {

      $complete = User::createInstance()->updateUserActive($request->getParam("UserId"));
    
    if($complete){
      header("Location: /events/admin-usermgt.php");
      exit();
    } 
    else{
      header("Location: /events/login.php");
      exit();
    }
 
});

$app->post( '/DeActiveUser',function (Request $request) {

  $complete = User::createInstance()->updateUserAsDeActive($request->getParam("UserId"));

    if($complete){
      header("Location: /events/admin-usermgt.php");
      exit();
    } 
    else{
      header("Location: /events/login.php");
      exit();
    }

});

$app->post( '/AdminUser',function (Request $request) {

  $complete = User::createInstance()->updateUserAsAdmin($request->getParam("UserId"));

  if($complete){
    header("Location: /events/admin-usermgt.php");
    exit();
  } 
  else{
    header("Location: /events/login.php");
    exit();
  }

});

$app->post( '/NoAdminUser',function (Request $request) {

  $complete = User::createInstance()->updateUserNoAdmin($request->getParam("UserId"));

    if($complete){
      header("Location: /events/admin-usermgt.php");
      exit();
    } 
    else{
      header("Location: /events/login.php");
      exit();
    }

});
$app->run();
?>;