<?php
class FeaturedContentWidgetDetails extends WP_Widget
{
     function FeaturedContentWidgetDetails()
    {
         $widget_options = array('classname'=>'FeaturedContentWidgetDetails', 'description'=> 'Widget that will show Featured Content.');
         $this->WP_Widget('FeaturedContentWidgetDetails','Featured Content', $widget_options);
    }
    function update($newinstance,$oldinstance)
    {
        $instance =  $oldinstance;
        $instance['heading'] = $newinstance['heading'];
	    $instance['title'] = $newinstance['title'];
		$instance['image'] = $newinstance['image'];
		$instance['htmltext'] = $newinstance['htmltext'];
	return $instance;
    }
    function form($instance)
    {
		if(isset($instance['heading']))
		{
			$heading = $instance['heading'];
		}
		if(isset($instance['title']))
		{
			$title = $instance['title'];
		}
		if(isset($instance['image']))
		{
			$image = $instance['image'];
		}
		if(isset($instance['htmltext']))
		{
			$htmltext = $instance['htmltext'];
		}
        ?>  
        <p>
            <label for="<?php echo $this->get_field_id("heading");?>">Heading:</label> 
            <input type="text"  <?php if(isset($heading)){?> value="<?php echo esc_attr($heading); ?>" <?php }else{ echo 'value=""';}?> name="<?php echo $this->get_field_name("heading"); ?>" id="<?php echo $this->get_field_id("heading");?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("title");?>">Title:</label> 
            <input type="text"  <?php if(isset($title)){?> value="<?php echo esc_attr($title); ?>" <?php }else{ echo 'value=""';}?> name="<?php echo $this->get_field_name("title"); ?>" id="<?php echo $this->get_field_id("title");?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("image");?>">Image:</label> 
            <select name="<?php echo $this->get_field_name("image"); ?>" id="<?php  echo $this->get_field_id("image");?>" class="widefat">
                    <option value="img1" <?php if(isset($value)){if($value == 'img1'){echo 'selected';}}?>>Star Icon</option>
                    <option value="img2" <?php if(isset($value)){if($value == 'img2'){echo 'selected';}}?>>Compress Icon</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("htmltext");?>">Html Text:</label> 
            <textarea name="<?php echo $this->get_field_name("htmltext"); ?>" id="<?php echo $this->get_field_id("htmltext");?>" class="widefat"><?php if(isset($htmltext)){ echo esc_attr($htmltext); }else{ echo '';}?> </textarea>
        </p>   
       <?php       
    }
    function widget($args, $instance)
    {
		//here define your html for showing at front side
		//echo $instance['heading'];
		//echo $instance['image'];
		//echo $instance['htmltext'];
		
		$return = '';
		$return .= '<div class="col-md-12 col-sm-6 col-xs-6">';
        $return .= '<div class="pblctn_box">';
			if($instance['image'] == 'img1')
			{
				$return .= '<span class="socl_icns fa-stack"><i class="fa fa-star "></i></span>';
			}
			elseif($instance['image'] == 'img2')
			{
				$return .= '<span class="socl_icns fa-stack"><i class="fa fa-compress "></i></span>';	
			}
             	
        $return .= '</div>';
            $return .= '<P class="rght_sid_wdgt_hedng"><b>'. $instance['title'] .'</b></P>';
            $return .= $instance['htmltext'];
        $return .= '</div>';
		
		echo $return;
	}
} 
function register_featurecontent_widget() {
	register_widget( 'FeaturedContentWidgetDetails' );
}
add_action( 'widgets_init', 'register_featurecontent_widget' );