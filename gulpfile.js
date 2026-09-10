const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const cssmin = require("gulp-cssmin");
const concat = require("gulp-concat");
const uglify = require("gulp-uglify");

// Compile Sass to CSS from the single entry point
gulp.task("compile-sass", function () {
  return gulp
    .src("assets/scss/main.scss")
    .pipe(sass().on("error", sass.logError))
    .pipe(concat("styles.css"))
    .pipe(cssmin())
    .pipe(gulp.dest("assets/css"));
});

// Concatenate and minify JavaScript from src/
gulp.task("scripts", function () {
  return gulp
    .src("assets/js/src/**/*.js")
    .pipe(concat("main.js"))
    .pipe(uglify())
    .pipe(gulp.dest("assets/js"));
});

// Watch for changes and run tasks
gulp.task("watch", function () {
  gulp.watch("assets/scss/**/*.scss", gulp.series("compile-sass"));
  gulp.watch("assets/js/src/**/*.js", gulp.series("scripts"));
});

// Default task (runs all specified tasks)
gulp.task("default", gulp.series("compile-sass", "scripts", "watch"));
