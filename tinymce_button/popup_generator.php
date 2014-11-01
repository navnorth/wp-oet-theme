<?php
require_once('../../../../wp-load.php');
extract($_REQUEST);
if($action == "show_popup")
{
	$return = '';
	$return .= '<div id="oet-shortcode-form"><div id="oet-table" class="form-table" style="margin-top: 10px;">
					<div class="oet_sngltinyrow">
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-1</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-2</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-3</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-4</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-5</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-6</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-7</div>
					</div>
					<div class="oet_sngltinyrow">
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-8</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-9</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-10</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-11</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-12</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-13</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-14</div>
					</div>
					<div class="oet_sngltinyrow">
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-15</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-16</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-17</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-18</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-19</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-20</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-21</div>
					</div>
					<div class="oet_sngltinyrow">
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-22</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-23</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-24</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-25</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-26</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-27</div>
						<div class="oet_sngltinyclm" onclick="oet_meclicked(this);">Shortcode no-28</div>
					</div>
		</div>
		<div class="submit">
			<input type="button" id="oet-tinymce-submit" onclick="placeoetshortcode();" class="button-primary" value="Insert Shortcode" name="submit" />
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
				var shortcode = jQuery(".oet_sngltinyclm.oet_snglslctd").text();
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
			</script>';
	echo $return;
}
?>