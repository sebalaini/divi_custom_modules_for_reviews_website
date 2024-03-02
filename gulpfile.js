const { series, parallel, src, dest, watch } = require('gulp');

const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const strip = require('gulp-strip-comments');
const concat = require('gulp-concat');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const prefix = require('gulp-autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const headerComment = require('gulp-header-comment');

const themeBasePath = './wordpress/wp-content/themes/Divi-child';
const paths = {
  js: themeBasePath + '/js/main.js',
  sassFolder: themeBasePath + '/scss/',
  sass: themeBasePath + '/scss/main.scss',
};

/**
 * MAIN
 */
function mainScss() {
  return src([paths.sass])
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.init())
    .pipe(cleanCSS())
    .pipe(prefix())
    .pipe(concat('style.css'))
    .pipe(headerComment(`
      Theme Name:     Divi Child
      Theme URI:      https://github.com/sebalaini/divi_custom_modules_for_reviews_website/
      Description:    Divi Child Theme
      Author:         sebalaini
      Author URI:     https://github.com/sebalaini/
      Template:       Divi
      Version:        1.0.0
    `))
    .pipe(sourcemaps.write('.'))
    .pipe(dest(themeBasePath));
}

function mainJs() {
  return src(paths.js).pipe(strip()).pipe(babel()).pipe(uglify()).pipe(concat('theme.js')).pipe(dest(themeBasePath));
}

/**
 * WATCH
 */
function watchtask() {
  watch(paths.sassFolder, mainScss);
  watch(paths.js, mainJs);
}

/**
 * TASKS
 */
exports.default = series(parallel(mainScss, mainJs));
exports.sass = series(parallel(mainScss));
exports.watch = series(parallel(watchtask, mainJs));
