var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

// elixir.config.assetsPath = 'path/to/assets';

elixir(function(mix) {
	// mix.sass(['app1.scss', 'app2.scss'] , 'new_directory')
	// mix.less(['app1.less', 'app2.less'] , 'new_directory')
	mix.sass('app.scss')
		.copy('node_modules/jquery/dist/jquery.js',
			'resources/assets/js/jquery.js')
		.copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
			'resources/assets/js/bootstrap.js')
		.copy('node_modules/sweetalert2/dist/sweetalert2.js',
			'resources/assets/js/sweetalert2.js')
		// .styles(['app.css'])
		// `scripts` can also be used but
		// either use `babel` or `scripts`
		// don't use them together!
		.scripts([
			'jquery.js',
			'bootstrap.js',
			'material.min.js',
			'nouislider.min.js',
			'bootstrap-datepicker.js',
			'material-kit.js',
			'sweetalert2.js',
			'dropzone.js',
			'jquery.pjax.js',
			'lity.js',
			'jquery.cookiebar.js',
			'app.js'
		])
		.version([
			'css/app.css',
			'js/all.js'
		])
	// .browserSync()
	// TDD: type `gulp tdd` in command line to track your test
	// .phpUnit()
	// .phpSpec()
	;
});
