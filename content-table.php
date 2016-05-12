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
    <div class="col-md-12 col-sm-6 col-xs-6" style="border: 3px solid #00529f;margin-bottom:10px;">
            <div class="pblctn_box">
                    <span class="socl_icns fa-stack"><i class="fa fa-link"></i></span>
            </div>
            <div class="cntnbx_cntnr">
                    <span class="program_toc_header">Additional Info</span>
                    <ul class="program_toc">
                            <?php
                                    if ($subpages) {
                                            ?>
                                            <li>Main</li>
                                            <?php
                                            foreach($subpages as $spage) {
                                                    ?>
                                                    <li><a href="<?php echo get_page_link($spage->ID); ?>"><?php echo $spage->post_title; ?></a></li>
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
                    </ul>
                    <p>
            </div>
    </div>
    <?php endif; ?>
</div>