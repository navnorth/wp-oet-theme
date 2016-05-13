<?php
//Initial Checking for showing the resources box
$withChild = false;
$subpages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'menu_order', 'sort_order' => 'asc' ) );
if ($subpages)
    $withChild = true;
else {
    $parent_id = $post->post_parent;
    if ($parent_id>0)
            $withChild = true;
}
?>
<div class="right_sid_mtr program_toc_box" id="toc">
    <?php if ($withChild): ?>
    <div class="col-md-12 col-sm-6 col-xs-6">
        <div class="cntnbx_cntnr">
            <?php
                if ($subpages) {
                    $index = 0;
                    foreach($subpages as $spage) {
                            $index++;
                            if (($index % 2)==1) {
                                ?>
                                <div class="row">
                                <?php
                            }
                            $featured_image = wp_get_attachment_url( get_post_thumbnail_id($spage->ID) );
                            ?>
                            <div class="col-md-6" style="margin-bottom: 30px;">
                                <a href="<?php echo get_page_link($spage->ID); ?>" onmousedown="_sendEvent('Outbound','tech.ed.gov','<?php echo get_page_link($spage->ID); ?>',0);">
                                    <button class="btn btn-large toc-button">
                                        <?php if ($featured_image): ?>
                                            <img src="<?php echo $featured_image; ?>" height="60px" style="margin-right: 15px;">
                                        <?php endif; ?>
                                         <?php echo $spage->post_title; ?>
                                    </button>
                                </a>
                            </div>
                            <?php if (($index % 2)==0) { ?>
                                </div>
                            <?php } ?>
                            <?php
                    }
                } else {
                    //Get Parent of Page
                    $parent_id = $post->post_parent;
                    if ($parent_id>0) {
                            $parent_page = get_page($parent_id);
                            echo "<li><a href='".get_page_link($parent_id)."'>Main</a></li>";

                            //Display Sub page links
                            $subpages = get_pages( array( 'child_of' => $parent_id, 'sort_column' => 'menu_order', 'sort_order' => 'asc', 'parent' => $parent_id ) );

                            foreach($subpages as $spage) {
                                    if ($post->ID==$spage->ID){
                                            echo "<li>" . $spage->post_title . "</li>";
                                    } else {
                                    ?>
                                            <li><a href="<?php echo get_page_link($spage->ID); ?>"><?php echo $spage->post_title; ?></a></li>
                                    <?php
                                    }
                            }
                    }
                }
            ?>
        </div>
    </div>
    <?php endif; ?>
</div>