<style>
.content-error{
	color:red !important;
}
.chat-body ul li.message img {
    width: 50px;
    height: auto;
}
.editable.editable-click {
    color: #383838 !important;
    border-bottom: dashed 1px #383838;
}
.connections-list img, .followers-list img {
    width: 35px;
    height: auto;
}

.profile-pic>img {
	margin-top: 1em;
    top: unset;
    left: unset;
}
</style>
<!-- row -->
<div class="row">

	<!-- col -->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h1 class="page-title txt-color-blueDark"><!-- PAGE HEADER --><?php echo $module;?> </h1>
	</div>
	<!-- end col -->

</div>
<!-- end row -->

<div class="row">

	<div class="col-sm-12">


			<div class="well well-sm">

				<div class="row">

					<div class="col-sm-12 col-md-12 col-lg-6">
						<div class="well well-light well-sm no-margin no-padding">

							<div class="row">

								<div class="col-sm-12">

									<div class="row">
										<div class="col-sm-3 profile-pic">
											<?php if(!empty($info->avatar) || $info->avatar != '')
											{
												$img = base_url().'/uploads/'.$info->client_id.'/profile-picture/'.$info->avatar;
											}
											else
											{ 
												$img = base_url().'img/avatars/blank.png';
											} ?>
											
					
											<img src="<?php echo $img;?>" alt="Profile Picture" style="width:100px; height:100px;">
											<a href="<?php echo site_url('auth/upload_picture/'.$info->id);?>" data-original-title="Upload" class="bootbox"><i class="fa fa-pencil"></i></a>
											
											
										</div>
										
										<div class="col-sm-9">
											<h1>
											<a href="#" data-table="users_profiles" data-placement="top" data-url="<?php echo site_url('user/do_update');?>" data-name="firstname" class="editable xeditable_text" data-type="text" data-pk="<?php echo $info->id;?>" data-original-title="Enter Firstname"><?php echo $info->firstname;?></a>
												<span class="semi-bold">
													<a href="#" data-table="users_profiles" data-placement="top" data-url="<?php echo site_url('user/do_update');?>" data-name="lastname" class="editable xeditable_text" data-type="text" data-pk="<?php echo $info->id;?>" data-original-title="Enter Lastname"><?php echo $info->lastname;?></a>
												</span>
											<br>
											<small> 
											<a href="#" data-table="users" data-placement="top" data-url="<?php echo site_url('user/do_update');?>" data-name="username" class="editable xeditable_text" data-type="text" data-pk="<?php echo $info->id;?>" data-original-title="Enter Username"><?php echo $info->username;?></a>
											</small></h1>

											<ul class="list-unstyled">
												<li>
													<p class="text-muted">
														<i class="fa fa-mobile fa-fw"></i>&nbsp;&nbsp;<span class="txt-color-darken">
														<a href="#" data-table="users_profiles" data-placement="top" data-url="<?php echo site_url('user/do_update');?>" data-name="mobile" class="editable xeditable_text" data-type="text" data-pk="<?php echo $info->id;?>" data-original-title="Enter Mobile"><?php echo $info->mobile;?></a>
														</span>
													</p>
												</li>
												<li>
													<p class="text-muted">
														<i class="fa fa-envelope fa-fw"></i>&nbsp;&nbsp;
														<a href="#" data-table="users" data-placement="top" data-url="<?php echo site_url('user/do_update');?>" data-name="email" class="editable xeditable_text" data-type="text" data-pk="<?php echo $info->id;?>" data-original-title="Enter Email"><?php echo $info->email;?></a>
													</p>
												</li>
												<li>
													<p class="text-muted">
														<span class="txt-color-darken">
														<a href="#" data-table="users_profiles" data-placement="top" data-url="<?php echo site_url('user/do_update');?>" data-name="address" class="editable xeditable_textarea" data-type="textarea" data-pk="<?php echo $info->id;?>" data-original-title="Enter Address"><?php echo $info->address;?></a>
														<br/>
														<a href="#" data-table="users_profiles" data-placement="top" data-url="<?php echo site_url('user/do_update');?>" data-name="country" class="editable xeditable_select" data-type="select" data-pk="<?php echo $info->id;?>" data-original-title="Enter Country"><?php echo $this->location_lib->get_info($info->country)->name;?></a>
														<br/>
														<a href="#" data-table="users_profiles" data-placement="top" data-url="<?php echo site_url('user/do_update');?>" data-name="state" class="editable xeditable_select" data-type="select" data-pk="<?php echo $info->id;?>" data-original-title="Enter state"><?php echo $this->location_lib->get_info($info->state)->name;?></a>
														<br/>
														<a href="#" data-table="users_profiles" data-placement="top" data-url="<?php echo site_url('user/do_update');?>" data-name="city" class="editable xeditable_select" data-type="select" data-pk="<?php echo $info->id;?>" data-original-title="Enter City"><?php echo $this->location_lib->get_info( $info->city)->name;?></a>
														<br/>
														<a href="#" data-table="users_profiles" data-placement="top" data-url="<?php echo site_url('user/do_update');?>" data-name="zip" class="editable xeditable_text" data-type="text" data-pk="<?php echo $info->id;?>" data-original-title="Enter Zip"><?php echo $info->zip;?></a>
														</span>
													</p>
												</li>
												<li>
													<p class="text-muted">
														<i class="fa fa-crosshairs fa-fw"></i>&nbsp;&nbsp;<span class="txt-color-darken">
														<a href="#" data-table="users_profiles" data-placement="top" data-url="<?php echo site_url('user/do_update');?>" data-name="gender" class="editable xeditable_select" data-type="select" data-pk="<?php echo $info->id;?>" data-original-title="Enter Gender"><?php echo ($info->gender == 1) ? 'Male' : 'Female';?></a>
														</span>
													</p>
												</li>
												<li id="change_pass">
													<p class="text-muted">
														<i class="fa fa-key fa-fw"></i>&nbsp;&nbsp;<span class="txt-color-darken">
														<a href="<?php echo site_url('auth/change_password/');?>" class="bootbox" id="<?php echo $info->id;?>"><?php echo $this->lang->line('__change_password');?></a></span>
													</p>
												</li>
											</ul>
											

										</div>
										
									</div>

								</div>

							</div>

							

						</div>

					</div>
					<div class="col-sm-12 col-md-12 col-lg-6">

						<div class="row" id="activity-log">

							<div class="col-sm-12">

								<div class="padding-10">

									<ul class="nav nav-tabs tabs-pull-right">
										<li class="hidden">
											<a href="#a1" data-toggle="tab"><?php echo $this->lang->line('__recent_articles');?></a>
										</li>
										<li class="active">
											<a href="#a2" data-toggle="tab"><?php echo $this->lang->line('__new_patients');?></a>
										</li>
										<li class="pull-left">
											<span class="margin-top-10 display-inline"><i class="fa fa-rss text-success"></i> <?php echo $this->lang->line('__activity');?></span>
										</li>
									</ul>

									<div class="tab-content padding-top-10">
										<div class="tab-pane fade" id="a1">

											<div class="row">

												<div class="col-xs-2 col-sm-1">
													<time datetime="2014-09-20" class="icon">
														<strong>Jan</strong>
														<span>10</span>
													</time>
												</div>

												<div class="col-xs-10 col-sm-11">
													<h6 class="no-margin"><a href="javascript:void(0);">Allice in Wonderland</a></h6>
													<p>
														Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi Nam eget dui.
														Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
														sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel.
													</p>
												</div>

												<div class="col-sm-12">

													<hr>

												</div>

												<div class="col-xs-2 col-sm-1">
													<time datetime="2014-09-20" class="icon">
														<strong>Jan</strong>
														<span>10</span>
													</time>
												</div>

												<div class="col-xs-10 col-sm-11">
													<h6 class="no-margin"><a href="javascript:void(0);">World Report</a></h6>
													<p>
														Morning our be dry. Life also third land after first beginning to evening cattle created let subdue you'll winged don't Face firmament.
														You winged you're was Fruit divided signs lights i living cattle yielding over light life life sea, so deep.
														Abundantly given years bring were after. Greater you're meat beast creeping behold he unto She'd doesn't. Replenish brought kind gathering Meat.
													</p>
												</div>

												<div class="col-sm-12">

													<br>

												</div>

											</div>

										</div>
										<div class="tab-pane fade  in active" id="a2">
											
											<div class="alert alert-info fade in">
												<button class="close" data-dismiss="alert">
													×
												</button>
												<i class="fa-fw fa fa-info"></i>
												<strong id="result-count">0 </strong><?php echo $this->lang->line('__added_today');?>
											</div>

											<div id="result"></div>
										</div><!-- end tab -->
									
									</div>

								</div>

							</div>

						</div>
						<!-- end row -->
					</div>
				</div>

			</div>


	</div>

