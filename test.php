<?php
// include your composer dependencies
require_once 'vendor/autoload.php';
#https://developers.google.com/api-client-library/php/auth/web-app

$client = new Google_Client();
$client->setAuthConfig('client_secret.json');
$client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);

$client->setAccessToken('AIzaSyDcRzVFGO8AZ8VhC3H0B7DbLJDSklrARxQ');

$drive = new Google_Service_Drive($client);

$files_list = $drive->files->listFiles(array())->getFiles($optParams);

echo "<pre>";
print_r($files_list);
exit;
?>