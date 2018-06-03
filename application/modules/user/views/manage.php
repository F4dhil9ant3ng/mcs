<!-- Bread crumb is created dynamically -->
<!-- row -->
<div class="row">

	<!-- col -->
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4"> 
		<h1 class="page-title txt-color-blueDark"><!-- PAGE HEADER --><?php echo $module ;?> <small><?php //echo $this->lang->line('module_patients_desc');?></small></h1>
	</div>
	<!-- end col -->
	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8 text-right">
		<div class="btn-group">
			<!--
			<button type="button" class="btn btn-primary">Record</button>
			<button type="button" class="btn btn-primary">Delete</button>
			<button type="button" class="btn btn-primary">Update</button>
			-->
			<?php if(($this->admin_role_id != $this->role_id) ? $this->Role->has_permission('users', $this->role_id, 'create',  $this->client_id) : true) { ?>
				<button type="button" data-original-title="<?php echo $this->lang->line('__common_create_new');?>" class="create btn btn-primary btn-sm"><i class="fa fa-plus"></i> <?php echo $this->lang->line('__common_create');?></button>
			<?php } ?>
		</div>
	</div>
</div>
<!-- end row -->

<!--
The ID "widget-grid" will start to initialize all widgets below
You do not need to use widgets if you dont want to. Simply remove
the <section></section> and you can use wells or panels instead
-->

<!-- widget grid -->
<section id="widget-grid" class="">


	<div class="row">
	
		<div class="col-sm-12 col-lg-12">

			<table class="table table-striped table-forum" id="table-patients">
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th><?php echo $this->lang->line('common_fullname');?></th>
						<th><?php echo $this->lang->line('common_username');?></th>
						<th><?php echo $this->lang->line('common_email');?></th>
						<th>Role</th>
						<th><?php echo $this->lang->line('common_contacts');?></th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		
			
		</div>
		
	</div>

	<!-- end row -->

</section>
<!-- end widget grid -->

