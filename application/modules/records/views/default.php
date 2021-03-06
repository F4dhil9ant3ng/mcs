<!-- Bread crumb is created dynamically -->
<!-- row -->
<div class="row">

	<!-- col -->
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4"> 
		<h1 class="page-title txt-color-blueDark"><!-- PAGE HEADER --><?php echo $module ;?> <small></small></h1>
	</div>

	<!-- end col -->
<!-- 	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8 text-right">
		<div class="btn-group">
			
			<button type="button" class="btn btn-primary">Record</button>
			<button type="button" class="btn btn-primary">Delete</button>
			<button type="button" class="btn btn-primary">Update</button>
			
			
		</div>
	</div> -->
	<!-- right side of the page with the sparkline graphs -->
	<!-- col -->
	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
		
	</div>
	<!-- end col -->
</div>
<!-- end row -->

<!-- NEW WIDGET START -->
<article class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
	<!-- Widget ID (each widget will need unique ID)-->
	<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-colorbutton="true" data-widget-editbutton="false">
		<!-- widget options:
			usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
			
			data-widget-colorbutton="false"	
			data-widget-editbutton="false"
			data-widget-togglebutton="false"
			data-widget-deletebutton="false"
			data-widget-fullscreenbutton="false"
			data-widget-custombutton="false"
			data-widget-collapsed="true" 
			data-widget-sortable="false"
			
		-->
	<!-- 	<header>
			<h2><strong>Fixed</strong> <i>Height</i></h2>				
			
		</header> -->

		<!-- widget div-->
		<div>
			
			<!-- widget edit box -->
			<div class="jarviswidget-editbox">
				<!-- This area used as dropdown edit box -->
				<input class="form-control" type="text">
				<span class="note"><i class="fa fa-check text-success"></i> Change title to update and save instantly!</span>
				
			</div>
			<!-- end widget edit box -->
			
			<!-- widget content -->
			<div class="widget-body no-padding">
				<div class="widget-body-toolbar">
					
					<div class="row">
						
						<div class="col-xs-9 col-sm-5 col-md-5 col-lg-5">
							<!-- <div class="input-group">
								<span class="input-group-addon"><i class="fa fa-search"></i></span>
								<input class="form-control" id="prepend" placeholder="Filter" type="text">
							</div> -->
						</div>
						<div class="col-xs-3 col-sm-7 col-md-7 col-lg-7 text-right">

							<?php if(($this->admin_role_id != $this->role_id) ? $this->Role->has_permission('records', $this->role_id, 'create',  $this->client_id) : true) { ?>
								<a href="<?php echo site_url('records/view/-1/');?>" data-original-title="<?php echo $this->lang->line('__common_create_new');?>" class="preview btn btn-success btn-sm"><i class="fa fa-plus"></i>&nbsp;<span class="hidden-mobile"><?php echo $this->lang->line('__common_create');?></span></a>
								
							<?php } ?>
						</div>
						
					</div>
					
						

				</div>
				
				<div class="custom-scroll table-responsive">

					<ul id="recordsTab" class="nav nav-tabs bordered">
						<li class="active" id="default">
							<a href="#s1" data-toggle="tab" aria-expanded="true">Default <!-- <span class="badge bg-color-blue txt-color-white">12</span> --></a>
						</li>
						<li class="" id="custom">
							<a href="#" data-toggle="tab" aria-expanded="false">Custom</a>
						</li>
					</ul>
					<div id="recordsTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="#s1">
							<table class="table table-striped" id="table-records">
								<thead>
									<tr>
										<th>&nbsp;</th>
										<th>Name</th>
										<th>Description</th>
										<th>Type</th>
										<th>Created</th>
										<th>Status</th>
										<th class="text-right">&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
								
							</table>
						</div>
						
					</div>
				
					
				</div>	
					
			</div>
			<!-- end widget content -->
			
		</div>
		<!-- end widget div -->
		
	</div>
	<!-- end widget -->

