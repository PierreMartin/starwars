module.exports = function(grunt) {

    grunt.loadNpmTasks('grunt-contrib-sass');
    require('load-grunt-tasks')(grunt);


    // Configuration de Grunt 
    grunt.initConfig({

        //////////////////////////////// JS VERIFE ////////////////////////////////
        jshint: {
            all: [
                // ON VERIFE :
                'resources/assets/js/*.js',

                // ON EXCLUE LES MINIFIER :
                '!public/assets/js/*.min.js'
            ]
        },

        //////////////////////////////// JS ////////////////////////////////
        uglify: {
            options: {
                mangle: false
            },
            backo_js: {
                files: {
                    'public/assets/js/backo.min.js': [
                        'resources/assets/js/backo.js',
                        '!public/assets/js/*.min.js'
                    ]
                }
            },
            front_js: {
                files: {
                    'public/assets/js/front.min.js': [
                        'resources/assets/js/front.js',
                        '!public/assets/js/*.min.js'
                    ]
                }
            },
            home_js: {
                files: {
                    'public/assets/js/home.min.js': [
                        'resources/assets/js/home.js',
                        '!public/assets/js/*.min.js'
                    ]
                }
            }
        },

        //////////////////////////////// SCSS ////////////////////////////////
        sass: {
            options: {
                compass: true,
                style: 'expanded'
            },
            backo_css: {
                files: {'public/assets/css/backo.min.css': ['resources/assets/sass/backo.scss']}
            },
            front_css: {
                files: {'public/assets/css/front.min.css': ['resources/assets/sass/front.scss']}
            },
            main_css: {
                files: {'public/assets/css/main.min.css': ['resources/assets/sass/main.scss']}
            }
        },

        //////////////////////////////// WATCH ////////////////////////////////
        watch: {
            js: {
                files: ['resources/assets/js/*.js', '!public/assets/js/*.min.js'], // fichiers d'entrer
                tasks: ['uglify'],
                options: { spawn: false }
            },
            css: {
                files: ['resources/assets/sass/*.scss', '!public/assets/css/*.min.css'],
                tasks: ['sass'],
                options: { spawn: false }
            }
        }


    });


    grunt.registerTask('default', [
        'jshint',
        'uglify',
        'sass'
    ]);
    grunt.registerTask('js', ['uglify']);
    grunt.registerTask('compile', ['css', 'js']);

};

// $ grunt
// $ grunt watch

// CDN JS :  telechargement + rapide et mise en cache
// pourquoi grunt : plus de plugins dispo car plus vieux | plus de support
// pourquoi sass : plus recent (less est de - en - utilisé, tendance a disparaitre) et support de compass
