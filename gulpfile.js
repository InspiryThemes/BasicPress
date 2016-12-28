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
    browserSync = require('browser-sync').create(),
    autoprefixer = require('gulp-autoprefixer'), // Autoprefixing magic
    notify       = require('gulp-notify'),
    plumber      = require('gulp-plumber'), // Helps prevent stream crashing on errors
    zip          = require('gulp-zip'), // Using to zip up our packaged theme into a tasty zip file that can be installed in WordPress!
    filter       = require('gulp-filter'),
    cmq          = require('gulp-combine-media-queries'),
    newer        = require('gulp-newer'),
    rimraf       = require('gulp-rimraf'), // Helps with removing files and directories in our run tasks
    imagemin     = require('gulp-imagemin');

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
        .pipe(sass({
            errLogToConsole: true,

            //outputStyle: 'compressed',
            // outputStyle: 'compact',
            // outputStyle: 'nested',
            outputStyle: 'expanded',
            precision: 10
        }))
        .pipe(plumber())
        .pipe(autoprefixer('last 2 version', '> 1%', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(plumber.stop())
        .pipe(filter('**/*.css')) // Filtering stream to only css files
        // .pipe(cmq()) // Combines Media Queries
        .pipe(gulp.dest('css'))
        .pipe(browserSync.stream())
        .pipe(notify({ message: 'Styles task complete', onLast: true }));
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

/**
 * Task - Image optimization
 */
gulp.task('images', function() {

// Add the newer pipe to pass through newer images only
    return 	gulp.src(['img/raw/**/*.{png,jpg,gif}'])
        .pipe(newer('img/'))
        .pipe(rimraf({ force: true }))
        .pipe(imagemin({ optimizationLevel: 7, progressive: true, interlaced: true }))
        .pipe(gulp.dest('img/'))
        .pipe( notify( { message: 'Images task complete', onLast: true } ) );
});

