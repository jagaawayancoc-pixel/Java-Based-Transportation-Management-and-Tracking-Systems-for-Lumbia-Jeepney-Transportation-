<?php
$host='localhost'; $db='transeat_db'; $user='root'; $pass=''; $charset='utf8mb4';
try { $pdo=new PDO("mysql:host=$host;dbname=$db;charset=$charset",$user,$pass,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES=>false]); }
catch(PDOException $e){ http_response_code(500); die('Database connection failed. Start Apache/MySQL and import db.sql.'); }
if(session_status()===PHP_SESSION_NONE) session_start();
function e($v){return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
function require_role($role){if(($_SESSION['role']??'')!==$role){header('Location:index.php');exit;}}
function go($url,$msg,$type='success'){$_SESSION['flash']=['message'=>$msg,'type'=>$type];header("Location:$url");exit;}
function flash(){ $f=$_SESSION['flash']??null; unset($_SESSION['flash']); return $f; }
?>