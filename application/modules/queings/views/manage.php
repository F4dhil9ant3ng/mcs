<!-- Suggestion: populate this list with fetch and push technique -->

<ul class="dropdown-menu">
	<?php if($this->Queing->get_all($this->client_id)->num_rows() > 0) { ?>
		<?php $i = 1; ?>
		<?php foreach ($this->Queing->get_all($this->client_id)->result_array() as $items){ ?>
		<li> 
			<a href="<?php echo site_url('patients/encode/medications/'.$items['que_patient_id']);?>"><strong><?php echo $items['que_id'];?>.</strong> &nbsp; <?php echo $items['que_name']; ?></a> 
		</li>
		<?php $i++; ?>
		<?php } ?>
		
		<li class="divider"></li>
		<li>
			<a href="<?php echo site_url('queings/clear_all');?>" class="clear-all"><i class="fa fa-power-off"></i> Clear</a>
		</li>
	<?php }else{
		echo '<li><a href="javascript:;">No waiting patients.</a></li>';
	}?>
</ul>
<!-- end dropdown-menu-->
<script type="text/javascript">

	$('.clear-all').click(function(e) { 

		$.ajax({
			url: $(this).attr('href'),
			type: 'POST',
			success: function(response) {

				if(response)
				{
					
					mcs.init_smallBox("Success", response.message);
					$('.project-selector').trigger('click');
					
				}
				else
				{
					mcs.init_smallBox("error", response.message);
				} 

			}
		});
		e.preventDefault();
		
	});
</script>