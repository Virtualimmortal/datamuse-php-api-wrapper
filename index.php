<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 0);
error_reporting(E_ALL);
print '<pre>';

include (__DIR__.'/vendor/autoload.php');
use YeTii\RhymeGenerator\RhymeOpt;
use YeTii\RhymeGenerator\ApiClient;

$client = new ApiClient([
	'cache_enable'=>false,
	'cache_lifetime'=>86200,
	'cache_dir'=>__DIR__.'/newcache'
]);
// $client->spelledLike('elepant')->getWords();//setOpt(RhymeOpt::SPELLED_LIKE, 'elepant')->getWords();
$result = $client->setOpt(RhymeOpt::PERFECT_RHYMES, 'bake')->ofTopic('food')->getWords()->result;
print_r($client);

die();