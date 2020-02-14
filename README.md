## Setting up a Wordpress local site for development

Install wp-cli, npm and grunt (see Dependencies below):

- assumes you have a copy of the staging database called `staging.sql`.
- assumes you have a ssh host called `dmcstarter-s` in ~/.ssh/config
- assumes the local site will be `https://dmcstarter.localhost`

* create a root directory to serve the site locally called `/dmcstarter`

- Run the following commands in the local site root directory:

* install WordPress core without content-directory: `wp core download --skip-content`
* rsync `wp-content/` directory from staging: `rsync -avzW --progress dmcstarter-s:~/www/wp-content .`
* clone this theme to `wp-content/themes/dmcstarter/`
* import staging database `wp db import staging.sql`
* update URLs in the database: `wp db search-replace "https://dmcstarter.com.au" "https://dmcstarter.localhost"`
* install debug plugins: `wp plugin install debug-bar query-monitor --activate`
* turn off seo indexing: `wp option update blog_public 0`
* sets the admin user password: `wp user update admin --user_pass={your password}`

Setting for `wp-config.php`:

```
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'SAVEQUERIES', true );
define( 'DISALLOW_FILE_EDIT', true );
define( 'JETPACK_DEV_DEBUG', true );
```

### Dependencies ###

* wp-cli: https://wp-cli.org

Global config for local `~/.wp-cli/config.yml`:

```
config create:
	dbuser: root
	dbpass:
	dbhost: localhost
	extra-php: |
        define( 'WP_DEBUG', true );
        define( 'SAVEQUERIES', true );
        define( 'DISALLOW_FILE_EDIT', true );
        define( 'WP_POST_REVISIONS', 5 );
        define( 'JETPACK_DEV_DEBUG', true );
core install:
	admin_user: admin
	admin_password: {your password}
	admin_email: info@davidmcdonald.org

core download:
    skip-plugins: hello

apache_modules:
    - mod_rewrite

rewrite structure:
    - hard
```

* NPM (bundled with node): `brew install node` (using homebrew on OS X)
or https://www.npmjs.com/package/npm

Once NPM is installed, use it to install grunt and bower:

* Grunt - task runner: `npm install -g grunt-cli`
* Bower - package manager: `npm install -g bower`

One time only, compile bower package dependencies into theme:

* `grunt buildbower`


### Compiling SCSS ###

- Run the following commands in the local site theme directory `/wp-content/themes/dmcstarter`:

* install grunt and grunt plugins: `npm install`
* run grunt to set up CSS & start compiling SCSS: `grunt`

Site is now running at https://dmcstarter.localhost
