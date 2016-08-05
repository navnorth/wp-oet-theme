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

$sublinks = array();
}
?>
<div class="right_sid_mtr program_toc_box" id="toc">
    <?php if ($withChild): ?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="cntnbx_cntnr">
            <?php
                if ($subpages) {
                    $index = 0;
                    $max = count($subpages);
                    foreach($subpages as $spage) {
                            $template = get_post_meta($spage->ID, '_wp_page_template', true);
                            $short_title = get_post_meta($spage->ID, "short_title", true);
                            if ($template == "page-templates/publication-subsection-template.php") {
                                $index++;
                                if (($index % 2)==1) {
                                    $rowopen = true;
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
                                            <?php
                                            if ($short_title):
                                                echo $short_title;
                                            else:
                                                echo $spage->post_title;
                                            endif;
                                            ?>
                                        </button>
                                    </a>
                                </div>
                                <?php
                                if (($index % 2)==0) {
                                    $rowopen = false;
                                ?>
                                </div>
                                <?php } ?>
                            <?php } else {
                                $sublinks[] = $spage;
                            } ?>
                            <?php
                    }
                    if ($rowopen) :
                        echo '</div>';
                    endif;
                    if (!empty($sublinks)) {
                        echo "<div class='clearfix'></div>";
                        echo "<hr>";
                        $subindex = 0;
                        foreach($sublinks as $sublink) {
                            $subindex++;
                            echo '<a href="'.get_page_link($sublink->ID).'" onmousedown="_sendEvent(\'Outbound\',\'tech.ed.gov\',\''.get_page_link($sublink->ID).'\',0);">'.$sublink->post_title.'</a>';
                            if ($subindex<count($sublinks))
                                echo ' / ';
                        }
                    }
                } else {
                    ?>
                    <div class="toc-box">
                    <?php
                    //Get Parent of Page
                    $parent_id = $post->post_parent;
                    if ($parent_id>0) {
                            $parent_page = get_page($parent_id);
                            ?>
                            <h3>Sections (<a href="<?php echo get_page_link($parent_id); ?>" onmousedown="_sendEvent('Outbound','tech.ed.gov','<?php echo get_page_link($parent_id); ?>',0);">Back to <?php echo $parent_page->post_title; ?></a>)</h3>
                            <?php

                            //Display Sub page links
                            $subpages = get_pages( array( 'child_of' => $parent_id, 'sort_column' => 'menu_order', 'sort_order' => 'asc', 'parent' => $parent_id ) );
                            
                            $index=0;
                            foreach($subpages as $spage) {
                                $template = get_post_meta($spage->ID, '_wp_page_template', true);
                                $short_title = get_post_meta($spage->ID, "short_title", true);
                                if ($template == "page-templates/publication-subsection-template.php") {
                                    $index++;
                                    if (($index % 3)==1) { ?>
                                        <div class="row">
                                    <?php }
                                    $featured_image = wp_get_attachment_url( get_post_thumbnail_id($spage->ID) );
                                    ?>
                                    
                                    <div class="col-md-4" style="margin-bottom: 15px; margin-top: 15px;">
                                        <a href="<?php echo get_page_link($spage->ID); ?>" onmousedown="_sendEvent('Outbound','tech.ed.gov','<?php echo get_page_link($spage->ID); ?>',0);">
                                            <button class="btn btn-large toc-small-button">
                                                <?php if ($featured_image){ ?>
                                                <img src="<?php echo $featured_image; ?>" height="30px" style="margin-right: 15px;">
                                                <?php } ?>
                                                <?php
                                                if ($short_title):
                                                    echo $short_title;
                                                else:
                                                    echo $spage->post_title;
                                                endif;
                                                ?>
                                            </button>
                                        </a>
                                    </div>
                                    
                                    <?php if (($index % 3)==0) { ?>
                                        </div>
                                    <?php } ?>
                                <?php } else {
                                    $sublinks[] = $spage;
                                } ?>
                            <?php
                            }
                        if (!empty($sublinks)) {
                            echo "<div class='clearfix'></div>";
                            echo "<hr>";
                            $subindex = 0;
                            foreach($sublinks as $sublink) {
                                $subindex++;
                                echo '<a href="'.get_page_link($sublink->ID).'" onmousedown="_sendEvent(\'Outbound\',\'tech.ed.gov\',\''.get_page_link($sublink->ID).'\',0);">'.$sublink->post_title.'</a>';
                                if ($subindex<count($sublinks))
                                    echo ' / ';
                            }
                        }
                    }
                    ?>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
    <?php endif; ?>
</div>