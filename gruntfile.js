'use strict';
module.exports = function(grunt) {

    grunt.initConfig({

        sass: {
            dist: {
                files: {
                    'mm2theme/css/styles.full.css': 'mm2theme/css/styles.scss'
                }
            }
        },



        cssmin: {
            target: {
                files: [{
                    expand: true,
                    cwd: 'css/',
                    src: ['*.css', '!*.min.css'],
                    dest: 'css/',
                    ext: '.min.css'
                }]
            }
        },


        // for local development
        'http-server': {

            'dev': {
                root: ".",
                host: "localhost",
                port: 8080,

                cache: 100,
                showDir: true,
                autoIndex: true,

                // server default file extension
                ext: "html",

                // run in parallel with other tasks
                runInBackground: true,

                // Tell grunt task to open the browser
                // openBrowser: true
            }
        },

        // FTP push to server
        ftp_push: {
            your_target: {
                options: {
                    authKey: "serverA",

                    // create a file named .ftpauth with info below.  Must be in same folder as gruntfile.js
                    // {
                    //     "serverA":{
                    //         "username":"PU TUSERNAME HERE",
                    //         "password":"PUT PW HERE"
                    //     }
                    // }

                    host: "ftp.ephemeralwave.com",
                    dest: "/public_html/wp-content/themes/"

                },
                files: [{
                    expand: true,
                    cwd: '.',
                    src: [
                        "mm2theme/**"
                    ]
                }]
            }
        },

        watch: {
            // reload gruntfile.js if it changes while running
            configFiles: {
                files: ['gruntfile.js'],
                options: {
                    reload: true
                }
            },
            options: {
                livereload: true,
            },
            javascripts: {
                files: ['mm2theme/js/*.js'],
                tasks: ['ftp_push']
            },
            sass: {
                files: ['mm2theme/css/*.scss'],
                tasks: ['sass', 'cssmin', 'ftp_push'],
            },
            php: {
                files: ['mm2theme/*.php', 'mm2theme/page-templates/*.php'],
                tasks: ['ftp_push']
            }
        }

    });



    require('jit-grunt')(grunt);
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['http-server:dev', 'sass', 'cssmin', 'watch']);
    //now, just typing 'grunt' will run this and the watch task will take over.
};