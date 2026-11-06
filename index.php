<?php
require 'config.php';
if(isset($_SESSION['role'])){ $r=$_SESSION['role']; header('Location: '.($r==='admin'?'admin.php':($r==='driver'?'driver.php':'passenger.php'))); exit; }
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $name=trim($_POST['name']??''); $type=$_POST['user_type']??''; $secret=$_POST['secret']??'';
 if($type==='Admin'){
  $st=$pdo->prepare('SELECT * FROM admins WHERE username=?'); $st->execute([$name]); $a=$st->fetch();
  if($a && password_verify($secret,$a['password_hash'])){$_SESSION['role']='admin';$_SESSION['username']=$a['username'];header('Location:admin.php');exit;}
  $error='Invalid administrator name or secret password.';
 }elseif($type==='Passenger'){
  $_SESSION['role']='passenger';$_SESSION['username']=$name!==''?$name:'Passenger';header('Location:passenger.php');exit;
 }elseif($type==='Driver'){
  $st=$pdo->prepare('SELECT * FROM drivers WHERE driver_name=? AND is_archived=0');$st->execute([$name]);$d=$st->fetch();
  // Driver secret is the Driver ID created by the Admin. This avoids self-sign-up.
  if($d && hash_equals($d['driver_id'],$secret)){$_SESSION['role']='driver';$_SESSION['driver_pk']=$d['id'];$_SESSION['driver_id']=$d['driver_id'];$_SESSION['driver_name']=$d['driver_name'];header('Location:driver.php');exit;}
  $error='Driver account not found. Ask the Admin to add/activate your driver record.';
 }else $error='Please select a user type.';
}
$f=flash(); if($f)$error=$f['message'];
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>TranSeat - Login</title><link rel="stylesheet" href="style.css"></head><body><div class="login-wrap"><div class="login-card"><img src="assets/logo.jpg" alt="TranSeat Logo"><h1>Login Page</h1><?php if($error):?><div class="message error"><?=e($error)?></div><?php endif;?><form method="post"><div class="login-row"><div class="field"><label>Name</label><input name="name" id="txtName" required></div><div class="field"><label>User</label><select name="user_type" id="UserType"><option>Driver</option><option>Passenger</option><option>Admin</option></select></div><div class="field full"><label>Secret Password</label><input type="password" name="secret" id="txtSecret"><div class="small">Admin: ADMINadmin123123 · Driver: use the Driver ID created by Admin · Passenger: no password required</div></div></div><div class="actions"><button class="btn" id="btnLogin" type="submit">Login</button></div></form></div></div></body></html>