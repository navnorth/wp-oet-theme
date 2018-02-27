<?php

include_once wp_normalize_path( get_stylesheet_directory() . '/classes/Medium.php' );

$client_id = get_option("mediumclientid");
$client_secret = get_option("mediumclientsecret");

$credentials = [
                'client-id' => $client_id,
                'client-secret' => $client_secret,
                'redirect_url' => 'http://oet-test.navigationnorth.com/wp-content/themes/wp-oet-theme/content-medium.php',
                'state' => 'oet_medium',
                'scope' => 'basicProfile,publishPost,listPublications'
                ];

$medium = new Medium($credentials);
var_dump($medium);

?>