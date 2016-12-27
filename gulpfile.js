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
 * Process - Compiling Sass and Injecting PHP + CSS + JS through watch (live).
 */
gulp.task('automate', function() {

    browserSync.init({
        proxy: "basicpress.dev"
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