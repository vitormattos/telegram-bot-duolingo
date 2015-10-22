<?php
use Telegram\Bot\Api;
require 'vendor/autoload.php';
require 'config.php';

$url = $_GET['url'];
if(filter_var('https://'.$url, FILTER_VALIDATE_URL) == false) {
    echo 'Invalid url for get certificate';
    die();
}
$g = stream_context_create (array("ssl" => array(
    "capture_peer_cert" => true,
    "verify_peer" => false,
    "verify_peer_name" => false
)));
$r = stream_socket_client("ssl://{$url}", $errno, $errstr, 30,
    STREAM_CLIENT_CONNECT, $g);
if(!$r) {
    echo 'Domain dont exists';
    die();
}
$cont = stream_context_get_params($r);
var_dump($certificate);
openssl_x509_export($cont["options"]["ssl"]["peer_certificate"], $certificate);

$telegram = new Api($config['token']);
$response = $telegram->setWebhook(
    'https://'.$url,
    $certificate
);
var_dump([
    'url' => 'https://'.$url,
    'response' => $response
]);