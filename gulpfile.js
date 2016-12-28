/**
 * Gulp file setup
 */

// Project configuration
var project 		= 'basicpress', // Project name, used for build zip.
    url 		= 'basicpress.dev', // Local Development URL for BrowserSync. Change as-needed.
    build 		= './build-theme/', // Files that you want to package into a zip go here
    buildInclude 	= [

        // include common file types
        '**/*.php',
        '**/*.html',
        '**/*.css',
        '**/*.js',
        '**/*.svg',
        '**/*.ttf',
        '**/*.otf',
        '**/*.eot',
        '**/*.woff',
        '**/*.woff2',

        // include specific files and folders
        'screenshot.png',

        // exclude files and folders
        '!node_modules/**/*',
        '!img/raw/**/*',

    ];

/**
 * Including Gulp Plugins
 */
var gulp = require('gulp'),
    sass = require('gulp-sass'),
    browserSync = require('browser-sync').create();

/**
 * Task - Default
 */
gulp.task('default', function() {
    // This does nothing for now, we'll add functionality soon
});

/**
 * Task - Browser Sync
 */
gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: "basicpress.dev"
    });
});

/**
 * Task - Compiling Sass + Injecting CSS
 */
gulp.task('sass', function () {
    gulp.src('scss/**/*.scss')
        .pipe(sass())
        .pipe(gulp.dest('css'))
        .pipe(browserSync.stream());
});

/**
 * Automate Process - Compiling Sass and Injecting PHP + CSS + JS through watch (live).
 */
gulp.task('automate', function() {

    browserSync.init({

        // Read here http://www.browsersync.io/docs/options/
        proxy: url,

        // port: 8080,

        // Tunnel the Browsersync server through a random Public URL
        // tunnel: true,

        // Attempt to use the URL "http://my-private-site.localtunnel.me"
        // tunnel: "ppress",

        // Inject CSS changes
        injectChanges: true
    });

    gulp.watch('scss/**/*.scss', ['sass']);
    gulp.watch("**/*.php").on('change', browserSync.reload);
});

/**
 * Task - Copy file/directories
 */
gulp.task('copy', function() {
    return gulp.src('source')
        .pipe(gulp.dest('destination'));
});