<script type="text/javascript">

	var can_view = 	'<?php echo ($this->admin_role_id != $this->role_id) ? $this->Role->has_permission('users', $this->role_id, 'view',   $this->client_id) : true; ?>';
	var can_update = '<?php echo ($this->admin_role_id != $this->role_id) ? $this->Role->has_permission('users', $this->role_id, 'update',   $this->client_id) : true; ?>';
	var can_delete = '<?php echo ($this->admin_role_id != $this->role_id) ? $this->Role->has_permission('users', $this->role_id, 'delete',   $this->client_id) : true; ?>';
	
	$(".create").click(function (e) {
		var title = $(this).attr('data-original-title');
		e.preventDefault();
			$.ajax({
				url: BASE_URL+'user/view/-1',
				onError: function () {
					bootbox.alert('<?php echo $this->lang->line('__bootbox_error');?>');
				},
				success: function (response)
				{
					var dialog = bootbox.dialog({
						title: title,
						message: '<p class="text-center"><img src="'+BASE_URL+'img/ajax-loader.gif"/></p>'
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

	pageSetUp();

	$('input[type=radio]').on('change', function(e) {
		var val = $("input[name='option']:checked").val();
		var url = '<?php echo site_url();?>course/'+val;
		history.pushState(null, null, url);
		checkURL();

		var title = $("input[name='option']:checked").parent().text();

		// change page title from global var
		document.title = (title || document.title);
		
		e.preventDefault();
		
	});
	
	// pagefunction

	var pagefunction = function() {
		// clears the variable if left blank
		
	};

	// end pagefunction

	var pagedestroy = function() {

		/*
		 Example below:

		 $("#calednar").fullCalendar( 'destroy' );
		 if (debugState){
		 root.console.log("✔ Calendar destroyed");
		 }

		 For common instances, such as Jarviswidgets, Google maps, and Datatables, are automatically destroyed through the app.js loadURL mechanic

		 */
	}
	// end destroy

	// run pagefunction
	var user_link = '<?php echo site_url('settings/encryptID/');?>';
	
	var pagefunction = function() {
		//console.log("cleared");
		var module = '<?php echo $module;?>';
		/* // DOM Position key index //
		
			l - Length changing (dropdown)
			f - Filtering input (search)
			t - The Table! (datatable)
			i - Information (records)
			p - Pagination (paging)
			r - pRocessing 
			< and > - div elements
			<"#id" and > - div with an id
			<"class" and > - div with a class
			<"#id.class" and > - div with an id and class
			
			Also see: http://legacy.datatables.net/usage/features
		*/	

		/* BASIC ;*/
			var responsiveHelper_dt_basic = undefined;
			var responsiveHelper_datatable_fixed_column = undefined;
			var responsiveHelper_datatable_col_reorder = undefined;
			var responsiveHelper_datatable_tabletools = undefined;
			
			var breakpointDefinition = {
				tablet : 1024,
				phone : 480
			};
			
			$('#table-patients').dataTable({
				'destroy': true,
		        'filter': true,
		        'processing': true, 
		        "serverSide": true,        
		        "paging": true,
				"bSort" : false,
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
		        "ajax": {
		            url: BASE_URL + 'user/load_ajax/',
		            type: 'POST',
		            data: {
		                filter: 0
		            }
		        },
				"oLanguage": {
					"sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>',
					"sProcessing": '<i class="fa fa-spinner fa-pulse fa-fw"></i> <?php echo $this->lang->line('__dt_sLoadingRecords');?>', //add a loading image,simply putting <img src="/img/ajax-loader.gif" /> tag.
					"sInfo": '<?php echo $this->lang->line('__dt_sInfo');?>',
					"sEmptyTable": '<?php echo $this->lang->line('__dt_sEmptyTable');?>',
					"sInfoEmpty": '<?php echo $this->lang->line('__dt_sInfoEmpty');?>',
					"sInfoFiltered": '<?php echo $this->lang->line('__dt_sInfoFiltered');?>',
					"sLengthMenu": '<?php echo $this->lang->line('__dt_sLengthMenu');?>',
					"sLoadingRecords": '<?php echo $this->lang->line('__dt_sLoadingRecords');?>',
					"sProcessing": '<?php echo $this->lang->line('__dt_sProcessing');?>',
					"sZeroRecords": '<?php echo $this->lang->line('__dt_sZeroRecords');?>'
				},	
				"autoWidth" : true,
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_basic) {
						responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#table-patients'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_dt_basic.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_dt_basic.respond();
					$('#table-patients').find('td:first').css('width', '10px');
					$('#table-patients').css('width', '100%');
					
					$(".bootbox").click(function (e) {
						var title = $(this).attr('data-original-title');
					   	e.preventDefault();
					   	$.ajax({
			                url: $(this).attr('href'),
			                onError: function () {
			                    bootbox.alert('<?php echo $this->lang->line('__bootbox_error');?>');
			                },
			                success: function (response)
			                {
			                    var dialog = bootbox.dialog({
								    title: title,
								    message: '<p class="text-center"><img src="'+BASE_URL+'img/ajax-loader.gif"/></p>'
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

					$(".delete").click(function (e) {
					   	e.preventDefault();
					   	$.ajax({
			                url: $(this).attr('href'),
			                success: function (response)
			                {
			                    if(response)
								{
									$.smallBox({
										title : "Success",
										content : response.message,
										color : "#739E73",
										iconSmall : "fa fa-check",
										timeout : 3000
									});
									
									checkURL();
								}
								else
								{
									$.smallBox({
										title : "Error",
										content : response.message,
										color : "#C46A69",
										iconSmall : "fa fa-warning shake animated",
										timeout : 3000
									});
								} 
			                }
			            });
					});
					
					$(".reset").click(function (e) {
					   	e.preventDefault();
					   	$.ajax({
			                url: $(this).attr('href'),
			                success: function (response)
			                {
			                    if(response)
								{
									$.smallBox({
										title : "Success",
										content : response.message,
										color : "#739E73",
										iconSmall : "fa fa-check",
										timeout : 3000
									});
									
									checkURL();
								}
								else
								{
									$.smallBox({
										title : "Error",
										content : response.message,
										color : "#C46A69",
										iconSmall : "fa fa-warning shake animated",
										timeout : 3000
									});
								} 
			                }
			            });
					});
					
					$("[rel=tooltip]").tooltip();
				},
		        //run on first time when datatable create
		        "initComplete": function () {

		        },
		        //End
		        "order": [
		            [0, 'asc']
		        ],
		        "aLengthMenu": [
		            [10, 20, 30, 40, 50],
		            [10, 20, 30, 40, 50] // change per page values here
		        ],
		        // set the initial value
		        "pageLength": 10,
		        //{"id":"2","username":"Randy","email":"rebucasrandy1986@gmail.com","rolename":"Administrator","created":"February 08, 2017","fullname":"Randy, Rebucas"}
		        aoColumns: [
		            {mData: 'id'},   
		            {mData: 'fullname'},         
		            {mData: 'username'},
					{mData: 'email'},
					{mData: 'role_name'},
		            {mData: 'created'},
		            {mData: 'avatar'},
					{mData: 'birthday'},
					{mData: 'mobile'},
					{mData: 'lic'},
					{mData: null},
					{mData: null},
		        ],
		        "aoColumnDefs": [
					{'bSearchable': true, 'aTargets': [0, 1, 2, 3, 8, 9]},
		            {
		                "targets": [7,8,9,10,11],
		                "visible": false,
		                "searchable": false,
		            },
		            
		            {
		                // The `data` parameter refers to the data for the cell (defined by the
		                // `data` option, which defaults to the column being worked with, in
		                // this case `data: 0`.
		                 "render": function (data, type, row) {
							if(row['avatar']){
								newData =  '<img src="'+BASE_URL+'uploads/'+row['lic']+'/profile-picture/'+row['avatar']+'" alt="'+row['username']+'" class="img-responsive" />';
							}else{
								newData =  '<img src="<?php echo $this->gravatar->get("'+row['email']+'", 25);?>" />';
							}
							return newData;
		                },
		                "targets": 0
		            },
		            {
		                // The `data` parameter refers to the data for the cell (defined by the
		                // `data` option, which defaults to the column being worked with, in
		                // this case `data: 1`.
		                //row['statuses'] != 0
		                "render": function (data, type, row) {
		                    newData = "";
							if(can_view){
								newData += '<a rel="tooltip" data-placement="top" data-original-title="<?php echo $this->lang->line('__common_details');?>" href="'+user_link+'/'+row['id']+'">'+ row['fullname'] + '</a>';
							}else{
								newData += row['fullname']
							}
							
		                    return newData;

		                },
		                "targets": 1
		            },
		            {
		                // The `data` parameter refers to the data for the cell (defined by the
		                // `data` option, which defaults to the column being worked with, in
		                // this case `data: 1`.
		                //row['statuses'] != 0
		                "render": function (data, type, row) {
		                    newData = "";
		                   
		                    newData  = row['username'];
		                    return newData;

		                },
		                "targets": 2
		            },
		            {
		                // The `data` parameter refers to the data for the cell (defined by the
		                // `data` option, which defaults to the column being worked with, in
		                // this case `data: 1`.
		                //row['statuses'] != 0
		                "render": function (data, type, row) {
		                    newData = "";
		                   
							newData  = '<a href="mailto:'+row['email']+'">'+row['email']+'</a>';
		                    return newData;

		                },
		                "targets": 3
		            },
					{
		                // The `data` parameter refers to the data for the cell (defined by the
		                // `data` option, which defaults to the column being worked with, in
		                // this case `data: 1`.
		                //row['statuses'] != 0
		                "render": function (data, type, row) {
		                    newData = "";
		                   
		                    newData  = row['role_name'];
		                    return newData;

		                },
		                "targets": 4
		            },
		            {
		                // The `data` parameter refers to the data for the cell (defined by the
		                // `data` option, which defaults to the column being worked with, in
		                // this case `data: 1`.
		                //row['statuses'] != 0
		                "render": function (data, type, row) {
		                    newData = "";

							if(row['mobile']){
								mobile = row['mobile'];
							}else{
								mobile = '--';
							}
							
		                    newData = mobile;

		                    return newData;

		                },
		                "targets": 5
		            },
		            {
		                // The `data` parameter refers to the data for the cell (defined by the
		                // `data` option, which defaults to the column being worked with, in
		                // this case `data: 4`.
		                "render": function (data, type, row) {
		                    newData = "";
							if(can_delete){
								newData += '<a rel="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('__common_delete');?>" href="'+BASE_URL+'user/delete/'+row['id']+'" class="delete"><i class="far fa-trash-alt fa-lg"></i></a>&nbsp;';
							}
							if(can_update){		
								newData += '<a rel="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('__common_update');?>"  href="'+BASE_URL+'user/view/'+row['id']+'" class="bootbox"><i class="far fa-edit fa-lg"></i></a>&nbsp;';
							}	
							return newData;
		                },
		                "targets": 6
		            },
		        ],
		        "createdRow": function (row, data, index)
		        {
		            //var temp_split = data['temp_rad'].split(':rad:');
		           
		        }
		    
			});

		/* END BASIC */
		
	};

	loadScript(BASE_URL+"js/bootbox.min.js", function(){
		loadScript(BASE_URL+"js/plugin/datatables/jquery.dataTables.min.js", function(){
			loadScript(BASE_URL+"js/plugin/datatables/dataTables.bootstrap.min.js", function(){
				loadScript(BASE_URL+"js/plugin/datatable-responsive/datatables.responsive.min.js", pagefunction)
			});
		});
	});
		
</script>
