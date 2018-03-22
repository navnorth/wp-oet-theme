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
$medium_base_url = "https://medium.com/";
$rss_urls = array(
            "https://medium.com/feed/@".$user->data->username
            );

if ($publications){
    foreach($publications as $publication){
        $pub_name = sanitize_title($publication->name);
        if (strpos($publication->url,$medium_base_url)>=0)
            $pub_name = trim(substr($publication->url,strlen($medium_base_url),strlen($publication->url)));
        $rss_urls[] = "https://medium.com/feed/".$pub_name;
    }
}

$feeds = array();
foreach ($rss_urls as $rss_url){
    $feed = convert_rss_to_json($rss_url);
    if ($feed){
        if ($feed['status']=="ok"){
            foreach($feed['items'] as $item){
               $feeds[] = $item;
            }
        }
    }
}
?>
<div class="col-md-12 col-sm-12 col-xs-12">
        <?php
        if ($feeds) {
            $fcnt = 1;
            foreach($feeds as $feed) {
                $description = $feed['description'];
                echo "<div class='hidden'>";
                var_dump($description);
                echo "</div>";
                //if (($fcnt%3)==1)
                    //echo "<div class='row'>";
            ?>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="medium" style="background:#000000 url(<?php echo $feed['thumbnail']; ?>) no-repeat top left;">
                    <div class="medium-wrapper">
                        <h1><a href="<?php echo $feed['link']; ?>"><?php echo $feed['title']; ?></a></h1>
                        <p><?php echo substr($description,0,250); ?></p>
                    </div>
                </div>
            </div>
            <?php
            //if (($fcnt%3)==0)
                //echo "</div>";
            $fcnt++;
            }
        }
        ?>
</div>