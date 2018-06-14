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
</style>
<!-- Bread crumb is created dynamically -->
<!-- row -->
<div class="row">

	<!-- col -->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h1 class="page-title txt-color-blueDark">
			<?php echo sprintf($this->lang->line(strtolower($module).'_welcome'), $user_info->username);?> 
		</h1>
	</div>
	<!-- end col -->

</div>
<!-- end row -->

<!--
The ID "widget-grid" will start to initialize all widgets below
You do not need to use widgets if you dont want to. Simply remove
the <section></section> and you can use wells or panels instead
-->
<div class="row">
	<div class="col-sm-12">
		<!-- new widget -->
		<div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
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
			<header>
				<span class="widget-icon"> <i class="glyphicon glyphicon-stats txt-color-darken"></i> </span>
				<h2>Live Feeds </h2>

				<ul class="nav nav-tabs pull-right in" id="myTab">
					<li class="active">
						<a data-toggle="tab" href="#s1"><i class="fa fa-clock-o"></i> <span class="hidden-mobile hidden-tablet">Live Stats</span></a>
					</li>

					<li>
						<a data-toggle="tab" href="#s2"><i class="fa fa-users"></i> <span class="hidden-mobile hidden-tablet">Encounters</span></a>
					</li>

					<li>
						<a data-toggle="tab" href="#s3">₱ <span class="hidden-mobile hidden-tablet">Revenue</span></a>
					</li>
				</ul>

			</header>

			<!-- widget div-->
			<div class="no-padding">
				<!-- widget edit box -->
				<div class="jarviswidget-editbox">

					test
				</div>
				<!-- end widget edit box -->

				<div class="widget-body">
					<!-- content -->
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in padding-10 no-padding-bottom" id="s1">
							<div class="row no-space">
								<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
									<span class="demo-liveupdate-1"> <span class="onoffswitch-title">Live switch</span> <span class="onoffswitch">
											<input type="checkbox" name="start_interval" class="onoffswitch-checkbox" id="start_interval">
											<label class="onoffswitch-label" for="start_interval"> 
												<span class="onoffswitch-inner" data-swchon-text="ON" data-swchoff-text="OFF"></span> 
												<span class="onoffswitch-switch"></span> </label> </span> </span>
									<div id="updating-chart" class="chart-large txt-color-blue"></div>

								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 show-stats">

									<div class="row">
										<div class="col-xs-6 col-sm-6 col-md-12 col-lg-12"> <span class="text"> My Tasks <span class="pull-right">130/200</span> </span>
											<div class="progress">
												<div class="progress-bar bg-color-blueDark" style="width: 65%;"></div>
											</div> </div>
										<div class="col-xs-6 col-sm-6 col-md-12 col-lg-12"> <span class="text"> Transfered <span class="pull-right">440 GB</span> </span>
											<div class="progress">
												<div class="progress-bar bg-color-blue" style="width: 34%;"></div>
											</div> </div>
										<div class="col-xs-6 col-sm-6 col-md-12 col-lg-12"> <span class="text"> SMS<span class="pull-right">3/200</span> </span>
											<div class="progress">
												<div class="progress-bar bg-color-blue" style="width: 3%;"></div>
											</div> </div>
										<div class="col-xs-6 col-sm-6 col-md-12 col-lg-12"> <span class="text"> Patients Inn <span class="pull-right">97%</span> </span>
											<div class="progress">
												<div class="progress-bar bg-color-greenLight" style="width: 84%;"></div>
											</div> </div>
										<div class="col-xs-6 col-sm-6 col-md-12 col-lg-12"> <span class="text"> Patients Canceled <span class="pull-right">3%</span> </span>
											<div class="progress">
												<div class="progress-bar bg-color-red" style="width: 3%;"></div>
											</div> </div>
									</div>

								</div>
							</div>

							<div class="show-stat-microcharts">
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

									<div class="easy-pie-chart txt-color-orangeDark" data-percent="33" data-pie-size="50">
										<span class="percent percent-sign">35</span>
									</div>
									<span class="easy-pie-title"> Users <i class="fa fa-caret-up icon-color-bad"></i> </span>
									<ul class="smaller-stat hidden-sm pull-right">
										<li>
											<span class="label bg-color-greenLight"><i class="fa fa-caret-up"></i> 97%</span>
										</li>
										<li>
											<span class="label bg-color-blueLight"><i class="fa fa-caret-down"></i> 44%</span>
										</li>
									</ul>
									<div class="sparkline txt-color-greenLight hidden-sm hidden-md pull-right" data-sparkline-type="line" data-sparkline-height="33px" data-sparkline-width="70px" data-fill-color="transparent">
										130, 187, 250, 257, 200, 210, 300, 270, 363, 247, 270, 363, 247
									</div>
								</div>
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<div class="easy-pie-chart txt-color-greenLight" data-percent="78.9" data-pie-size="50">
										<span class="percent percent-sign">78.9 </span>
									</div>
									<span class="easy-pie-title"> Patients <i class="fa fa-caret-down icon-color-good"></i></span>
									<ul class="smaller-stat hidden-sm pull-right">
										<li>
											<span class="label bg-color-blueDark"><i class="fa fa-caret-up"></i> 76%</span>
										</li>
										<li>
											<span class="label bg-color-blue"><i class="fa fa-caret-down"></i> 3%</span>
										</li>
									</ul>
									<div class="sparkline txt-color-blue hidden-sm hidden-md pull-right" data-sparkline-type="line" data-sparkline-height="33px" data-sparkline-width="70px" data-fill-color="transparent">
										257, 200, 210, 300, 270, 363, 130, 187, 250, 247, 270, 363, 247
									</div>
								</div>
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<div class="easy-pie-chart txt-color-blue" data-percent="23" data-pie-size="50">
										<span class="percent percent-sign">23 </span>
									</div>
									<span class="easy-pie-title"> Encounters <i class="fa fa-caret-up icon-color-good"></i></span>
									<ul class="smaller-stat hidden-sm pull-right">
										<li>
											<span class="label bg-color-darken">10GB</span>
										</li>
										<li>
											<span class="label bg-color-blueDark"><i class="fa fa-caret-up"></i> 10%</span>
										</li>
									</ul>
									<div class="sparkline txt-color-darken hidden-sm hidden-md pull-right" data-sparkline-type="line" data-sparkline-height="33px" data-sparkline-width="70px" data-fill-color="transparent">
										200, 210, 363, 247, 300, 270, 130, 187, 250, 257, 363, 247, 270
									</div>
								</div>
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<div class="easy-pie-chart txt-color-darken" data-percent="36" data-pie-size="50">
										<span class="percent degree-sign">36 <i class="fa fa-caret-up"></i></span>
									</div>
									<span class="easy-pie-title"> Graph <i class="fa fa-caret-down icon-color-good"></i></span>
									<ul class="smaller-stat hidden-sm pull-right">
										<li>
											<span class="label bg-color-red"><i class="fa fa-caret-up"></i> 124</span>
										</li>
										<li>
											<span class="label bg-color-blue"><i class="fa fa-caret-down"></i> 40 F</span>
										</li>
									</ul>
									<div class="sparkline txt-color-red hidden-sm hidden-md pull-right" data-sparkline-type="line" data-sparkline-height="33px" data-sparkline-width="70px" data-fill-color="transparent">
										2700, 3631, 2471, 2700, 3631, 2471, 1300, 1877, 2500, 2577, 2000, 2100, 3000
									</div>
								</div>
							</div>

						</div>
						<!-- end s1 tab pane -->

						<div class="tab-pane fade" id="s2">
							<div class="widget-body-toolbar bg-color-white">

								<form class="form-inline" role="form">

									<div class="form-group">
										<label class="sr-only" for="s123">Show From</label>
										<input type="email" class="form-control input-sm" id="s123" placeholder="Show From">
									</div>
									<div class="form-group">
										<input type="email" class="form-control input-sm" id="s124" placeholder="To">
									</div>

									<div class="btn-group hidden-phone pull-right">
										<a class="btn dropdown-toggle btn-xs btn-default" data-toggle="dropdown"><i class="fa fa-cog"></i> More <span class="caret"> </span> </a>
										<ul class="dropdown-menu pull-right">
											<li>
												<a href="javascript:void(0);"><i class="fa fa-file-text-alt"></i> Export to PDF</a>
											</li>
											<li>
												<a href="javascript:void(0);"><i class="fa fa-question-sign"></i> Help</a>
											</li>
										</ul>
									</div>

								</form>

							</div>
							<div class="padding-10">
								<div id="statsChart" class="chart-large has-legend-unique"></div>
							</div>

						</div>
						<!-- end s2 tab pane -->

						<div class="tab-pane fade" id="s3">

							<div class="widget-body-toolbar bg-color-white smart-form" id="rev-toggles">

								<div class="inline-group">

									<label for="gra-0" class="checkbox">
										<input type="checkbox" name="gra-0" id="gra-0" checked="checked">
										<i></i> Target </label>
									<label for="gra-1" class="checkbox">
										<input type="checkbox" name="gra-1" id="gra-1" checked="checked">
										<i></i> Actual </label>
									<label for="gra-2" class="checkbox">
										<input type="checkbox" name="gra-2" id="gra-2" checked="checked">
										<i></i> Signups </label>
								</div>

								<div class="btn-group hidden-phone pull-right">
									<a class="btn dropdown-toggle btn-xs btn-default" data-toggle="dropdown"><i class="fa fa-cog"></i> More <span class="caret"> </span> </a>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="javascript:void(0);"><i class="fa fa-file-text-alt"></i> Export to PDF</a>
										</li>
										<li>
											<a href="javascript:void(0);"><i class="fa fa-question-sign"></i> Help</a>
										</li>
									</ul>
								</div>

							</div>

							<div class="padding-10">
								<div id="flotcontainer" class="chart-large has-legend-unique"></div>
							</div>
						</div>
						<!-- end s3 tab pane -->
					</div>

					<!-- end content -->
				</div>

			</div>
			<!-- end widget div -->
		</div>
		<!-- end widget -->

	</div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-6 col-lg-6">

		<!-- new widget -->
		<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-colorbutton="false">

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
			<header>
				<span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
				<h2> My Events </h2>
				<div class="widget-toolbar">
					<!-- add: non-hidden - to disable auto hide -->
					<div class="btn-group">
						<button class="btn dropdown-toggle btn-xs btn-default" data-toggle="dropdown">
							Showing <i class="fa fa-caret-down"></i>
						</button>
						<ul class="dropdown-menu js-status-update pull-right">
							<li>
								<a href="javascript:void(0);" id="mt">Month</a>
							</li>
							<li>
								<a href="javascript:void(0);" id="ag">Agenda</a>
							</li>
							<li>
								<a href="javascript:void(0);" id="td">Today</a>
							</li>
						</ul>
					</div>
				</div>
			</header>

			<!-- widget div-->
			<div>
				<!-- widget edit box -->
				<div class="jarviswidget-editbox">

					<input class="form-control" type="text">

				</div>
				<!-- end widget edit box -->

				<div class="widget-body no-padding">
					<!-- content goes here -->
					<div class="widget-body-toolbar">

						<div id="calendar-buttons">

							<div class="btn-group">
								<a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-prev"><i class="fa fa-chevron-left"></i></a>
								<a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-next"><i class="fa fa-chevron-right"></i></a>
							</div>
						</div>
					</div>
					<div id="calendar"></div>

					<!-- end content -->
				</div>

			</div>
			<!-- end widget div -->
		</div>
		<!-- end widget -->

	</div>

	<div class="col-sm-12 col-md-6 col-lg-6">

		<!-- new widget -->
		<div class="jarviswidget jarviswidget-color-blue" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false">

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

			<header>
				<span class="widget-icon"> <i class="fa fa-check txt-color-white"></i> </span>
				<h2> ToDo's </h2>
				<!-- <div class="widget-toolbar">
				add: non-hidden - to disable auto hide

				</div>-->
			</header>

			<!-- widget div-->
			<div>
				<!-- widget edit box -->
				<div class="jarviswidget-editbox">
					<div>
						<label>Title:</label>
						<input type="text" />
					</div>
				</div>
				<!-- end widget edit box -->

				<div class="widget-body no-padding smart-form">
					<!-- content goes here -->
					<h5 class="todo-group-title"><i class="fa fa-warning"></i> Critical Tasks (<small class="num-of-tasks">1</small>)</h5>
					<ul id="sortable1" class="todo">
						<li>
							<span class="handle"> <label class="checkbox">
									<input type="checkbox" name="checkbox-inline">
									<i></i> </label> </span>
							<p>
								<strong>Ticket #17643</strong> - Hotfix for WebApp interface issue [<a href="javascript:void(0);" class="font-xs">More Details</a>] <span class="text-muted">Sea deep blessed bearing under darkness from God air living isn't. </span>
								<span class="date">Jan 1, 2014</span>
							</p>
						</li>
					</ul>
					<h5 class="todo-group-title"><i class="fa fa-exclamation"></i> Important Tasks (<small class="num-of-tasks">3</small>)</h5>
					<ul id="sortable2" class="todo">
						<li>
							<span class="handle"> <label class="checkbox">
									<input type="checkbox" name="checkbox-inline">
									<i></i> </label> </span>
							<p>
								<strong>Ticket #1347</strong> - Inbox email is being sent twice <small>(bug fix)</small> [<a href="javascript:void(0);" class="font-xs">More Details</a>] <span class="date">Nov 22, 2013</span>
							</p>
						</li>
						<li>
							<span class="handle"> <label class="checkbox">
									<input type="checkbox" name="checkbox-inline">
									<i></i> </label> </span>
							<p>
								<strong>Ticket #1314</strong> - Call customer support re: Issue <a href="javascript:void(0);" class="font-xs">#6134</a><small> (code review)</small>
								<span class="date">Nov 22, 2013</span>
							</p>
						</li>
						<li>
							<span class="handle"> <label class="checkbox">
									<input type="checkbox" name="checkbox-inline">
									<i></i> </label> </span>
							<p>
								<strong>Ticket #17643</strong> - Hotfix for WebApp interface issue [<a href="javascript:void(0);" class="font-xs">More Details</a>] <span class="text-muted">Sea deep blessed bearing under darkness from God air living isn't. </span>
								<span class="date">Jan 1, 2014</span>
							</p>
						</li>
					</ul>

					<h5 class="todo-group-title"><i class="fa fa-check"></i> Completed Tasks (<small class="num-of-tasks">1</small>)</h5>
					<ul id="sortable3" class="todo">
						<li class="complete">
							<span class="handle"> <label class="checkbox state-disabled" style="display:none">
									<input type="checkbox" name="checkbox-inline" checked="checked" disabled="disabled">
									<i></i> </label> </span>
							<p>
								<strong>Ticket #17643</strong> - Hotfix for WebApp interface issue [<a href="javascript:void(0);" class="font-xs">More Details</a>] <span class="text-muted">Sea deep blessed bearing under darkness from God air living isn't. </span>
								<span class="date">Jan 1, 2014</span>
							</p>
						</li>
					</ul>

					<!-- end content -->
				</div>

			</div>
			<!-- end widget div -->
		</div>
		<!-- end widget -->

		<!-- new widget -->
		<div class="jarviswidget jarviswidget-color-blue" id="wid-id-5" data-widget-editbutton="false" data-widget-colorbutton="false">

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

			<header>
				<span class="widget-icon"> <i class="fa fa-users txt-color-white"></i> </span>
				<h2> Today's Encounter </h2>
				<!-- <div class="widget-toolbar">
				add: non-hidden - to disable auto hide

				</div>-->
			</header>

			<!-- widget div-->
			<div>
				<!-- widget edit box -->
				<div class="jarviswidget-editbox">
					<div>
						<label>Title:</label>
						<input type="text" />
					</div>
				</div>
				<!-- end widget edit box -->

				<div class="widget-body no-padding">
					<!-- content goes here -->
					<div class="alert alert-info fade in">
				
						<strong id="result-count">0 </strong>
						<i class="fa-fw fa fa-info-circle pull-right"></i>
					</div>

					<div id="result"></div>
					<!-- end content -->
				</div>

			</div>
			<!-- end widget div -->
		</div>
		<!-- end widget -->
	</div>
