<?php
include_once wp_normalize_path( get_stylesheet_directory() . '/classes/oet_medium.php' );

$self_access_token = get_option("mediumaccesstoken");
$oet_medium = new OET_Medium($self_access_token);

?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <?php
    if ($_POST['display']=="all"){
        $oet_medium->display_all_stories();
    } else {
        if (!empty($_POST['publication']))
            $oet_medium->display_posts($_POST['publication']);   
        else
            $oet_medium->display_posts();   
    }
    ?>
</div>
