require 'compass/import-once/activate'
require 'fileutils'
add_import_path "bower_components/foundation/scss"

http_path = "/"
css_dir = "css"
sass_dir = "scss"
images_dir = "img"
javascripts_dir = "js"

output_style = :compact #:expanded # or :nested or :compact or :compressed

# relative_assets = true
line_comments = false


# preferred_syntax = :sass
# and then run:
# sass-convert -R --from scss --to sass sass scss && rm -rf sass && mv scss sass
