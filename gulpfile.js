// Config
const version = '1.0.0';

// Require
const del = require('del');
const gulp = require('gulp');
const zip = require('gulp-zip');
const bump = require('gulp-bump');

// Task Clear
gulp.task('clear', function (cb) {
    return del([
        './application/cache/smarty_cache/*.php',
        './application/cache/smarty_template/*.php',
        './application/cache/log/*.log',
        '!.gitkeep'
    ], cb);
});

// Task New Version
gulp.task('version', function () {
    return gulp.src(['./package.json', './composer.json'])
        .pipe(bump({version: version}))
        .pipe(gulp.dest('./'));
});

// Task Publish
var filename = 'LuckyPHP-V' + version + '.zip';
gulp.task('publish_clear', function (cb) {
    return del(['./publish/' + filename], cb);
});
gulp.task('publish_pack', function (cb) {
    return gulp.src(['./**', '!./publish', '!./node_modules/**', '!./node_modules', '!./package.json', '!./gulpfile.js', '!./composer.lock'])
        .pipe(zip(filename))
        .pipe(gulp.dest('./publish'));
});
gulp.task('publish', gulp.series('publish_clear', 'publish_pack'));

// Task Default
gulp.task('default', gulp.series('clear', 'version', gulp.parallel('publish')));

//const fs = require('fs');
//// Function
//function version() {
//    return JSON.parse(fs.readFileSync('./composer.json', 'utf8')).version;
//};