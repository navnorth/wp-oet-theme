<?php
/** Load WordPress Bootstrap */
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

extract($_REQUEST);
if($action == "show_popup")
{
	$return = '';
	$return .= '<div id="oet-shortcode-form"><div id="oet-table" class="form-table">
					<div class="oet_sngltinyrow">
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);" data-shortcode="accordian">
							<div class="oert_snglimgtiny">
								<img src="'.get_stylesheet_directory_uri().'/tinymce_button/images/accordian.png">
							</div>
							<div class="oert_snglttltiny">
								Accordion
							</div>
						</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);" data-shortcode="banner">
							<div class="oert_snglimgtiny">
								<img src="'.get_stylesheet_directory_uri().'/tinymce_button/images/banner.png">
							</div>
							<div class="oert_snglttltiny">
								Disruptive Content
							</div>
						</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);" data-shortcode="button">
							<div class="oert_snglimgtiny" style="height:90px; vertical-align:middle;">
								<button class="btn custom-button" style="margin-top:40px;">button</button>
							</div>
							<div class="oert_snglttltiny">
								Button
							</div>
						</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);" data-shortcode="featured_content">
							<div class="oert_snglimgtiny">
								<img src="'.get_stylesheet_directory_uri().'/tinymce_button/images/featured_content.png">
							</div>
							<div class="oert_snglttltiny">
								Featured Content
							</div>
						</div>
					</div>

					<div class="oet_sngltinyrow">
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);" data-shortcode="featured_video">
							<div class="oert_snglimgtiny">
								<img src="'.get_stylesheet_directory_uri().'/tinymce_button/images/featured_video.png">
							</div>
							<div class="oert_snglttltiny">
								Featured Video
							</div>
						</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);" data-shortcode="pull_quotes">
							<div class="oert_snglimgtiny">
								<img src="'.get_stylesheet_directory_uri().'/tinymce_button/images/pull_quotes.png">
							</div>
							<div class="oert_snglttltiny">
								Pull Quotes
							</div>
						</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);" data-shortcode="left_column">
							<div class="oert_snglimgtiny">
								<img src="'.get_stylesheet_directory_uri().'/tinymce_button/images/left_column.png">
							</div>
							<div class="oert_snglttltiny">
								Left Column
							</div>
						</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);" data-shortcode="right_column">
							<div class="oert_snglimgtiny">
								<img src="'.get_stylesheet_directory_uri().'/tinymce_button/images/right_column.png">
							</div>
							<div class="oert_snglttltiny">
								Right Column
							</div>
						</div>
					</div>

					<div class="oet_sngltinyrow">
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);" data-shortcode="recommended_resources">
							<div class="oert_snglimgtiny">
								<img src="'.get_stylesheet_directory_uri().'/tinymce_button/images/featured_video.png">
							</div>
							<div class="oert_snglttltiny">
								Recommended Resource
							</div>
						</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);" data-shortcode="featured_content_box">
							<div class="oert_snglimgtiny">
								<img src="'.get_stylesheet_directory_uri().'/tinymce_button/images/featured_video.png">
							</div>
							<div class="oert_snglttltiny">
								Featured Content Box
							</div>
						</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);" data-shortcode="bsgrid">
							<div class="oert_snglimgtiny">
								<div class="oet_bs_row"></div>
								<div class="oet_bs_row2"><div class="oet_bs_col"></div><div class="oet_bs_col"></div><div class="oet_bs_col"></div></div>
							</div>
							<div class="oert_snglttltiny">
								Bootstrap Grid
							</div>
						</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);" data-shortcode="spacer">
							<div class="oert_snglimgtiny" style="height:60px; vertical-align:middle;">
								<hr style="margin-top:35px;" />
							</div>
							<div class="oert_snglttltiny">
								Spacer
							</div>
						</div>
					</div>
					<div class="oet_sngltinyrow">
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);" data-shortcode="callout_box">
							<div class="oert_snglimgtiny">
								<img src="'.get_stylesheet_directory_uri().'/tinymce_button/images/callout-box.png">
							</div>
							<div class="oert_snglttltiny">
								Callout Box
							</div>
						</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);" data-shortcode="publication_intro">
							<div class="oert_snglimgtiny">
								<img src="'.get_stylesheet_directory_uri().'/tinymce_button/images/pubintro.png">
							</div>
							<div class="oert_snglttltiny">
								Publication Intro
							</div>
						</div>
						<div class="oet_sngltinyclm">
						</div>
						<div class="submit">
							<input type="button" id="oet-tinymce-submit" onclick="placeoetshortcode();" class="button-primary" value="Insert Shortcode" name="submit" />
						</div>
					</div>
		</div>
		</div>
		<script type="text/javascript">
			function oet_meclicked(ref)
			{
				jQuery(".oet_sngltinyclm").each(function(index, element) {
    				jQuery(this).removeClass("oet_snglslctd");
				});
				jQuery(ref).addClass("oet_snglslctd");
			}
			function placeoetshortcode(){
				var shortcode_type = jQuery(".oet_sngltinyclm.oet_snglslctd").attr("data-shortcode");
				var shortcode = get_myshortcode(shortcode_type);
				if(typeof tinyMCE != "undefined" && ( ed = tinyMCE.activeEditor ) && !ed.isHidden()){
					tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
					tinymce.EditorManager.execCommand("mceRemoveControl",true, "content");
				}
				else
				{
					var cursor = jQuery("#content").prop("selectionStart");
					if(!cursor) cursor = 0;
					var content = jQuery("#content").val();
					var textBefore = content.substring(0,  cursor );
					var textAfter  = content.substring( cursor, content.length );
					jQuery("#content").val( textBefore + shortcode + textAfter );
				}
				tb_remove();
			}
			function get_myshortcode(shortcode_type)
			{
				switch (shortcode_type)
				{
				   case "accordian":
					   var shortcode = "[oet_accordion_group][oet_accordion title=\'\' accordion_series=\'one\' expanded=\'\'] your content goes here [/oet_accordion][oet_accordion title=\'\' accordion_series=\'two\' expanded=\'\'] your content goes here [/oet_accordion][oet_accordion title=\'\' accordion_series=\'three\' expanded=\'\'] your content goes here [/oet_accordion][/oet_accordion_group]";
					   break;
				   case "banner":
					   var shortcode = "[disruptive_content title=\'\' main_text=\'\' button_text=\'\' button_color=\'\' button_url=\'\']";
					   break;
				   case "button":
					   var shortcode = "[oet_button text=\'\' button_color=\'\' text_color=\'\' font_face=\'\' font_size=\'\' font_weight=\'\' url=\'\' new_window=\'yes/no\']";
					   break;
				   case "featured_content":
					   var shortcode = "[featured_item heading=\'\' url=\'\' image=\'\' title=\'\' date=\'\' button=\'\' button_text=\'\' sharing=\'\']your content goes here[/featured_item]";
					   break;
				   case "featured_video":
					   var shortcode = "[featured_video heading=\'\' videoid=\'\' description=\'\' height=\'\']";
					   break;
				   case "left_column":
					   var shortcode = "[home_left_column heading=\'yes/no\'] your content goes here [/home_left_column]";
					   break;
				   case "pull_quotes":
					   var shortcode = "[pull_quote speaker=\'\' additional_info=\'\']your content goes here[/pull_quote]";
					   break;
				   case "right_column":
					   var shortcode = "[home_right_column] your content goes here [/home_right_column]";
					   break;
				   case "recommended_resources":
					   var shortcode = "[recommended_resources media_type1=\'\' src1=\'\' text1=\'\' link1=\'\' media_type2=\'\' src2=\'\' text2=\'\' link2=\'\' media_type3=\'\' src3=\'\' text3=\'\'  link3=\'\']";
					   break;
				   case "featured_content_box":
					   var shortcode = "[featured_content_box title=\'\' top_icon=\'\' align=\'\']your content goes here[/featured_content_box]";
					   break;
				   case "bsgrid":
					   var shortcode = "[row][column md=\'4\'] your 1st column content here[/column][column md=\'4\'] your 2nd column content here[/column][column md=\'4\'] your 3rd column content here[/column][/row]";
					   break;
				   case "spacer":
					   var shortcode = "[spacer height=\'16\']";
					   break;
				   case "callout_box":
					   var shortcode = "[oet_callout type=\'\' width=\'\' color=\'\' alignment=\'\']Your content goes here[/oet_callout]";
					   break;
				   case "publication_intro":
					   var shortcode = "[publication_intro title=\'\' text=\'\']";
					   break;
				   default:
				   	   var shortcode = "";
				   	   break
				}
				return shortcode;
			}
			</script>';
	echo $return;
}
?>
