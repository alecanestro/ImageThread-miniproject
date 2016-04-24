<?php

include_once 'includes/imagethread_class.php';
$oImageThread = new imagethread();

$data = array();
if (isset($_GET['files'])) {
    $error = false;
    $files = array();
    $uploaddir = 'data/posts/';
    foreach ($_FILES as $file) {
        $sImage = $oImageThread->nameSaveImage($file['name']);

        if (move_uploaded_file($file['tmp_name'], $uploaddir . basename($sImage))) {
            $files[] = $uploaddir . $sImage;
        } else {
            $error = true;
        }
    }
    $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
} else {
    $sFilename = preg_replace('/^data\/posts\/(.*)$/', '$1', $_POST['filename']);
    $oImageThread->saveDataPost($sFilename, $_POST['imageTitle']);

    $data = array('success' => 'Form was submitted', 'formData' => $_POST);
}
echo json_encode($data);
?>