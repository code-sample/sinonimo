<?php 

require 'vendor/autoload.php';

use Guzzle\Http\Client;

// echo $_SERVER['REQUEST_URI'];
$word = explode("/", $_SERVER['REQUEST_URI']);
$word = end($word);
// die();

// Create a client and provide a base URL
$client = new Client();

$url = 'http://www.sinonimos.com.br/' . $word . '/';


$response = $client->get($url)->send();

// echo $response->getStatusCode();      // >>> 200
// echo $response->getReasonPhrase();    // >>> OK
// echo $response->getProtocol();        // >>> HTTP
// echo $response->getProtocolVersion(); // >>> 1.1

$html = $response->getBody();

$classname = 'sinonimo';

$dom = new DOMDocument;
libxml_use_internal_errors(true);
$dom->loadHTML($html);
libxml_clear_errors();
// $dom->load($html);
$xpath = new DOMXPath($dom);
$results = $xpath->query("//*[@class='" . $classname . "']");

if ($results->length > 0) {

    echo '{';
    foreach ( $results as $result ) {
        // echo '<p>' . $result . '</p>';
        echo '<p>' . $result->nodeValue . '</p>';
        // print_r($result->nodeValue);
    }
    echo '}';
    // echo $review = $results->item(0)->nodeValue;
}


die();