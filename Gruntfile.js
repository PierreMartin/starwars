module.exports = function(grunt) {

    // "uglify" = minifie les fichier .js (avec Angular, ajouter l'option "mangle")
    // "jshint" = verifie que notre js de base est valide
    // "cssmin" = minifie les fichier .css

    // "load-grunt-tack" = Plugin qui permet d'écrire automatiquement tous les "grunt.loadNpmTasks" en 1 seul 

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    // Configuration de Grunt 
    grunt.initConfig({
        sass: {                              // Task
            dist: {                            // Target
                options: {                       // Target options
                    style: 'expanded'
                },
                files: {                         // Dictionary of files
                    'main.css': 'app.scss'       // 'destination': 'source'
                }
            }
        }

        /*cssmin: {
            minify: {
                expand: true,
                cwd: 'css/',
                src: ['*.css', '!*.min.css'],
                dest: 'css/',
                ext: '.min.css'
            }
        },*/

        /*uglify: {
            target: {
                files: {
                    'js/app.min.js' : [
                        'js/app.js',
                        'js/HomepageController.js',
                        'js/AboutController.js',
                        'js/ContactController.js'
                    ]
                }
            }
        }*/


    });

    // Définition des tâches Grunt
    // LANCER LES COMMANDES :

    grunt.registerTask('sass', ['sass']);
    grunt.registerTask('js', ['uglify']);
    grunt.registerTask('compile', ['css', 'js']);

};


