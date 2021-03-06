module.exports = function(grunt) {
    'use strict';

    // Force use of Unix newlines
    grunt.util.linefeed = '\n';

    // Find what the current theme's directory is, relative to the WordPress root
    var path = process.cwd();
    path = path.replace(/^[\s\S]+\/wp-content/, "\/wp-content");

    var CSS_LESS_FILES = {
        'css/style.css': 'less/style.less',
        'homepages/assets/css/homepage.css': 'homepages/assets/less/homepage.less'
    };

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        less: {
            development: {
                options: {
                    paths: [
                        'less'
                    ],
                    sourceMap: true,
                    outputSourceFiles: true,
                    sourceMapBasepath: path,
                },
                files: CSS_LESS_FILES
            },
        },

        cssmin: {
            target: {
                options: {
                    report: 'gzip'
                },
                files: [
                    {
                        expand: true,
                        cwd: 'css',
                        src: ['*.css', '!*.min.css'],
                        dest: 'css',
                        ext: '.min.css'
                    },
                    {
                        expand: true,
                        cwd: 'homepage/assets/css',
                        src: ['*.css', '!*.min.css'],
                        dest: 'homepage/assets/css',
                        ext: '.min.css'
                    }
                ]
            }
        },

        watch: {
            less: {
                files: [
                    'less/**/*.less',
                    'homepages/assets/less/**/*.less'
                ],
                tasks: [
                    'less:development',
                    'cssmin'
                ]
            }
        },
    });

    require('load-grunt-tasks')(grunt, { scope: 'devDependencies' });

    grunt.registerTask('default', ['less', 'cssmin']);
}
