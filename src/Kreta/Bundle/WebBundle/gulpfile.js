/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

'use strict';

var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var babel = require('gulp-babel');
var del = require('del');
var concat = require('gulp-concat');
var header = require('gulp-header');
var imagemin = require('gulp-imagemin');
var jshint = require('gulp-jshint');
var minifyCSS = require('gulp-minify-css');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var scsslint = require('gulp-scss-lint');
var uglify = require('gulp-uglify');
var pkg = require('./package.json');

var basePath = './../../../../web/bundles/kretaweb/';
var resultPath = './../../../../web/';

var license = [
  '/*',
  ' * <%= pkg.name %> - <%= pkg.description %>',
  ' * @version v<%= pkg.version %>',
  ' * @link    <%= pkg.homepage %>',
  ' * @author  <%= pkg.authors[0].name %> (<%= pkg.authors[0].homepage %>)',
  ' * @author  <%= pkg.authors[1].name %> (<%= pkg.authors[1].homepage %>)',
  ' * @license <%= pkg.license %>',
  ' */',
  "\n"
].join("\n");

var assets = {
  images: basePath + 'img/**',
  javascripts: basePath + 'js/**/*.js',
  sass: basePath + 'scss/app.scss',
  vendors: basePath + 'vendor/**'
};

var watch = {
  sass: basePath + 'scss/**/*.scss'
}

gulp.task('clean', function () {
  del.sync([
    resultPath + 'css*',
    resultPath + 'images*',
    resultPath + 'js*',
    resultPath + 'vendor*'
  ], {force: true});
});

gulp.task('images', function () {
  return gulp.src(assets.images)
    //.pipe(imagemin({optimizationLevel: 5}))
    .pipe(gulp.dest(resultPath + 'images'));
});

gulp.task('vendor', function () {
  return gulp.src(assets.vendors)
    .pipe(gulp.dest(resultPath + 'vendor'));
});

gulp.task('scss-lint', function () {
  return gulp.src(watch.sass)
    .pipe(scsslint());
});

gulp.task('sass', function () {
  return gulp.src(assets.sass)
    .pipe(sass({
        style: 'expanded',
        lineNumbers: true,
        loadPath: true,
        errLogToConsole: true
     }))
    .pipe(rename({basename: 'kreta'}))
    .pipe(autoprefixer())
    .pipe(gulp.dest(resultPath + 'css'));
});

gulp.task('sass:prod', ['scss-lint'], function () {
  return gulp.src(assets.sass)
    .pipe(sass(assets.sass, {
        style: 'compressed',
        stopOnError: true
    }))
    .pipe(rename({
      basename: 'kreta',
      suffix: '.min'
    }))
    .pipe(autoprefixer())
    .pipe(minifyCSS({keepSpecialComments: 0}))
    .pipe(header(license, {pkg: pkg}))
    .pipe(gulp.dest(resultPath + 'css'));
});

gulp.task('javascript', function () {
  return gulp.src(assets.javascripts)
    .pipe(jshint('.jshintrc'))
    .pipe(jshint.reporter('default'))
    .pipe(babel({blacklist: ['useStrict'], comments: false, modules: ['amd'] }))
    .pipe(gulp.dest(resultPath + 'js'));
});

gulp.task('javascript:prod', function () {
  return gulp.src(assets.javascripts)
    .pipe(babel({blacklist: ['useStrict'], comments: false, modules: ['amd'] }))
    .pipe(concat('kreta.min.js'))
    .pipe(uglify())
    .pipe(header(license, {pkg: pkg}))
    .pipe(gulp.dest(resultPath + 'js'));
});

gulp.task('watch', function () {
  gulp.watch(assets.javascripts, ['javascript']);
  gulp.watch(watch.sass, ['sass']);
  gulp.watch(assets.images, ['images']);
});

gulp.task('default', ['clean', 'vendor', 'javascript', 'sass', 'images']);
gulp.task('watcher', ['default', 'watch']);
gulp.task('prod', ['clean', 'images', 'sass:prod', 'javascript:prod']);
