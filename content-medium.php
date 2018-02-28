<?php

include_once wp_normalize_path( get_stylesheet_directory() . '/vendor/autoload.php' );

use JonathanTorres\MediumSdk\Medium;

$client_id = get_option("mediumclientid");
$client_secret = get_option("mediumclientsecret");
$self_access_token = get_option("mediumaccesstoken");

$credentials = [
                'client-id' => $client_id,
                'client-secret' => $client_secret,
                'redirect-url' => 'http://oet-test.navigationnorth.com/wp-content/themes/wp-oet-theme/content-medium.php',
                'state' => 'oet_medium',
                'scopes' => 'basicProfile,publishPost,listPublications'
                ];

// Self Access Token Authentication
$medium = new Medium($self_access_token);

$user = $medium->getAuthenticatedUser();

$publications = $medium->publications($user->data->id)->data;
echo "<div class='hidden'>";
var_dump($publications);
echo "</div>";
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <?php
    if ($publications){
        foreach($publications as $publication){
            ?>
            <div class="col-md-4 col-sm-6 col-xs-12 medium">
                <h1><a href="<?php echo $publication->url; ?>"><?php echo $publication->name; ?></a></h1>
                <p><?php echo $publication->description; ?></p>
                <p><img src="<?php echo $publication->imageUrl; ?>" /></p>
            </div>
            <?php
        }
    }
    ?>
</div>