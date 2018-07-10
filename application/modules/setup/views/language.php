<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

	<div class="install-step">

		<h1>MyClinicSoft</h1>
		
		<legend><?php echo lang('setup_choose_language'); ?></legend>

		<p><?php echo lang('setup_choose_language_message'); ?></p> 

		<select name="mcs_lang">
			<?php foreach ($languages as $language) { $language = str_replace('\\', '', $language);?>
			<option value="<?php echo $language; ?>" <?php if ($language == 'english') { ?>selected="selected"<?php } ?>><?php echo ucfirst($language); ?></option>
			<?php } ?>
		</select>
		
		<br>

		<input class="btn btn-primary" type="submit" name="btn_continue" value="<?php echo lang('continue'); ?>">

	</div>

</form>