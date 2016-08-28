module.exports = function(grunt) {
    // Autoload of all modules
    require('load-grunt-tasks')(grunt);

    // Plugins configuration
    grunt.initConfig({
        sass: {
            dist: {
                options: {
                    outputStyle: 'compressed'
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
                sourceMap: false
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
                    'app/Resources/css/*.scss'
                ],
                tasks: ['sass']
            },
            js: {
                files: [
                    'app/Resources/javascript/*.js'
                ],
                tasks: ['babel']
            }
        }
    });

    grunt.registerTask('default', ['watch']);
};