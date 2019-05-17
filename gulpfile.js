'use strict';

var gulp = require('gulp');
//var browserSync = require('browser-sync').create();

gulp.task('css', function () {
    var sass = require('gulp-sass');
    var postcss = require('gulp-postcss');
    var autoprefixer = require('autoprefixer');

    return gulp.src('./asset/sass/*.scss')
        .pipe(sass({
            outputStyle: 'expanded',
            includePaths: ['node_modules/bootstrap/scss', 'node_modules/susy/sass']
        }).on('error', sass.logError))
        .pipe(postcss([
            autoprefixer()
        ]))
        .pipe(gulp.dest('./asset/css'));
});

gulp.task('css:watch', function () {
    gulp.watch('./asset/sass/*.scss', gulp.parallel('css'));
});
//move js files to the src
gulp.task('js', function () {
    return gulp.src(['./node_modules/bootstrap/dist/js/bootstrap.min.js', './node_modules/popper.js/dist/popper.min.js', './node_modules/jquery/dist/jquery.min.js', 'node_modules/susy/sass'])
        .pipe(gulp.dest('./asset/js'))
        //.pipe(browserSync.stream());
});