
	

<fieldset>
	<legend>Basic Information</legend>
	<div class="row">
		<section class="col col-5">
			<label for="first_name"><?php echo $this->lang->line('common_first_name');?></label>
			<label class="input">
			
				<input type="text" name="first_name" id="first_name" value="<?php echo set_value('first_name', $info->firstname);?>" placeholder="<?php echo $this->lang->line('common_first_name');?>" tabindex="5">

			</label>
		</section>
		<section class="col col-2">
			<label for="mi"><?php echo $this->lang->line('common_mi');?></label>
			<label class="input">
				
				<input type="text" name="mi" id="mi" value="<?php echo set_value('mi', $info->mi);?>" placeholder="<?php echo $this->lang->line('common_mi');?>" tabindex="6">
	
			</label>
		</section>
		<section class="col col-5">
			<label for="last_name"><?php echo $this->lang->line('common_last_name');?></label>
			<label class="input">
				
				<input type="text" name="last_name" id="last_name" value="<?php echo set_value('last_name', $info->lastname);?>" placeholder="<?php echo $this->lang->line('common_last_name');?>" tabindex="7">
	
			</label>
		</section>
	</div>
	<div class="row">
		<section class="col col-4">
			<label for="state"><?php echo $this->lang->line('common_mobile');?></label>
			<label class="input">
			
				<input type="text" name="mobile" id="mobile" value="<?php echo set_value('mobile', $info->mobile);?>" placeholder="<?php echo $this->lang->line('common_mobile');?>" tabindex="8">
	
				
			</label>
		</section>
		<section class="col col-4">
			<label for="gender"><?php echo $this->lang->line('__gender');?></label>
			<label class="select">
				
				<?php $gender = array(
					''=>'select',
					'1'=> $this->lang->line('__common_male'),
					'2'=> $this->lang->line('__common_female')
				);
				echo form_dropdown('gender',$gender, $info->gender,'tabindex="18" id="gender"'); ?>
				<i></i>

			</label>
		</section>
		<section class="col col-4">
			<label for="gender"><?php echo $this->lang->line('__birthdate');?></label>
			<label class="input"> 
				
				<i class="icon-append fa fa-calendar"></i>
					<input type="text" name="bod" id="bod" placeholder="<?php echo $this->lang->line('__birthdate');?>" tabindex="19" class="datepicker" value="<?php echo set_value('bod', $info->bDay.'/'.$info->bMonth.'/'.$info->bYear);?>" data-dateformat="dd/mm/yy" aria-invalid="false">
			
			</label>
		</section>
	</div>
	<div class="row">
		<section class="col col-6">
			<label for="country"><?php echo $this->lang->line('common_country');?></label>
			<label class="select"> 
				
				<?php echo form_dropdown('country', $this->location_lib->countries(), $info->country,'id="country"');?> 
				<i></i>
				
			</label>
		</section>
		<section class="col col-6">
			<label for="state"><?php echo $this->lang->line('common_state');?></label>
			<label class="select">
				
				<?php echo form_dropdown('state','', $info->state,'tabindex="11" id="state"'); ?>
				<i></i> 
				
			</label>
		</section>
	</div>
	<div class="row">
		<section class="col col-6">
			<label for="city"><?php echo $this->lang->line('common_city');?></label>
			<label class="select">
				
				<?php echo form_dropdown('city','', $info->city,'tabindex="12" id="city"'); ?>
				<i></i>
				
			</label>
		</section>
		<section class="col col-6">
			<label for="zip"><?php echo $this->lang->line('common_zip');?></label>
			<label class="input">
				
				<input type="text" name="zip" id="zip" value="<?php echo set_value('zipcode', $info->zip);?>" placeholder="<?php echo $this->lang->line('common_zip');?>" tabindex="13">
			
			</label>
		</section>
	</div>
	<section>
		<label for="address"><?php echo $this->lang->line('common_address');?></label>
		<label class="textarea">

			<textarea name="address" class="custom-scroll" id="address" placeholder="<?php echo $this->lang->line('common_address');?>" tabindex="15"><?php echo set_value('address', $info->address);?></textarea>
		
		</label>
	</section>
	<?php if ($info->id === '') { ?>
	
	<legend>Login Information</legend>
	<div class="alert alert-info">
		<p>Provide Access to their Records</p>
	</div>
	<div class="row">
		<section class="col col-4">
			<label for="username"><?php echo $this->lang->line('__username');?></label>
			<label class="input">
			
				<input type="text" name="username" id="username" value="<?php echo set_value('username', $info->username);?>" placeholder="<?php echo $this->lang->line('__username');?>" tabindex="16">

			</label>
		</section>
		<section class="col col-8">
			<label for="email"><?php echo $this->lang->line('__email');?></label>
			<label class="input">
				
				<input type="text" name="email" id="email" value="<?php echo set_value('email', $info->email);?>" placeholder="<?php echo $this->lang->line('__email');?>" tabindex="17">
	
			</label>
		</section>
	</div>
	<section>
		<label for="address"><?php echo $this->lang->line('__password');?></label>
		<label class="input">

			<input type="password" name="password" id="password" value="<?php echo set_value('password');?>" placeholder="<?php echo $this->lang->line('__password');?>" tabindex="18"> 
		
		</label>
	</section>	
<?php } ?>
	
	<section>
		<input type="checkbox" name="show_advance_form_input" id="show_advance_form_input" value="1" <?php if($option == 1) echo 'checked';?>>	
		<?php echo $this->lang->line('config_show_advance_form_input'); ?>
		<span id="show_advance_form_input_loader" class="pull-right"></span>
	</section>

</fieldset>