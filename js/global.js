var mcs = (function() {

    var that = {};

    that.init = function () {
		console.log('Global initialized!');
		setInterval(function(){
			
			var counts = $('span#que-counts').html();
			var xcounts = $('span#running-que-counts').html();
			
			$.ajax({
				url: BASE_URL+'queings/get_counts',
				type: 'post',   
				dataType: 'json',
				success: function (res) {
					$('#running-que-counts').html(res.counts);
				}
			});

			if(counts != xcounts){
				que_get();
				$('span#que-counts').text($('#running-que-counts').html());
			}
			
		},3000);
		
		que_counts();
		
		function que_counts(){
			$.ajax({
				url: BASE_URL+'queings/get_counts',
				type: 'post',   
				dataType: 'json',
				success: function (res) {
					$('#que-counts').html(res.counts);
				}
			});
		}
		
		que_get();
		
		function que_get(){
			$.ajax({
				url: BASE_URL+'queings/get_in',
				type: 'post',   
				dataType: 'html',
				beforeSend: function () {
					$('.project-context').find('ul.dropdown-menu').remove();
				},
				success: function (response) {
					$(response).appendTo( $( ".project-context" ) );
				}
			});
		}

		//if(ROLE_ID == 1){
	
			/* var setup = function (){
				$.ajax({
					url: BASE_URL+'secure/setup',
					onError: function () {
						bootbox.alert('Some network problem try again later.');
					},
					success: function (response)
					{
						var dialog = bootbox.dialog({
							title: 'Initial Setup',
							className: "modal70",
							message: '<p class="text-center"><img src="'+BASE_URL+'img/ajax-loader.gif"/></p>'
						});
						dialog.init(function(){
							setTimeout(function(){
								dialog.find('.bootbox-body').html(response);
							}, 3000);
						});
					}
				}); 
			}
			
			loadScript(BASE_URL+"js/bootbox.min.js", setup); */
		//}
		
	}

	that.init_smallBox = function (_type, _content, _timeout = 3000) {

		var _color = '';
		var _iconSmall = '';
		
		switch (_type) { 
			case 'error': 
				_color = "#C46A69";
				_iconSmall = "fa fa-warning shake animated";
				break;
			case 'warning': 
				_color = "#826430";
				_iconSmall = "fa-fw fa fa-warning";
				break;
			case 'info': 
				_color = "#305d8c";
				_iconSmall = "fa-fw fa fa-info";
				break;
			default: //success
				_color = "#739E73";
				_iconSmall = "fa fa-check";
		}

		$.smallBox({
			title : _type,
			content : _content,
			color : _color,
			iconSmall : _iconSmall,
			timeout : _timeout
		});
	}

	that.init_location = function (country, city, state) {

		if (country)
	    {
	        getStates(country, state);
	    }

	    if (state)
	    {
	        getCities(state, city);
	    }
		
	    $(document).on("change", "#country", function () {

	        var country_id = $('#country option:selected').val();
	        getStates(country_id, state);
			
	    });

	    $(document).on("change", "#state", function () {

	        var state_id = $('#state option:selected').val();
	        getCities(state_id, city);
			
	    });
		
		function getStates(country_id, state){
			$.ajax({
				url: BASE_URL + 'locations/populate_state',
				data: {
					id: country_id
				},
				type: "POST",
				beforeSend: function () {
					$("#state").html('<option selected="selected">loading...</option>');
				},
				success: function (e) {
					var response = $.parseJSON(e);
					var option = '';
					if (response.length)
					{
		
						for (r in response)
						{
							// console.log(response);
							var state_id = response[r].location_id;
							var name = response[r].name;
							if (state_id == state)
							{
								option += '<option selected="selected" value="' + state_id + '">' + name + '</option>';
							}
							else
							{
								option += '<option value="' + state_id + '">' + name + '</option>';
							}
							getCities(state_id, city);
						}
						
					}
					$('#state').html(option);
					
				}

			});
		}
		
		function getCities(state_id, city){
			$.ajax({
				url: BASE_URL + 'locations/populate_citie',
				data: {
					id: state_id
				},
				type: "POST",
				beforeSend: function () {
					$("#city").html('<option selected="selected">loading...</option>');
				},
				success: function (e) {
					var response = $.parseJSON(e);
					var option = '';

						for (r in response)
						{
							var city_id = response[r].location_id;
							var name = response[r].name;
							if (city_id == city) {
								option += '<option selected="selected" value="' + city_id + '">' + name + '</option>';
							} else {
								option += '<option value="' + city_id + '">' + name + '</option>';
							}
						}
					
					$('#city').html(option);
					
				}

			});
		}
	}

	that.init_ajax_form = function (validate_form) {

		var validatefunction = function() {

			$(validate_form).validate({
			
				// Ajax form submition
				submitHandler : function(form) {
					
					$(form).ajaxSubmit({
						beforeSend: function () {
							$(form).find('#submit').html("<?php echo $this->lang->line('__common_please_wait');?>");
							$(form).find('#submit').attr("disabled", "disabled");
						},
						success:function(response)
						{
							if(response.success)
							{
								that.init_smallBox("Success", response.message);
							}
							else
							{
								that.init_smallBox("Error", response.message);	
							}                   
							$(form).find('#submit').text("<?php echo $this->lang->line('__common_update');?>");
							$(form).find('#submit').removeAttr("disabled");
						},
						dataType:'json'
					});
				}
			});

			$('.is_required').each(function() {
				var _self = $(this);
				var _messages = _self.attr('name');
			    _self.rules('add', {
			        required: true,  // example rule
			        messages : '<i class="fa fa-times-circle"></i> '+_messages+' is required!',
			        // another rule, etc.
			    });
			});

			$('.has_max').each(function() {
				var _self = $(this);
				var _length = _self.attr('data-max');
				var _messages = _self.attr('name');
			    _self.rules('add', {
			        maxlength: _length,  // example rule
			        messages : '<i class="fa fa-times-circle"></i> '+_messages+' can not exceed '+_length+' characters in length.',
			        // another rule, etc.
			    });
			});

			

		}
		loadScript(BASE_URL+"js/plugin/jquery-validate/jquery.validate.min.js", function(){
			loadScript(BASE_URL+"js/plugin/jquery-form/jquery-form.min.js", validatefunction);
		});
	}

    return that;

})();