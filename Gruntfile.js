'use strict';

module.exports = function(grunt) {

	// load all grunt tasks
	require('jit-grunt')(grunt);

	var jsFoundation = [
		'bower_components/foundation/js/foundation/foundation.js',
		// 'bower_components/foundation/js/foundation/foundation.abide.js',
		// 'bower_components/foundation/js/foundation/foundation.accordion.js',
		// 'bower_components/foundation/js/foundation/foundation.alert.js',
		// 'bower_components/foundation/js/foundation/foundation.clearing.js',
		// 'bower_components/foundation/js/foundation/foundation.dropdown.js',
		// 'bower_components/foundation/js/foundation/foundation.equalizer.js',
		// 'bower_components/foundation/js/foundation/foundation.interchange.js',
		// 'bower_components/foundation/js/foundation/foundation.joyride.js',
		// 'bower_components/foundation/js/foundation/foundation.magellan.js',
		'bower_components/foundation/js/foundation/foundation.offcanvas.js',
		// 'bower_components/foundation/js/foundation/foundation.orbit.js',
		// 'bower_components/foundation/js/foundation/foundation.reveal.js',
		// 'bower_components/foundation/js/foundation/foundation.slider.js',
		// 'bower_components/foundation/js/foundation/foundation.tab.js',
		// 'bower_components/foundation/js/foundation/foundation.tooltip.js',
		// 'bower_components/foundation/js/foundation/foundation.topbar.js'
	];

	// required for grunt-sass 'implementation' option
	const sass = require('node-sass');

	grunt.config( 'targethost', ( function() {
		var target = grunt.option('target') || 'localhost', domain;

		if ( grunt.option('target') === 'production' ) {
		   domain = 'dmcstarter-l';
		} else if (grunt.option('target') === 'staging') {
			// domain = 'dmcstarter-s';
		// } else {
		//     domain = 'https://dmcstarter.localhost';
		}
		return domain;
	})());

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		// theme directory name
		theme: 'dmcstarter',

		// check which sass partials are not being used
		sassyclean: {
			options: {
				modules: ['scss/partials/*.scss'],
				buildfiles: ['scss/*.scss'],
				remove: false,
				days: null
			},
		},

		modernizr: {
			dist: {
				"crawl": false,
				"customTests": [],
				"dest": "js/modernizr-custom.min.js",
				"tests": [
					"mediaqueries",
					"flexbox",
					"cssgrid",
					"cssgridlegacy",
				],
				"options": [
					"setClasses"
				],
				"uglify": true
			},
		},

		sass: {
			options: {
				implementation: sass,
				sourceMap: true,
				includePaths: ['bower_components/foundation/scss']
			},
			dist: {
				options: {
					outputStyle: 'compressed',
				},
				files: {
					'css/style.css': 'scss/style.scss'
				}
			}
		},

		// For build: copy site files and directories to /build for processing & deployment
		copy: {
			options: {
				// nonull: true
			},
			theme: {
				expand: true,
				cwd: '.',
				src: [
					'css/style.css',
					'css/style.css.map',
					'js/bower.min.js',
					'lib/enqueue.php',
				],
				dest: 'build/',
			},
		},

		// clear out the build directory when 'grunt clean build' is run
		clean: {
			build: {
				src: ['build/']
			},
		},

		postcss: {
			options: {
				map: true,
				processors: [
					require('autoprefixer')({
						grid: true,
						cascade: true,
						diff: true,
					})
				]
			},
			single_file: {
				src: 'build/css/style.css',
			}
		},

		// For build processing: bust cache on these files
		cacheBust: {
			options: {
				jsonOutput: true,
				baseDir: 'build/',
				assets: [
					'css/style.css',
					'js/bower.min.js'
				],
			},
			production: {
				options: {
					jsonOutput: false,
				},
				src: ['build/lib/enqueue.php']
			},
		},

		// deploy files using rsync
		rsync: {
			options: {
				host: grunt.config('targethost'),
				args: ["--verbose"],
				recursive: true,
				ssh: true,
				// dryRun: true,
			},
			css: {
				options: {
					src: [
						'./build/css/style.*.css',
						'./build/css/style.css.map',
					],
					dest: [
						"~/www/wp-content/themes/<%= theme %>/css",
					],
				},
			},
			js: {
				options: {
					src: [
						'./build/js/bower.min.*.js',
					],
					dest: [
						"~/www/wp-content/themes/<%= theme %>/js",
					],
				},
			},
			enqueue: {
				options: {
					src: [
						'./build/lib/enqueue.php',
					],
					dest: [
						"~/www/wp-content/themes/<%= theme %>/lib",
					],
				},
			},
			theme: {
				options: {
					src: [
						'**',
					],
					dest: [
						"~/www/wp-content/themes/<%= theme %>"
					],
					exclude: ['css/*.diff', 'css/style.css', 'css/style.css.map', 'js/bower.min.js', 'lib/enqueue.php', 'grunt-cache-bust.json', '.DS_Store', 'phpcs.xml', '.git', 'node_modules', 'backups', 'build', 'bower_components', 'scss', 'Gruntfile.js', 'package.json', 'package-lock.json', 'README.md', 'config.rb', '.jshintrc', '.sass-cache', '.bowerrc', 'bower.json', 'img/zeplin'],
				},
			}
		},

		// build vendor.js file from specific bower dependencies
		bower_concat: {
			foundation: {
				dest: {
					dest: 'js/foundation.js',
				},
				include: [
					'foundation',
				]
			},
			others: {
				dest: {
					js: 'js/vendor.js',
					css: 'css/vendor.css',
				},
				include: [
					'flickity',
					'fontawesome',
				],
				mainFiles: {
					'fontawesome': ['css/font-awesome.min.css'],
					'flickity': ['dist/flickity.pkgd.min.js', 'css/flickity.css'],
				}
			},
			magnific: {
				dest: {
					dest: '',
					js: 'js/jquery.magnific-popup.min.js',
					css: 'css/magnific-popup.css',
				},
				include: [
					'magnific-popup',
				],
				mainFiles: {
					'magnific-popup': ['dist/jquery.magnific-popup.min.js', 'dist/magnific-popup.css'],
				}
			},
		},

		uglify: {
			bower: {
				options: {
					mangle: true,
					beautify: false,
					compress: true
				},
				files: {
					'js/bower.min.js': [jsFoundation, 'js/app.js', 'js/vendor.js']
				}
			},
		},

		watch: {
			options: {
				livereload: true
			},
			grunt: {
				files: ['Gruntfile.js'],
			},
			sass: {
				files: ['scss/**/*.scss'],
				tasks: ['sass'],
			},
			js: {
				files: ['js/**/*.js', '!js/vendor.js', '!js/bower.min.js'],
				tasks: ['buildbower'],
			},
			changes: {
				files: ['*.php', 'img/*.{png,jpg,jpeg,gif,webp,svg}', '!**/node_modules/**'],
			},
		},
	});

	// rename tasks
	grunt.registerTask('style', ['sass']);
	grunt.registerTask('build', [
		'style',
		'clean:build',
		'copy:theme',
		'postcss',
		'cacheBust:production'
	]);
	grunt.registerTask('deploy', [
		'rsync:css',
		'rsync:js',
		'rsync:enqueue',
		'rsync:theme'
	]);
	grunt.registerTask('buildbower', [
		'bower_concat',
		'uglify:bower'
	]);
	grunt.registerTask('sassclean', ['sassyclean']);
	grunt.registerTask('default', ['style', 'watch']);
};