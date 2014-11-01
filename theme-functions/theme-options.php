<?php
function twentytwelve_child_theme_menu()
{
	add_theme_page('Theme Options', 'Theme Options', 'edit_theme_options', 'theme-options', 'theme_options_settings');
}
add_action('admin_menu', 'twentytwelve_child_theme_menu');

function theme_options_settings()
{
	$temlate_sidebar = array(
						"publication-template" 	=> "page-templates/publication-template.php",
						"toolkit-template" 		=> "page-templates/toolkit-template.php",
						"home-page-template" 	=> "page-templates/home-page-template.php",
						"toolkit-subpage-template" => "page-templates/toolkit-subpage-template.php");
						
	if(isset($_REQUEST) && !empty($_REQUEST))
	{
		if($_REQUEST["action"] == "widget_assign")
		{
			global $wp_registered_sidebars, $wp_registered_widgets;
			$page_id = $_REQUEST["page_id"];
			
			if(isset($_POST["save_widget"]))
			{
				if(isset($_POST["widget_id"]))
				{
					$data = serialize($_POST["widget_id"]);
					update_post_meta($page_id, "_oer_assign_widget", $data);
				}
			}
			
			$temlpate = get_post_meta($page_id,"_wp_page_template",true);
			$oer_assign_widget = unserialize(get_post_meta($page_id,"_oer_assign_widget",true));
			
			
			
			foreach($temlate_sidebar as $key => $value)
			{
				if($value == $temlpate)
				{
					$index = $key;	
				}	
			}
			
			$sidebars_widgets = wp_get_sidebars_widgets();
			$widget_ids = $sidebars_widgets[$index];
			
			$strphs = array("-","_");
			echo '<div class="wrap">
					<h2>'.get_the_title( $page_id ).'</h2>
					<h4>Assign Temlate : '. ucwords(str_replace($strphs," ",$index)) .' </h4>';
					
			echo '<form method="post">
				  <table class="oer-custom-table">
				  <tr>
						<td><input type="checkbox" name="widget_id[]" value="" /></td>
						<td><strong>Widget Title</strong></td>
				  </tr>';		
			
			if( !empty($widget_ids) )
			{
				foreach( $widget_ids as $id )
				{
					if($oer_assign_widget && !empty($oer_assign_widget))
					{
						if(in_array($id,$oer_assign_widget))
						{
							$chekd = 'checked="checked"';
						}
						else
						{
							$chekd = '';
						}	
					}
					$option_name = $wp_registered_widgets[$id]['callback'][0]->option_name;
					echo '<tr>
							<td><input type="checkbox" name="widget_id[]" value="'.$id.'" '.$chekd.'/></td>
							<td>'.ucwords(str_replace($strphs," ",$option_name)).'</td>
						 </tr>'; 
				}
			}
			echo '</table>
				  <input type="submit" name="save_widget" value="Save Setting" />
				  </form>
				  </div>';
		}
		else
		{
			$args = array(
				'sort_order' => 'ASC',
				'sort_column' => 'post_title',
				'hierarchical' => 0,
				'exclude' => '',
				'include' => '',
				'meta_key' => '',
				'meta_value' => '',
				'authors' => '',
				'child_of' => 0,
				'parent' => -1,
				'exclude_tree' => '',
				'number' => '',
				'offset' => 0,
				'post_type' => 'page',
				'post_status' => 'publish');
		$pages = get_pages($args);
		
		$return .= '<table class="wp-list-table widefat fixed pages">
			  <thead>
				<tr>
					<th id="title" class="manage-column column-title sortable desc" style="" scope="col">Page Title</th>
					<th id="author" class="manage-column column-author" style="" scope="col">Author</th>
					<th id="date" class="manage-column column-date sortable asc" style="" scope="col">Date</th>
				</tr>
			  </thead>
			  <tbody>';
		
			  foreach($pages as $page)
			  {
				 $user = get_user_by( 'id', $page->post_author);
				 
				 $return .= '<tr>';
				 $return .= '<td><a href="'.site_url().'/wp-admin/themes.php?page=theme-options&action=widget_assign&page_id='.$page->ID.'"><strong>'.$page->post_title.'</strong></a></td>';
				 $return .= '<td>'.$user->user_login.'</td>';
				 $return .= '<td>'.$page->post_modified.'</td>';
				 $return .= '</tr>';
			  }
		$return .= '</tbody>
				</table>';
		echo $return;
	  }
   }
}
?>