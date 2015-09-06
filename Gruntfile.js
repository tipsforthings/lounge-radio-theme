module.exports = function(grunt) {
  require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);

  // Include only what you want! No trailing ","!
  var jsLibs = [
    // 'bower_components/foundation/js/vendor/modernizr.js', // updated - include modernizr separately at <head> and move the rest of [jsLibs] to before </body> for better page load
    'bower_components/foundation/js/vendor/jquery.js',
    'bower_components/foundation/js/vendor/jquery.cookie.js',
    'bower_components/foundation/js/vendor/placeholder.js',
    'bower_components/foundation/js/vendor/fastclick.js'
  ];

  // Include only what you want! No trailing ","!
  var jsFoundation = [
    'bower_components/foundation/js/foundation/foundation.js',
    'bower_components/foundation/js/foundation/foundation.abide.js',
    'bower_components/foundation/js/foundation/foundation.accordion.js',
    'bower_components/foundation/js/foundation/foundation.alert.js',
    'bower_components/foundation/js/foundation/foundation.clearing.js',
    'bower_components/foundation/js/foundation/foundation.dropdown.js',
    'bower_components/foundation/js/foundation/foundation.equalizer.js',
    'bower_components/foundation/js/foundation/foundation.interchange.js',
    'bower_components/foundation/js/foundation/foundation.joyride.js',
    'bower_components/foundation/js/foundation/foundation.magellan.js',
    'bower_components/foundation/js/foundation/foundation.offcanvas.js',
    'bower_components/foundation/js/foundation/foundation.orbit.js',
    'bower_components/foundation/js/foundation/foundation.reveal.js',
    'bower_components/foundation/js/foundation/foundation.slider.js',
    'bower_components/foundation/js/foundation/foundation.tab.js',
    'bower_components/foundation/js/foundation/foundation.tooltip.js',
    'bower_components/foundation/js/foundation/foundation.topbar.js'
  ];

  // Your custom javascript files. No trailing ","!
  var jsApp = [
    'js/app.js',
    'js/_*.js'
  ];

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    jshint: {
      files: ['Gruntfile.js'],
      options: {
        globals: {
          jQuery: true,
          console: true,
          module: true,
          document: true
        }
      }
    },

    uglify: {
      options: {
        sourceMap: true
      },
      dist: {
        files: {
          'js/libs/libs.min.js': [jsLibs],
          'js/libs/foundation.min.js': [jsFoundation],
          'js/app.min.js': [jsApp]
        }
      },
    },
    compass: {
	      dist: {
        options: {
          config: 'config.rb',
        }
      },
    },
    autoprefixer: {
      options: {
        browsers: ['> 20%'],
      },
      css: {
        src: 'css/*.css',
      },
    },    
    cssmin: {
      target: {
        options: {
          sourceMap: true,
        },
        files: [{
          expand: true,
          cwd: 'css',
          src: ['*.css', '!*.min.css'],
          dest: 'release',
          ext: '.css',
        }]
      }
    },
    copy: {
      cache: {
        src: 'release/**.css',
        dest: '**.css',
      },
      main: {
        files: [
          {
            expand: true,
            cwd: 'release',
            src: ['style.css','style.css.map'],
            dest: '',
          },
        ],
      },      
      foundation: {
        nonull: true,
        src: 'bower_components/foundation/js/foundation.min.js',
        dest: 'js/foundation.min.js'
      },
    },
    watch: {
      files: [jsLibs, jsFoundation, jsApp, '**/*.scss'],
      css: {
        files: ['scss/**/*.scss','bower_components/foundation/**/*.scss'],
        tasks: ['compass:dist','autoprefixer:css','cssmin','copy:main'],
        options: {
          debounceDelay: 10,
        },
      },
      js: {
        files: [jsLibs,jsFoundation,jsApp],
        tasks: ['jshint', 'uglify:dist'],
        options: {
          debounceDelay: 10,
        },
      },
    }
  });

  grunt.registerTask('test', ['jshint']);
  grunt.registerTask('default', ['jshint','compass','autoprefixer:css','cssmin','copy:main','watch','uglify']);

};
