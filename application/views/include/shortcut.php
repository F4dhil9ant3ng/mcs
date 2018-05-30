<div id="shortcut">
	<ul>
		<li class="">
			<a href="<?php echo site_url('my-profile/'.url_base64_encode($user_info->id));?>" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span><?php echo $this->lang->line('__my_profile');?> </span> </span> </a>
		</li>
		<li class="">
			<a href="/" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-question fa-4x"></i> <span>Help Center</span> </span> </a>
		</li>
		<li class="">
			<a href="/" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-magic fa-4x"></i> <span>Whats new</span> </span> </a>
		</li>
		<li class="">
			<a href="/" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-plus fa-4x"></i> <span>Suggest Feature</span> </span> </a>
		</li>
		<li class="">
			<a href="<?php echo site_url('tickets');?>" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-ticket fa-4x"></i> <span>Tickets</span> </span> </a>
		</li>
	</ul>
</div>