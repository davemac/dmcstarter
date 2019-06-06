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

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

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
                // Set to true to pass in buffers via the "files" parameter below
                // "useBuffers" : true,
                // By default, this task will crawl all *.js, *.css, *.scss files.
                // "files" : {
                //     "src": [
                //         "*[^(g|G)runt(file)?].{js,css,scss}",
                //         "**[^node_modules]/**/*.{js,css,scss}",
                //         "!lib/**/*"
                //     ]
                // },
                "customTests": [],
                "dest": "js/modernizr-custom.min.js",
                "tests": [
                    "backgroundblendmode",
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
                src: ['**', '!**/.git/**', '!**/node_modules/**', '!**/backups/**', '!**/build/**', '!**/bower_components/**', '!**/scss/**', '!**/Gruntfile.js', '!**/package.json', '!**/package-lock.json', '!**/.DS_Store', '!**/README.md', '!**/config.rb', '!**/.jshintrc', '!**/.sass-cache', '!**/.bowerrc', '!**/bower.json', '!**/phpcs.xml' ],
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
        deploy: {
            options: {
                args: ["--verbose"],
                exclude: ['css/*.diff', 'css/style.css', 'js/bower.min.js', 'grunt-cache-bust.json', '.DS_Store', 'phpcs.xml'],
                recursive: true,
                ssh: true
            },
            staging: {
                options: {
                    src: "./build/",
                    dest: "~/www/wp-content/themes/[themename]",
                    host: "[sitename]-s",
                }
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
                    'slick-carousel', 
                    'fontawesome',  
                    // 'imagesloaded', 
                    // 'isotope',
                    // 'list.js',
                ],
                mainFiles: {
                    'fontawesome': ['css/font-awesome.min.css'],
                    'slick-carousel': ['slick/slick.min.js', 'slick/slick.css', 'slick/slick-theme.css'],
                    // 'imagesloaded': ['imagesloaded.pkgd.min.js'],
                    // 'isotope': ['dist/isotope.pkgd.min.js'],
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
            changes: {
                files: ['*.php', 'img/*.{png,jpg,jpeg,gif,webp,svg}', '!**/node_modules/**'],
            },
        },
    });

    // rename tasks
    grunt.loadNpmTasks('grunt-rsync');
    grunt.renameTask('rsync', 'deploy');

    grunt.registerTask('style', ['sass']);
    grunt.registerTask('build', [
        'style',
        'clean:build',
        'copy:theme',
        'postcss', 
        'cacheBust:production'
    ]);
    grunt.registerTask('buildbower', [
        'bower_concat',
        'uglify:bower'
    ]);
    grunt.registerTask('sassclean', ['sassyclean']);
    grunt.registerTask('default', ['style', 'watch']);
};