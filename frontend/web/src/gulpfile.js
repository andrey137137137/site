const gulp = require("gulp"),
  $gp = require("gulp-load-plugins")(),
  del = require("del"),
  cssnext = require("postcss-cssnext"),
  short = require("postcss-short"),
  shortText = require("postcss-short-text"),
  shortBorder = require("postcss-short-border"),
  pathes = {
    src: ".",
    dest: "..",
    css: {
      src: "/scss",
      dest: "/css",
    },
  };

for (path in pathes) {
  if (!pathes[path].src) continue;

  pathes[path].src = pathes.src + pathes[path].src;
  pathes[path].dest = pathes.dest + pathes[path].dest;
}

function clean() {
  return del([pathes.css.dest + "/*"], { force: true });
}

function css() {
  var plugins = [
    // precss(),
    cssnext(),
    // colorAlpha(),
    short(),
    // shortFont(),
    shortText(),
    shortBorder(),
    // assets({
    //   loadPaths: [pathes.images.dest]
    // }),
    // minmax(),
    // autoprefixer({browsers: ['last 2 version']}),
    // cssnano()
  ];

  return (
    gulp
      .src(pathes.css.src + "/main.scss")
      .pipe($gp.plumber())
      // .pipe(cssGlobbing())
      .pipe($gp.sass().on("error", $gp.sass.logError))
      .pipe($gp.postcss(plugins))
      // .pipe(autoprefixer({
      //   browsers: ['last 15 versions'],
      //   cascade: false
      // }))
      .pipe($gp.concatCss("bundle.css"))
      .pipe($gp.minifyCss())
      .pipe($gp.rename("style.min.css"))
      .pipe(gulp.dest(pathes.css.dest))
  );
}

function watch() {
  gulp.watch(pathes.css.src + "/**/**/*.scss", gulp.series(css));
}

exports.clean = clean;
exports.css = css;
exports.watch = watch;

gulp.task("default", gulp.series(clean, css, watch));
