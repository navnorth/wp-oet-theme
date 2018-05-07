<?php
include_once wp_normalize_path( get_stylesheet_directory() . '/classes/oet_medium.php' );

$self_access_token = get_option("mediumaccesstoken");

?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <?php
    $oet_medium = new OET_Medium($self_access_token);
    $oet_medium->display_posts();
    ?>
</div>
