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
			<button type="button" data-original-title="<?php echo $this->lang->line('__common_create_new');?>" class="create btn btn-primary btn-sm"><i class="fa fa-plus"></i> <?php echo $this->lang->line('__common_create');?></button>
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
			<ul id="recordTab" class="nav nav-tabs bordered">
				<li class="active" id="main-record">
					<a href="#" data-toggle="tab" aria-expanded="true">Default <!-- <span class="badge bg-color-blue txt-color-white">12</span> --></a>
				</li>
				<li class="" id="custom-record">
					<a href="#" data-toggle="tab" aria-expanded="false">Custom</a>
				</li>
			</ul>
			<div id="recordTabContent" class="tab-content padding-10">
				<div class="tab-pane fade active in" id="#">
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

	<!-- end row -->

</section>
<!-- end widget grid -->

<script type="text/javascript">

	var can_view = 	'<?php echo ($this->admin_role_id != $this->role_id) ? $this->Role->has_permission('records', $this->role_id, 'view',   $this->client_id) : true; ?>';
	var can_update = '<?php echo ($this->admin_role_id != $this->role_id) ? $this->Role->has_permission('records', $this->role_id, 'update',   $this->client_id) : true; ?>';
	var can_delete = '<?php echo ($this->admin_role_id != $this->role_id) ? $this->Role->has_permission('records', $this->role_id, 'delete',   $this->client_id) : true; ?>';

	$(".create").click(function (e) {
		var title = $(this).attr('data-original-title');
		e.preventDefault();
			$.ajax({
				url: BASE_URL+'records/view/-1',
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
		var _type = $('#recordTab li.active').attr('id');
		load_datatable_ajax(_type);
		
		$('#recordTab li a').click(function (e) {
			var _type = $(this).parent('li').attr('id');
			load_datatable_ajax(_type)
		});

		function load_datatable_ajax(_type){
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
		            data: {type : _type}
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

					$("[rel=tooltip]").tooltip();
				},
		        //run on first time when datatable create
		        "initComplete": function () {
		        	
		    //     	this.api().columns().every( function () {
		    //             var column = this;
		    //             var select = $('<select><option value=""></option></select>')
		    //                 .appendTo( $(column.footer()).empty() )
		    //                 .on( 'change', function () {
		    //                     var val = $.fn.dataTable.util.escapeRegex(
		    //                         $(this).val()
		    //                     );
		 
		    //                     column
		    //                         .search( val ? '^'+val+'$' : '', true, false )
		    //                         .draw();
		    //                 } );
		 
		    //            column.data().unique().sort().each( function ( d, j ) {
						//     if(column.search() === '^'+d+'$'){
						//         select.append( '<option value="'+d+'" selected="selected">'+d+'</option>' )
						//     } else {
						//         select.append( '<option value="'+d+'">'+d+'</option>' )
						//     }
						// } );
		    //         } );
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
							if(_type == 'custom-record'){
								if(can_view){
		                    		newData = '<a rel="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('__common_details');?>" href="'+BASE_URL+'records/details/'+row['record_id']+'/'+row['client_id']+'" class="bootbox link">'+row['name']+'</a>';
								}
							}else{
								if(can_view){
									newData = '<a rel="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('__common_details');?>" href="'+BASE_URL+'records/details/'+row['record_id']+'" class="bootbox link">'+row['name']+'</a>';
								}
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
							if(row['status'] == 1){
								s = '<span class="label label-success"><?php echo $this->lang->line('__common_enabled');?></span>';
							}else{
								s = '<span class="label label-danger"><?php echo $this->lang->line('__common_disabled');?></span>';
							}
							
		                    newData  = s;
							
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

		                    if(_type == 'custom-record'){
								if(can_delete){
									newData += '<a rel="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('__common_delete');?>" href="'+BASE_URL+'records/delete_record/'+row['record_id']+'/'+row['client_id']+'" class="delete"><i class="far fa-trash-alt fa-lg"></i></a>&nbsp;';
								}
								if(can_update){
									newData += '<a rel="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('__common_update');?>"  href="'+BASE_URL+'records/view/'+row['record_id']+'/'+row['client_id']+'" class="bootbox"><i class="far fa-edit fa-lg"></i></a>&nbsp;';
								}
									newData += '<a rel="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('__common_add_fields');?>"  href="'+BASE_URL+'custom_fields/view/-1/records_'+row['slug']+'_'+row['client_id']+'" class="bootbox"><i class="fas fa-book fa-lg"></i></a>';
		                    }else{
		                    	// newData = '<a rel="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('__common_delete');?>" href="'+BASE_URL+'records/delete_record/'+row['record_id']+'" class="delete"><i class="far fa-trash-alt fa-lg"></i></a>&nbsp;';
								if(can_update){
									newData += '<a rel="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('__common_update');?>"  href="'+BASE_URL+'records/view/'+row['record_id']+'" class="bootbox"><i class="far fa-edit fa-lg"></i></a>&nbsp;';
								}
									newData += '<a rel="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('__common_add_fields');?>"  href="'+BASE_URL+'custom_fields/view/-1/records_'+row['slug']+'" class="bootbox"><i class="fas fa-book fa-lg"></i></a>';
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
