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
    
    // Get Medium Stories via JSON
    function get_medium_stories(){
        $limit = 100;
        $all_url = "https://medium.com/@".$this->_user->data->username."/latest?format=json&limit=".$limit;
        $data = get_medium_posts_json($all_url);
        $feeds = array();
        $index = 0;
        foreach($data['payload']['references']['Post'] as $post){
            $feeds[]=$post;
        }
        return $feeds;
    }
    
    // Display All Medium Posts
    public function display_posts(){
        $publications = $this->get_publications();
        $rss_urls = $this->get_rss_urls();
        $feeds = $this->get_feeds();
        var_dump($this->_feeds);
        $med_posts = array_unique($this->_feeds);
        var_dump($med_posts);
        //if ($this->_feeds) {
        if ($med_posts) {
            $fcnt = 1;
            //foreach($this->_feeds as $feed) {
            foreach($med_posts as $feed) {
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
            <div class="col-md-4 col-sm-6 col-xs-12 medium-list">
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
        
        $match = false;
        
        $find_url = parse_url($url);
        $post_url = $find_url['scheme']."://".$find_url['host'].$find_url['path'];
        $story = null;
        
        if (strpos($url,"@".$this->_user->data->username)){
            $feeds = $this->get_medium_stories();
            if ($feeds){
                foreach($feeds as $feed){
                    $link_url = $find_url['scheme']."://".$find_url['host']."/@".$this->_user->data->username."/".$feed['uniqueSlug'];
                    if ($post_url==$link_url){
                        $match = true;
                        
                        $title = $feed['title'];
                        if (strlen($title)>80){
                            $title = substr($title,0,80);
                            $title = substr($title,0,strrpos($title," "))."...";
                        }
                        
                        if (isset($feed['content']['metaDescription']))
                            $description = $feed['content']['metaDescription'];
                        else
                            $description = $feed['content']['subtitle'];
                            
                        $description = strip_tags_content($description,"<h3>","</h3>");
                        $description = strip_tags_content($description,"<figure>","</figure>");
                        $description = trim(strip_tags($description));

                        if (strlen($description)>175){
                            $description = substr($description,0,175);
                            $description = substr($description,0,strrpos($description," "))."...";
                        }
                        
                        $background = "";
                        if (isset($feed['virtuals']['previewImage']['imageId'])){
                            $cdn_base = "https://cdn-images-1.medium.com/max/1024/";
                            $background = "background:#000000 url(". $cdn_base.$feed['virtuals']['previewImage']['imageId'] .") no-repeat top left;";
                        } else
                            $background = "background:#757575";
                        
                        $story['title'] = $title;
                        $story['description'] = $description;
                        $story['background'] =  $background;
                        $story['align'] = $align;
                        $story['link'] = $link_url;
                        break;
                    }
                }
            }
        } else {
            $feeds = $this->get_feeds();
            if ($this->_feeds) {
                foreach($this->_feeds as $feed) {
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
                        
                        $story['description'] = $description;
                        $story['background'] =  $background;
                        $story['title'] = $title;
                        $story['align'] = $align;
                        $story['link'] = $feed[0]['link'];
                        $story['pub_name'] = $feed["pub_name"];
                        $story['pub_url'] = $feed["pub_url"];
                    break;
                    }
                }
            }
        }
        
        if(!$match){
            return $this->display_invalid_text();
        } else {
            return $this->display_single_embed($story);
        }
    }
    
    function display_single_embed($story){
        if ($story['align']=='center')
            $align = 'margin:0 auto';
        else
            $align = 'float:'.$story['align'];
        $embed = '
        <div class="col-md-12 col-sm-12 col-xs-12 single-medium">
            <div class="medium" style="'.$story['background'].''.$align.'">
                <div class="medium-background">
                    <div class="medium-wrapper">
                        <h1><a href="'.$story['link'].'" target="_blank" onclick="ga(\'send\', \'event\', \'Medium Blog Click\', \''.$story['link'].'\');">'.$story['title'].'</a></h1>
                        <p>'.$story['description'].'</p>
                        <p class="mfooter">
                            <a href="'.$this->_user->data->url.'" alt="Office of Educational Technology logo" target="_blank" class="imglink" onclick="ga(\'send\', \'event\', \'Medium Blog Click\', \''.$this->_user->data->url.'\');"><img src="'.$this->_user->data->imageUrl.'" alt="Office of Educational Technology logo" width="30" height="30" /></a> <a href="'.$this->_user->data->url.'" target="_blank" onclick="ga(\'send\', \'event\', \'Medium Blog Click\', \''.$this->_user->data->url.'\');">@'.$this->_user->data->username.'</a>';
        if (isset($story["pub_name"]) && $story["pub_name"]!==""){
            $embed .= 'in <a href="'.$story["pub_url"].'" alt="'.$story["pub_name"].'" title="'.$story["pub_name"].'" target="_blank" onclick="ga(\'send\', \'event\', \'Medium Blog Click\', \''.$story["pub_url"].'\');">'.$story["pub_name"].'</a>';
        }
        $embed .= '     </p>
                    </div>
                </div>
            </div>
        </div>
        ';
        return $embed;
    }
    
    function display_invalid_text(){
        $background = "background:#757575";
        return $embed = '
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="medium" style="'.$background.'">
                <div class="medium-background">
                    <div class="medium-wrapper">
                        <p>Medium post invalid</p>
                    </div>
                </div>
            </div>
        </div>
        ';
    }
}


?>