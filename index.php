<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 0);
error_reporting(E_ALL);
print '<pre>';

include (__DIR__.'/vendor/autoload.php');
use YeTii\RhymeGenerator\RhymeOpt;
use YeTii\RhymeGenerator\ApiClient;

$client = new ApiClient();
// $client->spelledLike('elepant')->getWords();//setOpt(RhymeOpt::SPELLED_LIKE, 'elepant')->getWords();
$result = $client->setOpt(RhymeOpt::SPELLED_LIKE, 'elepant')->ofTopic('animals')->getWords()->result;
print_r($result);

die();