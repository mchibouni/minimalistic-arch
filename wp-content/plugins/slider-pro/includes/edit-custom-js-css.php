<div>	
	<textarea class="custom-js-css-content"><?php echo stripslashes($initial_content); ?></textarea>
	<a class="button-secondary save-button" href="<?php echo wp_nonce_url(admin_url("admin-ajax.php?action=sliderpro_save_custom_js_css&type=$file_type&id=$id"), 'custom-js-css-edit'); ?>">Save</a>
</div>