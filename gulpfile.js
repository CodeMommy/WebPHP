// Config
const version = '1.0.1';

// Require
const del = require('del');
const gulp = require('gulp');
const zip = require('gulp-zip');
const bump = require('gulp-bump');
const git = require('gulp-git');

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


gulp.task('git-commit', function () {
    return gulp.src('.')
        .pipe(git.commit('Bumped version number'));
});

gulp.task('git-push', function (cb) {
    return git.push('origin', 'master', cb);
});

gulp.task('git-new-tag', function (cb) {
    return git.tag(version, 'Created Tag for version: ' + version, function (error) {
        if (error) {
            return cb(error);
        }
        return git.push('origin', 'master', {args: '--tags'}, cb);
    });

});

// Task Default
gulp.task('default', gulp.series('clear', 'version', 'git-commit','git-push','git-new-tag',gulp.parallel('publish')));

//const fs = require('fs');
//// Function
//function version() {
//    return JSON.parse(fs.readFileSync('./composer.json', 'utf8')).version;
//};