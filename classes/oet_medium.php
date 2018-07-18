<?php
include_once wp_normalize_path( get_stylesheet_directory() . '/vendor/autoload.php' );

use JonathanTorres\MediumSdk\Medium;

class OET_Medium {
    
    private $_access_token;
    private $_user;
    private $_medium;
    private $_base_url = "https://medium.com/";
    private $_publications;
    private $_rss_urls = array();
    private $_feeds = array();
    
    public function __construct($self_access_token = null){
        if ($self_access_token){
            $this->_access_token = $self_access_token;
        } else {
            $this->_access_token = get_option("mediumaccesstoken");
        }
        $this->authenticate();
    }
    
    // Authentication Medium Access Token
    private function authenticate(){
        if ($this->_access_token) {
            // Self Access Token Authentication
            $this->_medium = new Medium($this->_access_token);
            $this->_user = $this->_medium->getAuthenticatedUser();
        } else {
            throw new Exception('Invalid Self Access Token');
        }
    }
    
    // Get Medium Publications based on authenticated user
    private function get_publications(){
        if ($this->_user){
            $this->_publications = $this->_medium->publications($this->_user->data->id)->data;
            return $this->_publications;
        } else {
            throw new Exception('Medium User Not Authenticated');
        }
    }
    
    // Get RSS Urls
    private function get_rss_urls(){
        global $post;
        
        if ($this->_user){
            $this->_rss_urls[] = array(
                "feed_url" => "https://medium.com/feed/@".$this->_user->data->username
            );
            
            if ($this->_publications){
                $i = 1;
                foreach($this->_publications as $publication){
                    $pub_name = sanitize_title($publication->name);
                    if (strpos($publication->url,$this->_base_url)>=0)
                        $pub_name = trim(substr($publication->url,strlen($this->_base_url),strlen($publication->url)));
                        
                        if (get_post_meta($post->ID, "mpublication".$i, true)=="1")
                            $this->_rss_urls[] = array(
                                    "feed_url" => "https://medium.com/feed/".$pub_name,
                                    "name" => $publication->name,
                                    "url" => $publication->url
                                   );
                    $i++;
                }
            } else {
                throw new Exception('Invalid User Publications');
            }
            return $this->_rss_urls;
        } else {
            throw new Exception('Medium User Not Authenticated');
        }
    }
    
    // Get Feeds
    private function get_feeds($rss_urls = array()){
        if (count($this->_rss_urls)>0) {
            foreach ($this->_rss_urls as $rss_url){
                $feed = convert_rss_to_json($rss_url["feed_url"]);
                if ($feed){
                    if ($feed['status']=="ok"){
                        foreach($feed['items'] as $item){
                            if (isset($rss_url["name"]))
                               $this->_feeds[] = array($item, "pub_name"=>$rss_url["name"],"pub_url"=>$rss_url["url"]) ;
                            else
                               $this->_feeds[] = array($item);
                        }
                    }
                }
            }
            return $this->_feeds;
        } else {
            throw new Exception('No RSS Url Specified!');
        }
    }
    
