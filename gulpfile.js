const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const cssmin = require("gulp-cssmin");
const concat = require("gulp-concat");
const uglify = require("gulp-uglify");

// Compile Sass to CSS
gulp.task("compile-sass", function () {
  return gulp
    .src("assets/scss/*.scss")
    .pipe(sass())
    .pipe(concat("styles.css"))
    .pipe(cssmin())
    .pipe(gulp.dest("assets/css"));
});

// Concatenate and minify JavaScript
gulp.task('scripts', function () {
  return gulp.src('assets/js/*.js')
    .pipe(concat('main.js'))
    .pipe(uglify())
    .pipe(gulp.dest('assets/js'));
});

// Watch for changes and run tasks
gulp.task("watch", function () {
  gulp.watch("assets/scss/*.scss", gulp.series("compile-sass"));
  gulp.watch("assets/js/*.js", gulp.series("scripts"));
});

// Default task (runs all specified tasks)
gulp.task("default", gulp.series("compile-sass", "scripts", "watch"));
