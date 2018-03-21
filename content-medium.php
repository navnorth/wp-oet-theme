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

$rss_urls = array(
            "https://medium.com/feed/@".$user->username
            );
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <?php
    if ($publications){
        $cnt = 1;
        foreach($publications as $publication){
            $rss_urls[] = "https://medium.com/feed/".$publication->name;
            if (($cnt%3)==1)
                echo "<div class='row'>";
            ?>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="medium" style="background:#000000 url(<?php echo $publication->imageUrl; ?>) no-repeat top left;">
                    <div class="medium-wrapper">
                        <h1><a href="<?php echo $publication->url; ?>"><?php echo $publication->name; ?></a></h1>
                        <p><?php echo $publication->description; ?></p>
                    </div>
                </div>
            </div>
            <?php
            if (($cnt%3)==0)
                echo "</div>";
            $cnt++;
        }
    }
    ?>
</div>
<?php
    var_dump($rss_urls);
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class='row'>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="medium" style="background:#000000 url(<?php echo $publication->imageUrl; ?>) no-repeat top left;">
                <div class="medium-wrapper">
                    <h1><a href="<?php echo $publication->url; ?>"><?php echo $publication->name; ?></a></h1>
                    <p><?php echo $publication->description; ?></p>
                </div>
            </div>
        </div>
   </div>
</div>