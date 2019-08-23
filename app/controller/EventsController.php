<?php
session_start();
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require '../../vendor/autoload.php';
require '../settings/config.php'; 
 require_once('../services/EventRegistryService.php');  
// require_once('../services/LoginService.php');  
$app = new \Slim\App;

// $app->get('/', function (Request $request, Response $response) {
// $response->getBody()->write("Hello world");
// return $response;
// });

$app->post( '/Add',function (Request $request) {

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

$app->post( '/Update',function (Request $request) {

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

$app->post( '/DeActivate',function (Request $request) {

  unset($_SESSION["loggedUser"]);
  header("Location: /events/index.php");
  exit();
  
});

$app->post( '/RegisterEvent',function (Request $request) {

  $registerService = new EventRegistryService($request);
  $complete = $registerService->registerForEvent();
  
  if($complete){
    header("Location: /events/events.php");
    exit();
  } 
  else{
    header("Location: /events/login.php");
    exit();
  }
 
});

$app->post( '/ApproveEvent',function (Request $request) {

  $registerService = new EventRegistryService($request);
  $complete = $registerService->approveEventRegistry( $request->getParam("RegisterId"));
  
  if($complete){
    header("Location: /events/admin.php");
    exit();
  } 
  else{
    header("Location: /events/login.php");
    exit();
  }
 
});

$app->run();
?>;