<?php
session_start();
// ROOT_PATH'i doğru tanımla
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');

// config.php dosyasını doğru şekilde dahil et
include(ROOT_PATH . 'ecommerce_d/config.php');


function sendResponse($status, $message) {
    header('Content-Type: application/json');
    echo json_encode(array("status" => $status, "message" => $message));
    exit;  
}


if (!isset($_SESSION['user_id'])) {
    sendResponse("error", "Lütfen giris yapin.");
}


echo json_encode(array("status" => "success", "message" => "Hos geldiniz, Kullanici!"));
?>
