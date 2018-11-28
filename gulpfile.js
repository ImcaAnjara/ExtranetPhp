const gulp = require('gulp');
const browserSync = require('browser-sync');
const sass = require('gulp-sass');
/*


task('sass', function() {
  return gulp.src(['design/extranet/scss/*.scss']) // Gets all files ending with .scss in app/scss and children dirs
    .pipe(sass())
    .pipe(gulp.dest('design/extranet/css'))
    .pipe(browserSync.stream())
});


// watch & serve
.task('serve',['sass'], function(){
  gulp.watch(['design/extranet/scss/*.scss'], ['sass']); 
  // Other watchers
});

//
gulp.task('default',['serve']);
*/

function style(){

	return(
		gulp
		.src('design/extranet/scss/**/*.scss')
		.pipe(sass())
		.on("error", sass.logError)
		.pipe(gulp.dest('design/extranet/css'))

		)
}

function watch(){
    // gulp.watch takes in the location of the files to watch for changes
    // and the name of the function we want to run on change
    gulp.watch('design/extranet/scss/**/*.scss', style)
}

exports.style = style;
exports.watch = watch