<?php

include_once 'includes/imagethread_class.php';
$oImageThread = new imagethread();
$aPosts = $oImageThread->getPosts();

//var_dump($aPosts);exit;
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=imagethread.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Title', 'Filename'));

// fetch the data
$rows[] = ['title' => 'title', 'file' => 'testfile'];

// loop over the rows, outputting them
foreach ($aPosts as $value) {
    fputcsv($output, $value);
}