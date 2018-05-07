<?php
include_once wp_normalize_path( get_stylesheet_directory() . '/vendor/autoload.php' );
include_once wp_normalize_path( get_stylesheet_directory() . '/classes/oet_medium.php' );

use JonathanTorres\MediumSdk\Medium;

$self_access_token = get_option("mediumaccesstoken");

?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <?php
    $oet_medium = new OET_Medium($self_access_token);
    $oet_medium->display_posts();
    ?>
</div>
<?php
$oet_medium->display_post("https://medium.com/building-evaluation-capacity/context-and-implementation-matter-da36588dbbe5");
$oet_medium->display_post("https://medium.com/building-evaluation-capacity/data-data-everywhere-and-not-a-drop-to-drink-the-importance-of-researcher-practitioner-d3052a30c672?source=collection_home---4------1----------------");
?>