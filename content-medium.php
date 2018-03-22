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
            "feed_url" => "https://medium.com/feed/@".$user->data->username
            );

if ($publications){
    foreach($publications as $publication){
        $pub_name = sanitize_title($publication->name);
        if (strpos($publication->url,$medium_base_url)>=0)
            $pub_name = trim(substr($publication->url,strlen($medium_base_url),strlen($publication->url)));
        $rss_urls[] = array(
                            "feed_url" => "https://medium.com/feed/".$pub_name,
                            "name" => $publication->name,
                            "url" => $publication->url
                           );
    }
}

$feeds = array();
foreach ($rss_urls as $rss_url){
    $feed = convert_rss_to_json($rss_url["feed_url"]);
    if ($feed){
        if ($feed['status']=="ok"){
            foreach($feed['items'] as $item){
            if (isset($rss_url["name"]))
               $feeds[] = array($item, array("pub_name"=>$rss_url["name"],"pub_url"=>$rss_url["url"])) ;
            else
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
                $description = strip_tags_content($feed['description'],"<h3>","</h3>");
                $description = strip_tags_content($description,"<figure>","</figure>");
                $description = trim(strip_tags($description));
                if (strlen($description)>175)
                    $description = substr($description,0,175)."...";
            ?>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="medium" style="background:#000000 url(<?php echo $feed['thumbnail']; ?>) no-repeat top left;">
                    <div class="medium-wrapper">
                        <h1><a href="<?php echo $feed['link']; ?>"><?php echo $feed['title']; ?></a></h1>
                        <p><?php echo $description ?></p>
                        <p>
                            <a href="<?php echo $user->data->url; ?>" target="_blank"><img src="<?php echo $user->data->imageUrl; ?>" width="30" height="30" /></a> <a href="<?php echo $user->data->url; ?>" target="_blank">@<?php echo $user->data->username; ?></a>
                            <?php if (isset($feed["pub_name"])){ ?>
                             in <a href="<?php echo $feed["pub_url"]; ?>" target="_blank"><?php echo $feed["pub_name"]; ?></a>
                            <?php } ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php
            $fcnt++;
            }
        }
        ?>
</div>