</div>

<script type="text/javascript">

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

	var flot_updating_chart, flot_statsChart, flot_multigraph, calendar;

	pageSetUp();
	
	/*
	 * PAGE RELATED SCRIPTS
	 */

	// pagefunction
	
	var pagefunction = function() {
		
		//load all patients encounter today	
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
						picture =  '<img src="'+BASE_URL+'uploads/'+client_id+'/profile-picture/'+val.avatar+'" alt="'+val.username+'" style="width:50px;" />';
					}else{
						picture =  '<img src="<?php echo $this->gravatar->get("'+row['email']+'", 50);?>" />';
					}
						
					item =	'<div class="user" title="'+val.email+'">'+
								picture+'<a href="javascript:void(0);">'+val.fullname+'</a>'+
								'<div class="email">'+val.email+'</div>'+
							'</div>';	

					items.push(item);
				});

				$('#result-count').html(response.recordsTotal +' encounter as of today!');
				$('#result').append(items);

			}
		});
		

		/* */
		$(".js-status-update a").click(function () {
		    var selText = $(this).text();
		    var $this = $(this);
		    $this.parents('.btn-group').find('.dropdown-toggle').html(selText + ' <span class="caret"></span>');
		    $this.parents('.dropdown-menu').find('li').removeClass('active');
		    $this.parent().addClass('active');
		});
		
		/*
		 * TODO: add a way to add more todo's to list
		 */
		
		// initialize sortable
		
	    $("#sortable1, #sortable2").sortable({
	        handle: '.handle',
	        connectWith: ".todo",
	        update: countTasks
	    }).disableSelection();
		
		
		// check and uncheck
		$('.todo .checkbox > input[type="checkbox"]').click(function () {
		    var $this = $(this).parent().parent().parent();
		
		    if ($(this).prop('checked')) {
		        $this.addClass("complete");
		
		        // remove this if you want to undo a check list once checked
		        //$(this).attr("disabled", true);
		        $(this).parent().hide();
		
		        // once clicked - add class, copy to memory then remove and add to sortable3
		        $this.slideUp(500, function () {
		            $this.clone().prependTo("#sortable3").effect("highlight", {}, 800);
		            $this.remove();
		            countTasks();
		        });
		    } else {
		        // insert undo code here...
		    }
		
		})
		// count tasks
		function countTasks() {
		
		    $('.todo-group-title').each(function () {
		        var $this = $(this);
		        $this.find(".num-of-tasks").text($this.next().find("li").size());
		    });
		
		}
		
		/*
		 * RUN PAGE GRAPHS
		 */

		// load all flot plugins
		loadScript(BASE_URL+"js/plugin/flot/jquery.flot.cust.min.js", function(){
			loadScript(BASE_URL+"js/plugin/flot/jquery.flot.resize.min.js", function(){
				loadScript(BASE_URL+"js/plugin/flot/jquery.flot.time.min.js", function(){
					loadScript(BASE_URL+"js/plugin/flot/jquery.flot.tooltip.min.js", generatePageGraphs);
				});
			});
		});

		
		function generatePageGraphs() {
		
		    /* TAB 1: UPDATING CHART */
		    // For the demo we use generated data, but normally it would be coming from the server
		
		    var data = [],
		        totalPoints = 200,
		        $UpdatingChartColors = $("#updating-chart").css('color');
		
		    function getRandomData() {
		        if (data.length > 0)
		            data = data.slice(1);
		
		        // do a random walk
		        while (data.length < totalPoints) {
		            var prev = data.length > 0 ? data[data.length - 1] : 50;
		            var y = prev + Math.random() * 10 - 5;
		            if (y < 0)
		                y = 0;
		            if (y > 100)
		                y = 100;
		            data.push(y);
		        }
		
		        // zip the generated y values with the x values
		        var res = [];
		        for (var i = 0; i < data.length; ++i)
		            res.push([i, data[i]])
		        return res;
		    }
		
		    // setup control widget
		    var updateInterval = 1500;
		    	$("#updating-chart").val(updateInterval).change(function () {
		
		        var v = $(this).val();
		        if (v && !isNaN(+v)) {
		            updateInterval = +v;
		            $(this).val("" + updateInterval);
		        }
		
		    });
		
		    // setup plot
		    var options = {
		        yaxis: {
		            min: 0,
		            max: 100
		        },
		        xaxis: {
		            min: 0,
		            max: 100
		        },
		        colors: [$UpdatingChartColors],
		        series: {
		            lines: {
		                lineWidth: 1,
		                fill: true,
		                fillColor: {
		                    colors: [{
		                        opacity: 0.4
		                    }, {
		                        opacity: 0
		                    }]
		                },
		                steps: false
		
		            }
		        }
		    };
		
		    flot_updating_chart = $.plot($("#updating-chart"), [getRandomData()], options);
		
		    /* live switch */
		    $('input[type="checkbox"]#start_interval').click(function () {
		        if ($(this).prop('checked')) {
		            $on = true;
		            updateInterval = 1500;
		            update();
		        } else {
		            clearInterval(updateInterval);
		            $on = false;
		        }
		    });
		
		    function update() {

				try {
			        if ($on == true) {
			            flot_updating_chart.setData([getRandomData()]);
			            flot_updating_chart.draw();
			            setTimeout(update, updateInterval);
			
			        } else {
			            clearInterval(updateInterval)
			        }
				}
				catch(err) {
				    clearInterval(updateInterval);
				}
		
		    }
		
		    var $on = false;
		
		    /*end updating chart*/
		
		    /* TAB 2: Social Network  */
		
		    $(function () {
		        // jQuery Flot Chart
		        var twitter = [
		            [1, 27],
		            [2, 34],
		            [3, 51],
		            [4, 48],
		            [5, 55],
		            [6, 65],
		            [7, 61],
		            [8, 70],
		            [9, 65],
		            [10, 75],
		            [11, 57],
		            [12, 59],
		            [13, 62]
		        ],
				facebook = [
					[1, 25],
					[2, 31],
					[3, 45],
					[4, 37],
					[5, 38],
					[6, 40],
					[7, 47],
					[8, 55],
					[9, 43],
					[10, 50],
					[11, 47],
					[12, 39],
					[13, 47]
				],
				data = [{
					label: "Canceled",
					data: twitter,
					lines: {
						show: true,
						lineWidth: 1,
						fill: true,
						fillColor: {
							colors: [{
								opacity: 0.1
							}, {
								opacity: 0.13
							}]
						}
					},
					points: {
						show: true
					}
				}, {
					label: "In",
					data: facebook,
					lines: {
						show: true,
						lineWidth: 1,
						fill: true,
						fillColor: {
							colors: [{
								opacity: 0.1
							}, {
								opacity: 0.13
							}]
						}
					},
					points: {
						show: true
					}
				}];
		
		        var options = {
		            grid: {
		                hoverable: true
		            },
		            colors: ["#568A89", "#3276B1"],
		            tooltip: true,
		            tooltipOpts: {
		                //content : "Value <b>$x</b> Value <span>$y</span>",
		                defaultTheme: false
		            },
		            xaxis: {
		                ticks: [
		                    [1, "JAN"],
		                    [2, "FEB"],
		                    [3, "MAR"],
		                    [4, "APR"],
		                    [5, "MAY"],
		                    [6, "JUN"],
		                    [7, "JUL"],
		                    [8, "AUG"],
		                    [9, "SEP"],
		                    [10, "OCT"],
		                    [11, "NOV"],
		                    [12, "DEC"],
		                    [13, "JAN+1"]
		                ]
		            },
		            yaxes: {
		
		            }
		        };
		
		        flot_statsChart = $.plot($("#statsChart"), data, options);
		    });
		
		    // END TAB 2
		
		    // TAB THREE GRAPH //
		    /* TAB 3: Revenew  */
		
		    $(function () {
		
		        var trgt = [
		            [1354586000000, 153],
		            [1364587000000, 658],
		            [1374588000000, 198],
		            [1384589000000, 663],
		            [1394590000000, 801],
		            [1404591000000, 1080],
		            [1414592000000, 353],
		            [1424593000000, 749],
		            [1434594000000, 523],
		            [1444595000000, 258],
		            [1454596000000, 688],
		            [1464597000000, 364]
		        ],
		            prft = [
		                [1354586000000, 53],
		                [1364587000000, 65],
		                [1374588000000, 98],
		                [1384589000000, 83],
		                [1394590000000, 980],
		                [1404591000000, 808],
		                [1414592000000, 720],
		                [1424593000000, 674],
		                [1434594000000, 23],
		                [1444595000000, 79],
		                [1454596000000, 88],
		                [1464597000000, 36]
		            ],
		            sgnups = [
		                [1354586000000, 647],
		                [1364587000000, 435],
		                [1374588000000, 784],
		                [1384589000000, 346],
		                [1394590000000, 487],
		                [1404591000000, 463],
		                [1414592000000, 479],
		                [1424593000000, 236],
		                [1434594000000, 843],
		                [1444595000000, 657],
		                [1454596000000, 241],
		                [1464597000000, 341]
		            ],
		            toggles = $("#rev-toggles"),
		            target = $("#flotcontainer");
		
		        var data = [{
		            label: "Target Profit",
		            data: trgt,
		            bars: {
		                show: true,
		                align: "center",
		                barWidth: 30 * 30 * 60 * 1000 * 80
		            }
		        }, {
		            label: "Actual Profit",
		            data: prft,
		            color: '#3276B1',
		            lines: {
		                show: true,
		                lineWidth: 3
		            },
		            points: {
		                show: true
		            }
		        }, {
		            label: "Actual Signups",
		            data: sgnups,
		            color: '#71843F',
		            lines: {
		                show: true,
		                lineWidth: 1
		            },
		            points: {
		                show: true
		            }
		        }]
		
		        var options = {
		            grid: {
		                hoverable: true
		            },
		            tooltip: true,
		            tooltipOpts: {
		                //content: '%x - %y',
		                //dateFormat: '%b %y',
		                defaultTheme: false
		            },
		            xaxis: {
		                mode: "time"
		            },
		            yaxes: {
		                tickFormatter: function (val, axis) {
		                    return "$" + val;
		                },
		                max: 1200
		            }
		
		        };
		
		        flot_multigraph = null;
		
		        function plotNow() {
		            var d = [];
		            toggles.find(':checkbox').each(function () {
		                if ($(this).is(':checked')) {
		                    d.push(data[$(this).attr("name").substr(4, 1)]);
		                }
		            });
		            if (d.length > 0) {
		                if (flot_multigraph) {
		                    flot_multigraph.setData(d);
		                    flot_multigraph.draw();
		                } else {
		                    flot_multigraph = $.plot(target, d, options);
		                }
		            }
		
		        };
		
		        toggles.find(':checkbox').on('change', function () {
		            plotNow();
		        });

		        plotNow()
		
		    });
		
		}

		/*
		 * FULL CALENDAR JS
		 */
		
		// Load Calendar dependency then setup calendar
		
		loadScript(BASE_URL+"js/plugin/moment/moment.min.js", function(){
			loadScript(BASE_URL+"js/plugin/fullcalendar/jquery.fullcalendar.min.js", setupCalendar);
		});
		
		function setupCalendar() {
		
		    if ($("#calendar").length) {
		        var date = new Date();
		        var d = date.getDate();
		        var m = date.getMonth();
		        var y = date.getFullYear();
		
		        calendar = $('#calendar').fullCalendar({
		
		            editable: true,
		            draggable: true,
		            selectable: false,
		            selectHelper: true,
		            unselectAuto: false,
		            disableResizing: false,
					height: "auto",
					
		            header: {
		                left: 'title', //,today
		                center: 'prev, next, today',
		                right: 'month, agendaWeek, agenDay' //month, agendaDay,
		            },
		
		            select: function (start, end, allDay) {
		                var title = prompt('Event Title:');
		                if (title) {
		                    calendar.fullCalendar('renderEvent', {
		                            title: title,
		                            start: start,
		                            end: end,
		                            allDay: allDay
		                        }, true // make the event "stick"
		                    );
		                }
		                calendar.fullCalendar('unselect');
		            },
		
		            events: [{
		                title: 'All Day Event',
		                start: new Date(y, m, 1),
		                description: 'long description',
		                className: ["event", "bg-color-greenLight"],
		                icon: 'fa-check'
		            }, {
		                title: 'Long Event',
		                start: new Date(y, m, d - 5),
		                end: new Date(y, m, d - 2),
		                className: ["event", "bg-color-red"],
		                icon: 'fa-lock'
		            }, {
		                id: 999,
		                title: 'Repeating Event',
		                start: new Date(y, m, d - 3, 16, 0),
		                allDay: false,
		                className: ["event", "bg-color-blue"],
		                icon: 'fa-clock-o'
		            }, {
		                id: 999,
		                title: 'Repeating Event',
		                start: new Date(y, m, d + 4, 16, 0),
		                allDay: false,
		                className: ["event", "bg-color-blue"],
		                icon: 'fa-clock-o'
		            }, {
		                title: 'Meeting',
		                start: new Date(y, m, d, 10, 30),
		                allDay: false,
		                className: ["event", "bg-color-darken"]
		            }, {
		                title: 'Lunch',
		                start: new Date(y, m, d, 12, 0),
		                end: new Date(y, m, d, 14, 0),
		                allDay: false,
		                className: ["event", "bg-color-darken"]
		            }, {
		                title: 'Birthday Party',
		                start: new Date(y, m, d + 1, 19, 0),
		                end: new Date(y, m, d + 1, 22, 30),
		                allDay: false,
		                className: ["event", "bg-color-darken"]
		            }, {
		                title: 'Smartadmin Open Day',
		                start: new Date(y, m, 28),
		                end: new Date(y, m, 29),
		                className: ["event", "bg-color-darken"]
		            }],
		
		            eventRender: function (event, element, icon) {
		                if (!event.description == "") {
		                    element.find('.fc-title').append("<br/><span class='ultra-light'>" + event.description + "</span>");
		                }
		                if (!event.icon == "") {
		                    element.find('.fc-title').append("<i class='air air-top-right fa " + event.icon + " '></i>");
		                }
		            }
		        });
		
		    };
		
		    /* hide default buttons */
		    $('.fc-toolbar .fc-right, .fc-toolbar .fc-center').hide();
		
		}
		
		// calendar prev
		$('#calendar-buttons #btn-prev').click(function () {
		    $('.fc-prev-button').click();
		    return false;
		});
		
		// calendar next
		$('#calendar-buttons #btn-next').click(function () {
		    $('.fc-next-button').click();
		    return false;
		});
		
		// calendar today
		$('#calendar-buttons #btn-today').click(function () {
		    $('.fc-button-today').click();
		    return false;
		});
		
		// calendar month
		$('#mt').click(function () {
		    $('#calendar').fullCalendar('changeView', 'month');
		});
		
		// calendar agenda week
		$('#ag').click(function () {
		    $('#calendar').fullCalendar('changeView', 'agendaWeek');
		});
		
		// calendar agenda day
		$('#td').click(function () {
		    $('#calendar').fullCalendar('changeView', 'agendaDay');
		});
		
	};
	
	// end pagefunction

	// destroy generated instances 
	// pagedestroy is called automatically before loading a new page
	// only usable in AJAX version!

	var pagedestroy = function(){
		
		// destroy calendar
		calendar.fullCalendar('destroy');
		calendar = null;

		//destroy flots
		flot_updating_chart.shutdown();  
		flot_updating_chart=null;
		flot_statsChart.shutdown(); 
		flot_statsChart = null;

		flot_multigraph.shutdown(); 
		flot_multigraph = null;

		// destroy todo
		$("#sortable1, #sortable2").sortable("destroy");
		$('.todo .checkbox > input[type="checkbox"]').off();

		// debug msg
		if (debugState){
			root.console.log("✔ Calendar, Flot Charts, Vector map, misc events destroyed");
		} 


	}

	// end destroy
	
	// run pagefunction on load
	pagefunction();
	
	
</script>