    // Display All Medium Posts
    public function display_posts(){
        $publications = $this->get_publications();
        $rss_urls = $this->get_rss_urls();
        $feeds = $this->get_feeds();
        
        if ($this->_feeds) {
            $fcnt = 1;
            foreach($this->_feeds as $feed) {
                $description = strip_tags_content($feed[0]['description'],"<h3>","</h3>");
                $description = strip_tags_content($description,"<figure>","</figure>");
                $description = trim(strip_tags($description));
                if (strlen($description)>175){
                    $description = substr($description,0,175);
                    $description = substr($description,0,strrpos($description," "))."...";
                }
                
                $background = "";
                if (substr($feed[0]['thumbnail'],0,11)=="https://cdn")
                    $background = "background:#000000 url(". $feed[0]['thumbnail'] .") no-repeat top left;";
                elseif (substr($feed[0]['thumbnail'],0,11)=="https://med")
                    $background = "background:#757575";
                    
                $title = $feed[0]['title'];
                if (strlen($title)>80){
                    $title = substr($title,0,80);
                    $title = substr($title,0,strrpos($title," "))."...";
                }
            ?>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="medium" style="<?php echo $background; ?>">
                    <div class="medium-background">
                        <div class="medium-wrapper">
                            <h1><a href="<?php echo $feed[0]['link']; ?>" target="_blank" onclick="ga('send', 'event', 'Medium Blog Click', '<?php echo $feed[0]['link']; ?>');"><?php echo $title; ?></a></h1>
                            <p><?php echo $description ?></p>
                            <p class="mfooter">
                                <a href="<?php echo $this->_user->data->url; ?>" alt="<?php _e('Office of Educational Technology logo','twentytwelve-child'); ?>" target="_blank" class="imglink" onclick="ga('send', 'event', 'Medium Blog Click', '<?php echo $this->_user->data->url; ?>');"><img src="<?php echo $this->_user->data->imageUrl; ?>" alt="<?php _e('Office of Educational Technology logo','twentytwelve-child'); ?>" width="30" height="30" /></a> <a href="<?php echo $this->_user->data->url; ?>" target="_blank" onclick="ga('send', 'event', 'Medium Blog Click', '<?php echo $this->_user->data->url; ?>');">@<?php echo $this->_user->data->username; ?></a>
                                <?php if (isset($feed["pub_name"])){ ?>
                                 in <a href="<?php echo $feed["pub_url"]; ?>" alt="<?php echo $feed["pub_name"]; ?>" title="<?php echo $feed["pub_name"]; ?>" target="_blank" onclick="ga('send', 'event', 'Medium Blog Click', '<?php echo $feed["pub_url"]; ?>');"><?php echo $feed["pub_name"]; ?></a>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $fcnt++;
            }
        }
    }
    
    // Display Individual Post by Url
    public function display_post($url, $align="left"){
        $publications = $this->get_publications();
        $rss_urls = $this->get_rss_urls();
        $feeds = $this->get_feeds();
        $match = false;
        
        $find_url = parse_url($url);
        $post_url = $find_url['scheme']."://".$find_url['host'].$find_url['path'];
        var_dump($post_url);
        if ($this->_feeds) {
            foreach($this->_feeds as $feed) {
                var_dump($feed[0]['link']);
                $link = parse_url($feed[0]['link']);
                $link_url = $link['scheme']."://".$link['host'].$link['path'];
                
                if ($post_url==$link_url){
                    $match = true;
                    $description = strip_tags_content($feed[0]['description'],"<h3>","</h3>");
                    $description = strip_tags_content($description,"<figure>","</figure>");
                    $description = trim(strip_tags($description));
                    if (strlen($description)>175){
                        $description = substr($description,0,175);
                        $description = substr($description,0,strrpos($description," "))."...";
                    }
                    
                    $background = "";
                    if (substr($feed[0]['thumbnail'],0,11)=="https://cdn")
                        $background = "background:#000000 url(". $feed[0]['thumbnail'] .") no-repeat top left;";
                    elseif (substr($feed[0]['thumbnail'],0,11)=="https://med")
                        $background = "background:#757575";
                        
                    $title = $feed[0]['title'];
                    if (strlen($title)>80){
                        $title = substr($title,0,80);
                        $title = substr($title,0,strrpos($title," "))."...";
                    }
                ?>
                <div class="col-md-4 col-sm-6 col-xs-12" style="float:<?php echo $align; ?>">
                    <div class="medium" style="<?php echo $background; ?>">
                        <div class="medium-background">
                            <div class="medium-wrapper">
                                <h1><a href="<?php echo $feed[0]['link']; ?>" target="_blank" onclick="ga('send', 'event', 'Medium Blog Click', '<?php echo $feed[0]['link']; ?>');"><?php echo $title; ?></a></h1>
                                <p><?php echo $description ?></p>
                                <p class="mfooter">
                                    <a href="<?php echo $this->_user->data->url; ?>" alt="<?php _e('Office of Educational Technology logo','twentytwelve-child'); ?>" target="_blank" class="imglink" onclick="ga('send', 'event', 'Medium Blog Click', '<?php echo $this->_user->data->url; ?>');"><img src="<?php echo $this->_user->data->imageUrl; ?>" alt="<?php _e('Office of Educational Technology logo','twentytwelve-child'); ?>" width="30" height="30" /></a> <a href="<?php echo $this->_user->data->url; ?>" target="_blank" onclick="ga('send', 'event', 'Medium Blog Click', '<?php echo $this->_user->data->url; ?>');">@<?php echo $this->_user->data->username; ?></a>
                                    <?php if (isset($feed["pub_name"])){ ?>
                                     in <a href="<?php echo $feed["pub_url"]; ?>" alt="<?php echo $feed["pub_name"]; ?>" title="<?php echo $feed["pub_name"]; ?>" target="_blank" onclick="ga('send', 'event', 'Medium Blog Click', '<?php echo $feed["pub_url"]; ?>');"><?php echo $feed["pub_name"]; ?></a>
                                    <?php } ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                break;
                }
            }
        }
        if(!$match){
            $this->display_invalid_text();
        }
    }
    
    function display_invalid_text(){
        $background = "background:#757575";
        ?>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="medium" style="<?php echo $background; ?>">
                <div class="medium-background">
                    <div class="medium-wrapper">
                        <p><?php echo "Medium post invalid"; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}


?>