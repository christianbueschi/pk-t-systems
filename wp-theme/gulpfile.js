// Load plugins
var gulp 			= require('gulp'),
	sass 			= require('gulp-sass'),
	autoprefixer 	= require('gulp-autoprefixer'),
	minifycss 		= require('gulp-minify-css'),
	rename 			= require('gulp-rename'),
	concat 			= require('gulp-concat'),
	uglify 			= require('gulp-uglify'),
    bourbon    		= require("bourbon").includePaths,
    neat       		= require("bourbon-neat").includePaths,
	livereload 	 	= require('gulp-livereload'),
	appDefaults 	= {
		stylesInputDir : "app/frontend",
		stylesOutputDir : "_static/build/",
        scriptsInputDir : "app/",
        scriptsOutputDir : "_static/build/"
	};


// Styles
gulp.task('styles', function() {
	return gulp.src(appDefaults.stylesInputDir + "/styles.scss")
		.pipe(sass({
			style: 'compressed',
            includePaths: [bourbon, neat]
		}))
		.pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
		.pipe(gulp.dest(appDefaults.stylesOutputDir))
		.pipe(rename({ suffix: '.min' }))
		.pipe(minifycss())
		.pipe(gulp.dest(appDefaults.stylesOutputDir))
		.pipe(livereload());
});

// Scripts
gulp.task('scripts', function() {
    return gulp.src([appDefaults.scriptsInputDir + '/frontend/**/*.js', appDefaults.scriptsInputDir + '/NxModule/**/*.js'])
        .pipe(concat('scripts.js'))
        .pipe(gulp.dest(appDefaults.stylesOutputDir))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest(appDefaults.stylesOutputDir))
		.pipe(livereload());
});


// Watch
gulp.task('watch', function() {

	livereload.listen();

	// Watch .scss files
	gulp.watch(appDefaults.stylesInputDir+'/scss/**/*.scss', function(event) {
		console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
		gulp.run('styles');
	});

    // Watch .jsfiles
    gulp.watch(appDefaults.scriptsInputDir + '**/*.js', function(event) {
        console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
        gulp.run('scripts');
    });

});


// Default task
gulp.task('default', ['styles', 'scripts', 'watch']);