</article>
<!-- WIDGET END -->
<script type="text/javascript">
	
	var can_view = 	'<?php echo ($this->admin_role_id != $this->role_id) ? $this->Role->has_permission('records', $this->role_id, 'view',   $this->client_id) : true; ?>';
	var can_update = '<?php echo ($this->admin_role_id != $this->role_id) ? $this->Role->has_permission('records', $this->role_id, 'update',   $this->client_id) : true; ?>';
	var can_delete = '<?php echo ($this->admin_role_id != $this->role_id) ? $this->Role->has_permission('records', $this->role_id, 'delete',   $this->client_id) : true; ?>';

    $('#recordsTab li a').on('click', function(e) {
		var _self = $(this);
		var val = _self.parent('li').attr('id');
		var title = _self.text();

		var url = BASE_URL+'records/'+val;
		history.pushState(null, null, url);
		checkURL();
		// change page title from global var
		document.title = (title || document.title);
		
		e.preventDefault();
		
	});

	pageSetUp();

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
	

	var pagefunction = function() {
		//console.log("cleared");
		
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
		
		load_datatable_ajax();
		
		function load_datatable_ajax(){
		/* BASIC ;*/
			var responsiveHelper_dt_basic = undefined;
			var responsiveHelper_datatable_fixed_column = undefined;
			var responsiveHelper_datatable_col_reorder = undefined;
			var responsiveHelper_datatable_tabletools = undefined;
			
			var breakpointDefinition = {
				tablet : 1024,
				phone : 480
			};
			
			$('#table-records').DataTable({
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
		            url: BASE_URL + 'records/load_ajax/',
		            type: 'POST',
		            data: {type : 'default'}
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
						responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#table-records'), breakpointDefinition);
					}

				},
				"rowCallback" : function(nRow) {
					responsiveHelper_dt_basic.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_dt_basic.respond();
	
					$('#table-records').find('td:last').css('width', '10%');
					$('#table-records').css('width', '100%');
					//$('<p>Test</p>').appendTo('.dt-toolbar > div:first-child');
					mcs.init_dialog();
					mcs.init_action();

					
					$("[rel=tooltip]").tooltip();
				},
		        //run on first time when datatable create
		        "initComplete": function () {
		        	$('.btn-status').on('click', function () {
						var _self = $(this);
						var _val = _self.attr('data-value');
						var _type = _self.attr('data-type');
						var _id = _self.attr('data-id');

						$.ajax({
			                url: BASE_URL+'/records/switch_status',
							type: 'post', 
							data: {
								status: _val,
								type: _type,
								id: _id
							},               
							dataType: 'json',
			                success: function (response)
			                {
			                    if(response)
								{
									if(_self.hasClass('btn-default') ){
										_self.text('Enabled');
										_self.attr('data-value', 1);
										_self.removeClass('btn-default').addClass('btn-primary');
									} else {
										_self.text('Disabled');
										_self.attr('data-value', 0);
										_self.removeClass('btn-primary').addClass('btn-default');
									}
								}
								else
								{
									mcs.init_smallBox("Error", 'Oooppps, something went wrong!');
								} 
			                }
			            });
					});
		        },
		        //End
		        // Internationalisation. For more info refer to http://datatables.net/manual/i18n
		        
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
		        // record_id, name, description, type, sort, status, created, license_key as license

		        aoColumns: [
		            {mData: 'record_id'},   
		            {mData: 'name'},   
		            {mData: 'type'},      
		            {mData: 'description'},
		            {mData: 'created'},
					{mData: null},
					{mData: 'slug'},
		        ],
		        "aoColumnDefs": [
		            {'bSearchable': false, 'aTargets': [0]},
					{'bSearchable': true, 'aTargets': [1]},
		            {
		                "targets": [0],
		                "visible": false,
		                "searchable": false,
		            },
		            
		            {
		                // The `data` parameter refers to the data for the cell (defined by the
		                // `data` option, which defaults to the column being worked with, in
		                // this case `data: 0`.
		                "render": function (data, type, row) {
		
							newData =  row['record_id'];
							
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
							
							if(can_view){
								newData = '<a rel="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('__common_details');?>" href="'+BASE_URL+'records/details/'+row['record_id']+'" class="preview link">'+row['name']+'</a>';
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
		                    
		                    newData  = row['description'];
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
		                    
		                    newData  = row['type'];
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

		                    newData = row['created'];
							
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
							var isActive = (row['status'] == 1) ? 'btn-primary active' :'btn-default';
							var hasValue = (row['status'] == 1) ? 0 : 1;
							var statusLabel = (row['status'] == 1) ? '<?php echo $this->lang->line('__common_enabled');?>' : '<?php echo $this->lang->line('__common_disabled');?>';

							newData = '<button class="btn btn-xs btn-status '+isActive+'" data-value="'+hasValue+'" data-type="default" data-id="'+row['record_id']+'" >'+ statusLabel +'</button>';
		                    
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
								newData = '<a rel="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('__common_delete');?>" href="'+BASE_URL+'records/delete_record/'+row['record_id']+'" class="direct"><i class="far fa-trash-alt fa-lg"></i></a>&nbsp;';
							}
							if(can_update){
								newData += '<a rel="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('__common_update');?>"  href="'+BASE_URL+'records/view/'+row['record_id']+'" class="preview"><i class="far fa-edit fa-lg"></i></a>&nbsp;';
							}
								newData += '<a rel="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('__common_add_fields');?>"  href="'+BASE_URL+'custom_fields/view/-1/records_'+row['slug']+'" class="preview"><i class="fas fa-book fa-lg"></i></a>';

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

		}	
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
