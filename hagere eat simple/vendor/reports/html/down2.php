<?php
//Image file at sever loaction to download
 
$file1 = './vendor/readme1.txt';
if (file_exists($file1)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file1).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file1));
    readfile($file1);
    exit;
}