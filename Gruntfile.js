module.exports = function(grunt) {
    // Chargement automatique de tous nos modules
    require('load-grunt-tasks')(grunt);

    // Configuration des plugins
    grunt.initConfig({
        less: {
            dist: {
                options: {
                    compress: true,
                    yuicompress: true,
                    optimization: 2
                },
                files: {
                    "web/assets/compiled/css/main.css": [
                        "app/Resources/less/main.less"
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
                    'app/Resources/less/*.less',
                    'app/Resources/javascript/*.js'
                ],
                tasks: ['less', 'babel']
            }
        }
    });

    grunt.registerTask('default', ['watch']);
};