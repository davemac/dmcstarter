# README #

This README would normally document whatever steps are necessary to get your application up and running.

### What is this repository for? ###

* WordPress theme for winedecoded.com.au

### How do I get set up? ###

Install wp-cli, npm, grunt and bower (see Dependencies below)

* install WordPress core: wp core download
* add project plugins to wp-content/plugins
* add project uploads to wp-content/uploads
* add mu-plugins directory to wp-content/
* install this theme git clone git@bitbucket.org:davemcd/winedecoded-theme.git wp-content/themes/wined
* create database (and user if needed): wp db create
* import database: wp db import {your database name here}
* update URLs in database: 'http://wined.localhost' 'http://{your localhost here}'
* install grunt, bower and all dependencies: npm install && bower install
* run grunt to initially set up the JS & CSS for theme: grunt
* create minified vendor JS & CSS for theme (only needs to be run initially and if adding new bower packages): grunt build bower

* set jetpack debug mode in wp-config.php, so images are served locally etc: define( 'JETPACK_DEV_DEBUG', true);

### Dependencies ###

* wp-cli: https://wp-cli.org
* NPM (npm is bundled with node): brew install node (using homebrew) or https://www.npmjs.com/package/npm

Once NPM is installed, use it to install grunt and bower:

* Grunt: npm install -g grunt-cli
* Bower: npm install -g bower


### Contribution guidelines ###

### Who do I talk to? ###

* Repo owner or admin
David McDonald info@dmcweb.com.au