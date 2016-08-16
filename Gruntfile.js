module.exports = function(grunt) {
    // Chargement automatique de tous nos modules
    require('load-grunt-tasks')(grunt);

    // Configuration des plugins
    grunt.initConfig({
        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    "web/assets/compiled/css/main.css": [
                        "app/Resources/css/main.scss"
                    ]
                }
            }
        },
        babel: {
            options: {
                sourceMap: true
            },
            dist: {
                files: {
                    "web/assets/compiled/javascript/main.js": "app/Resources/javascript/main.js"
                }
            }
        },
        watch: {
            css: {
                files: [
                    'app/Resources/css/*.scss',
                    'app/Resources/javascript/*.js'
                ],
                tasks: ['sass', 'babel']
            }
        }
    });

    grunt.registerTask('default', ['watch']);
};