# dmcstarter
Starter theme for DMC WordPress builds

### How do I get set up? ###

Install wp-cli, npm, grunt and bower (see Dependencies below)

* install WordPress core: `wp core download`
* add your project plugins to wp-content/plugins
* add your project uploads to wp-content/uploads
* add mu-plugins directory to wp-content: https://github.com/davemac/mu-plugins
* clone this theme to wp-content/themes
* create database (and user if needed): `wp db create`
* import database: `wp db import {your database name here}`
* install grunt plugins and bower packages: `npm install && bower install`
* run grunt to initially set up the JS & CSS for theme: `grunt`
* create minified vendor JS & CSS for theme (only needs to be run initially and if adding new bower packages): `grunt build bower`
* set jetpack debug mode in wp-config.php, so images are served locally etc: define( 'JETPACK_DEV_DEBUG', true);

### Dependencies ###

* wp-cli: https://wp-cli.org
* NPM (npm is bundled with node): brew install node (using homebrew) or https://www.npmjs.com/package/npm

Once NPM is installed, use it to install grunt and bower:

* Grunt: npm install -g grunt-cli
* Bower: npm install -g bower

### Deployment ###

* add your ssh public key to the server eg `ssh-copy-id -f -i 'id_rsa.pub' waxes-s`
* add an alias to ~/.sshconfig eg:
```
Host waxes-s
Hostname 158.106.189.151
user waxes
```
* modify the deploy task in Gruntfile.js, to match ssh theme directory and ssh aliaseg:
```
staging: {
		options: {
			src: "./build/",
			dest: "~/www/wp-content/themes/waxes",
			host: "waxes-s",
		}
	}
}
```

### Contribution guidelines ###

### Who do I talk to? ###

* Repo owner or admin
David McDonald info@dmcweb.com.au
