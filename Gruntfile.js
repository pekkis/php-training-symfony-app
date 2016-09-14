module.exports = function(grunt) {

    require('jit-grunt')(grunt);

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        revision: "r" + process.cwd().split('/').pop(),

        less: {

            common: {
                files: {
                    "build/css/common.css": [
                        "app/Resources/assets/app.less",
                    ]
                }
            }
        },

        autoprefixer: {
            options: {
                browsers: ['last 2 versions']
            },
            common: {
                src: 'build/css/common.css',
                dest: 'build/css/common.css'
            }
        },

        cssmin: {
            common: {

                options: {
                    keepSpecialComments: 0
                },

                files: {
                    'web/assets/common.css': [
                        'build/css/common.css'
                    ]
                }
            }
        },

        imagemin: {
            production: {
                options: {
                    optimizationLevel: 3,
                    progressive: true
                },
                files: [
                    {
                        expand: true,
                        cwd: 'app/Resources/assets/',
                        src: ['**/*.{png,gif,jpeg,jpg,svg}', '!external/**', '!bower/**'],
                        dest: 'web/assets/'
                    }
                ]
            }
        },

        uglify: {
            options: {
                mangle: false
            },

            common: {
                files: {
                    'web/assets/common.js': [
                        "node_modules/jquery/dist/jquery.js",
                        "app/Resources/assets/app.js",
                    ]
                }
            }
        },

        copy: {
            main: {
                files: [
                    {
                        cwd: 'app/Resources/assets/',
                        expand: true,
                        src: ['**/*.{eot,woff,otf,ttf}'],
                        dest: 'web/assets/'
                    }
                ]
            },
        },

    });

    grunt.registerTask('css', ['less', 'autoprefixer', 'cssmin']);
    grunt.registerTask('js', ['uglify']);

    grunt.registerTask('default', ['css', 'copy', 'js', 'newer:imagemin']);
};