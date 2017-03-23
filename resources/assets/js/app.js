(function() {

	/**
	 * Material initialization
	 */
	$.material.init();

	/**
	 * jQuery Cookie Bar initialization
	 */
	$.cookieBar();

	/**
	 * Carousel Auto Play
	 */
	$('.carousel').carousel({
		interval : 5000
	});

	/**
	 * Add bg class for login and register page
	 */
	$('.login, .register').parent().addClass('bg');

	/**
	 * Bootstrap Date picker
	 * @type {Date}
	 */
	let nowTemp = new Date();
	let now     = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

	$('#date, .datepicker').datepicker({
		format   : 'yyyy-mm-dd',
		onRender : function(date) {
			return date.valueOf() < now.valueOf() ? 'disabled' : '';
		}
	});

	/**
	 * Alert fade in and out
	 */
	$('.alert-dismissible').fadeIn(500).delay(7000).fadeOut(500).addClass('animated tada');

	/**
	 * This function will make menus drop automatically
	 * it targets the ul navigation and li drop-down
	 * and uses the jQuery hover() function to do that.
	 */
	$('ul.nav li.dropdown').hover(function() {
		$('.dropdown-menu', this).fadeIn('fast');
	}, function() {
		$('.dropdown-menu', this).fadeOut('fast');
	}); // HOVER

	/**
	 * Show tooltips
	 */
	$("[data-toggle='tooltip']").tooltip({animation : true, html : true});

	/**
	 * Show pop overs
	 */
	$('[data-toggle="popover"]').popover({html : true});

	/**
	 * Attribute data-remote for every form
	 */
	$('form[data-remote]').on('submit', function(e) {
		let $btn = $(this).find('button').button('loading');
		setTimeout(function() {
			$btn.button('reset');
		}, 3600000); // 1000*60*60 (1 hour)
	});

	/**
	 * Attribute data-ajax for every form
	 */
	$('form#deliverable').on('submit', function(e) {
		let form   = $(this);
		let method = form.find('input[name="_method"]').val() || 'POST';
		let url    = form.prop('action');
		$.ajax({
			type    : method,
			url     : url,
			data    : form.serialize(),
			success : function(data) {
				form.find('input').val('');
				swal({
					title             : data['title'],
					text              : data['text'],
					type              : 'info',
					confirmButtonText : 'Okay'
				});
			},
			error   : function(data) {
				let errors = $.parseJSON(data.responseText);
				$.each(errors, function(index, value) {
					swal({
						title             : value.toString(),
						type              : 'error',
						confirmButtonText : 'Ah Okay'
					});
				});
			}
		});
		e.preventDefault();
	});

	/**
	 * Dropzone
	 * @type {{paramName: string, maxFilesize: number, acceptedFiles: string}}
	 */
	Dropzone.options.addPhotosFrom = {
		paramName     : "photo", // The name that will be used to transfer the file
		maxFilesize   : 5, // MB
		acceptedFiles : '.jpg, .jpeg, .png, .bmp', // Validates file types
		// addRemoveLinks : true,
	};

	Dropzone.options.addProductPhoto = {
		paramName      : "photo", // The name that will be used to transfer the file
		maxFilesize    : 5, // MB
		uploadMultiple : false,
		maxFiles       : 1,
		acceptedFiles  : '.jpg, .jpeg, .png, .bmp', // Validates file types
		// addRemoveLinks : true,
	};

	Dropzone.options.addEventPhoto = {
		paramName      : "photo", // The name that will be used to transfer the file
		maxFilesize    : 9, // MB
		uploadMultiple : false,
		maxFiles       : 1,
		acceptedFiles  : '.jpg, .jpeg, .png, .bmp', // Validates file types
		// addRemoveLinks : true,
	};

	/**
	 * Pjax
	 */
	$(document).pjax(
		'a#pjax, a[data-pjax]',
		'#pjax-container', {
			type     : 'GET',
			push     : false,
			replace  : true,
			scrollTo : false,
			timeout  : 3500,
		}
	).on('pjax:success', function() {
		$('#notifyAlert').fadeIn('fast').delay(700).fadeOut('fast');
	});

	$(document).on('submit', 'form[data-pjax]', function(event) {
		$.pjax.submit(event, '#pjax-container', {
			type     : 'GET',
			push     : false,
			replace  : true,
			scrollTo : false,
			timeout  : 3500,
		})
	});

	/**
	 * Confirmation class
	 */
	$('.confirm').click(function(e) {
		e.preventDefault();
		let form = $(this).closest('form');
		swal({
			title              : "<h4>Are You Sure ?</h4>",
			type               : "question",
			showCancelButton   : true,
			confirmButtonColor : "#4CAF50",
			cancelButtonColor  : "#F44336",
			confirmButtonClass : 'btn btn-success btn-raised',
			cancelButtonClass  : 'btn btn-danger btn-raised',
			confirmButtonText  : "Yes",
			cancelButtonText   : "No",
			closeOnConfirm     : true,
			closeOnCancel      : true,
		}).then(
			function() {
				form.submit();
			}
		);
	});

	/**
	 * Reloading page every interval minute
	 */
	let reloading;
	let interval = 30000;

	function checkReloading() {
		if (window.location.hash == "#autoreload") {
			reloading                                  = setTimeout("window.location.reload();", interval);
			document.getElementById("refresh").checked = true;
		}
	}

	function toggleAutoRefresh(cb) {
		if (cb.checked) {
			window.location.replace("#autoreload");
			reloading = setTimeout("window.location.reload();", interval);
		} else {
			window.location.replace("#");
			clearTimeout(reloading);
		}
	}

	$('#refresh').on('click', function() {
		toggleAutoRefresh(this);
	});

	checkReloading();

})();