</div>

<script type="text/javascript">

	$("[rel=tooltip]").tooltip();
	/* DO NOT REMOVE : GLOBAL FUNCTIONS!
	 *
	 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
	 *
	 * // activate tooltips
	 * $("[rel=tooltip]").tooltip();
	 *
	 * // activate popovers
	 * $("[rel=popover]").popover();
	 *
	 * // activate popovers with hover states
	 * $("[rel=popover-hover]").popover({ trigger: "hover" });
	 *
	 * // activate inline charts
	 * runAllCharts();
	 *
	 * // setup widgets
	 * setup_widgets_desktop();
	 *
	 * // run form elements
	 * runAllForms();
	 *
	 ********************************
	 *
	 * pageSetUp() is needed whenever you load a page.
	 * It initializes and checks for all basic elements of the page
	 * and makes rendering easier.
	 *
	 */

	pageSetUp();
	
	/*
	 * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
	 * eg alert("my home function");
	 * 
	 * var pagefunction = function() {
	 *   ...
	 * }
	 * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
	 * 
	 * TO LOAD A SCRIPT:
	 * var pagefunction = function (){ 
	 *  loadScript(".../plugin.js", run_after_loaded);	
	 * }
	 * 
	 * OR
	 * 
	 * loadScript(".../plugin.js", run_after_loaded);
	 */

	// PAGE RELATED SCRIPTS

	// pagefunction
	
	var bootboxfunction = function() {

		$(".bootbox").click(function (e) {
			var href = $(this).attr('href');
			var title = $(this).text();
			e.preventDefault();
			$.ajax({
				url: href,
				onError: function () {
					bootbox.alert('Some network problem try again later.');
				},
				success: function (response)
				{
					var dialog = bootbox.dialog({
						title: title,
						message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>'
					});
					dialog.init(function(){
						setTimeout(function(){
							dialog.find('.bootbox-body').html(response);
						}, 3000);
					});
				}
			});
			return false;  
		});

	};
	
	// end pagefunction
	
	// run pagefunction on load

	loadScript(BASE_URL+"js/bootbox.min.js", bootboxfunction);
	
	patients();
	
	function patients(){
		$.ajax({
			url: BASE_URL+'patients/load_ajax/',
			type: 'post', 
			data: {
				filter: '<?php echo date('Y-m-d');?>'
			},               
			dataType: 'json',
			success: function (response) {
				
				var items = [];
				$.each(response.data, function(index, val) {
					
					if(val.avatar){
						picture =  '<img src="'+BASE_URL+'uploads/'+client_id+'/profile-picture/'+val.avatar+'" alt="'+val.username+'" class="online" />';
					}else{
						picture =  '<img src="'+BASE_URL+'img/avatars/blank.png" alt="'+val.username+'" class="online" />';
					}
						
					item =	'<div class="user" title="'+val.email+'">'+
								picture+'<a href="javascript:void(0);">'+val.fullname+'</a>'+
								'<div class="email">'+val.email+'</div>'+
							'</div>';	

					items.push(item);
				});

				$('#result-count').html(response.recordsTotal +' new patients ');
				$('#result').append(items);

			}
		});
	}
	
	action_check();
	
	function action_check(){
		var info_id = '<?php echo $info->id;?>';
 
		//remove xeditable
		$('.editable').each(function( index ) {
			var ID = $(this).attr('data-pk');
			if(user_id != ID){
				if($(this).hasClass('xeditable_text')){
					$(this).removeClass('xeditable_text');
				}
				if($(this).hasClass('xeditable_select')){
					$(this).removeClass('xeditable_select');
				}
				if($(this).hasClass('xeditable_textarea')){
					$(this).removeClass('xeditable_textarea');
				}
			}
		});
		//xeditable
		$('.bootbox').each(function( index ) {

			if(user_id != info_id){
				$(this).hide();
				$('#change_pass').hide();
				$('.editable').attr('href','javascript:;');
				$('#activity-log').hide();
			}
		});

	}
			
	/*
	 * X-Ediable
	 */

	loadScript(BASE_URL+"js/plugin/x-editable/moment.min.js", loadMockJax);

	function loadMockJax() {
		loadScript(BASE_URL+"js/plugin/x-editable/jquery.mockjax.min.js", loadXeditable);
	}

	function loadXeditable() {
		loadScript(BASE_URL+"js/plugin/x-editable/x-editable.min.js", loadTypeHead);
	}

	function loadTypeHead() {
		loadScript(BASE_URL+"js/plugin/typeahead/typeahead.min.js", loadTypeaheadjs);
	}

	function loadTypeaheadjs() {
		loadScript(BASE_URL+"js/plugin/typeahead/typeaheadjs.min.js", runXEditDemo);
	}

	function runXEditDemo() {

		/*
		 * X-EDITABLES
		 */

		//defaults
		$.fn.editable.defaults.url = '/post';
		//$.fn.editable.defaults.mode = 'inline'; use this to edit inline

		$('.xeditable_text').each(function () {
			var obj = $(this);
			var type = obj.attr('data-name');
			obj.editable({
				emptytext: '--',
				validate: function (value) {
					if ($.trim(value) == '')
						return type+' field is required';
				},
				success: function(response) {
					console.log(response);
				} ,
				params: function(params) {  //params already contain `name`, `value` and `pk`
					var data = {};
					data['pk'] = params.pk;
					data['name'] = params.name;
					data['value'] = params.value;
					data['table'] = $(this).attr('data-table');
					return data;
					
				} 
			});
			
		});
		
		$('.xeditable_textarea').each(function () {
			var obj = $(this);
			var type = obj.attr('data-name');
			obj.editable({
				emptytext: '--',
				validate: function (value) {
					if ($.trim(value) == '')
						return type+' field is required';
				},
				success: function(response) {
					console.log(response);
				} ,
				params: function(params) {  //params already contain `name`, `value` and `pk`
					var data = {};
					data['pk'] = params.pk;
					data['name'] = params.name;
					data['value'] = params.value;
					data['table'] = $(this).attr('data-table');
					return data;
					
				} 
			});
			
		});
		
		$('.xeditable_select').each(function () {
			var obj = $(this);
			var type = obj.attr('data-name');
			var val = obj.attr('data-value');
			var source_data = [];
			if(type === 'country'){
				source_data = '<?php echo json_encode($this->location_lib->populate_countries()->result_array(), JSON_HEX_APOS);?>';
			}else if(type === 'state'){
				source_data = '<?php echo json_encode($this->location_lib->populate_states($info->country)->result_array(), JSON_HEX_APOS);?>';
			}else if(type === 'city') {
				source_data = '<?php echo json_encode($this->location_lib->populate_states($info->state)->result_array(), JSON_HEX_APOS);?>';
			}else{
				source_data = [{value: 1,text: 'Male'}, {value: 2,text: 'Female'}]
			}

			obj.editable({
				source: source_data,
				validate: function (value) {
					if ($.trim(value) == '')
						return type+' field is required';
				},
				value: val,
				emptytext: '--',
				params: function(params) {  //params already contain `name`, `value` and `pk`
					var data = {};
					data['pk'] = params.pk;
					data['name'] = params.name;
					data['value'] = params.value;
					data['table'] = $(this).attr('data-table');
					return data;
				},
				success: function(response) {
					console.log(response);
					checkURL();
				}
			});
			
		});

		
	}
		
</script>
