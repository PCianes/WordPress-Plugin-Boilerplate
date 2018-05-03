# WordPress Plugin Boilerplate

A standardized, organized, object-oriented foundation for building high-quality WordPress Plugins.

## Contents

The WordPress Plugin Boilerplate includes the following files:

* `.gitignore`. Used to exclude certain files from the repository.
* `CHANGELOG.md`. The list of changes to the core project.
* `README.md`. The file that you’re currently reading.
* A `plugin-name` directory that contains the source code - a fully executable WordPress plugin.

## Features

* The Boilerplate is based on the [Plugin API](http://codex.wordpress.org/Plugin_API), [Coding Standards](http://codex.wordpress.org/WordPress_Coding_Standards), and [Documentation Standards](https://make.wordpress.org/core/handbook/best-practices/inline-documentation-standards/php/).
* All classes, functions, and variables are documented so that you know what you need to change.
* The Boilerplate uses a strict file organization scheme that corresponds both to the WordPress Plugin Repository structure, and that makes it easy to organize the files that compose the plugin.
* The project includes a `.pot` file as a starting point for internationalization.

* New file `make` to work with the console (into plugin-name folder):
	- `php make zip` to make a clean copy of the plugin into zip
	- `php make class CLASS-NAME FOLDER-NAME` to create a new file into the `FOLDER-NAME` indicate
	with the name: `class-plugin-name-CLASS-NAME.php` with some base code to start to work

* Auto generation of some utilities with console (into plugin-name folder):
	- `grunt` to make auto the `plugin-name.pot` into the folder `languages`
	- `gulp` to start `test mode` in console and run all the test into `tests folder`
	in auto mode when a file of the project is save it
	- Note: for both you need run before in console `npm install` & `composer install`

* PHP CodeSniffer with WordPress standards:
    - You can check te code with WordPress standards with `squizlabs/php_codesniffer` & `wp-coding-standards/wpcs` already included with only make `composer-install`.
    - After that to configure it set `vendor/bin/phpcs --config-set installed_paths vendor/wp-coding-standards/wpcs`.
    - And also set `vendor/bin/phpcs --config-set default_standard WordPress`.
    - If you have some software like `Visual Studio Code` (is free) and module like `vscode-phpcs` or similars, you can see the problems in the code during your work in auto mode. In another case you can do the same and see the problems in console with `vendor/bin/phpcs /path/to/code/file-name.php` or `vendor/bin/phpcs /path/to/code/folder-name`
    - IMPORTANT: You can also solve most problems automatically by applying `phpcbf` instead of `phpcs` like `vendor/bin/phpcbf /path/to/code/file-name.php` or `vendor/bin/phpcbf /path/to/code/folder-name`

* DEV MODE:
    - The `admin bar` into WordPress dashboard put into different color and with a tag `DEV MODE` when you active `composer install` and some features to DEV with that.
	- Into dashboard page `index.php` of the backend you can see a notice with some information about all you can do in dev mode like:
		- Pretty error interface with Whoops. To see it in action just make a fatal error. ;-)
		- Kint debugging helper. Inside your code insted of use var_dump($variable); try to use d( $variable ); for amazing debug.
	- Into `tests folder` you have new file to test into different database wich you can setup with the file `wp-tests-config.php`
	and the file `bootstrap.php` that execute the code to run and manually load the enviroment to test. Check also in the root of the plugin the file `phpunit.xml` to understad all the configuration about it.

## Installation

* The best choice is go to `https://boilerplate.pablocianes.com/` and make it easy with a plugin generator base on all this code and your custom personalization in auto mode.

The Boilerplate can be installed directly into your plugins folder "as-is". You will want to rename it and the classes inside of it to fit your needs. For example, if your plugin is named 'example-me' then:

* rename files from `plugin_name` to `example_me`
* change `plugin_name` to `example_me`
* change `PLUGIN_NAME_` to `EXAMPLE_ME_`

It's safe to activate the plugin at this point. Because the Boilerplate has no real functionality there will be no menu items, meta boxes, or custom post types added until you write the code.

## WordPress.org Preparation

- `grunt` to make auto the `plugin-name.pot` into the folder `languages`

## Recommended Tools

### i18n Tools

The WordPress Plugin Boilerplate uses a variable to store the text domain used when internationalizing strings throughout the Boilerplate. To take advantage of this method, there are tools that are recommended for providing correct, translatable files:

* [Poedit](http://www.poedit.net/)
* [makepot](http://i18n.svn.wordpress.org/tools/trunk/)
* [i18n](https://github.com/grappler/i18n)

Any of the above tools should provide you with the proper tooling to internationalize the plugin.

## License

The WordPress Plugin Boilerplate is licensed under the GPL v2 or later.

> This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License, version 2, as published by the Free Software Foundation.

> This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

> You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA

A copy of the license is included in the root of the plugin’s directory. The file is named `LICENSE`.

## Important Notes

### Licensing

The WordPress Plugin Boilerplate is licensed under the GPL v2 or later; however, if you opt to use third-party code that is not compatible with v2, then you may need to switch to using code that is GPL v3 compatible.

For reference, [here's a discussion](http://make.wordpress.org/themes/2013/03/04/licensing-note-apache-and-gpl/) that covers the Apache 2.0 License used by [Bootstrap](http://twitter.github.io/bootstrap/).

### Includes

Note that if you include your own classes, or third-party libraries, there are three locations in which said files may go:

* `plugin-name/core` is for all core and loader functionality
* `plugin-name/admin` is for all admin-specific functionality
* `plugin-name/public` is for all public-facing functionality
* `plugin-name/includes` is where functionality shared between the admin area and the public-facing parts of the site reside -> here we can put libraries and helpers

Note that previous versions of the Boilerplate did not include `Plugin_Name_Loader` but this class is used to register all filters and actions with WordPress.

The example code provided shows how to register your hooks with the Loader class.

### What About Other Features?

The previous version of the WordPress Plugin Boilerplate included support for a number of different projects such as the [GitHub Updater](https://github.com/afragen/github-updater).

These tools are not part of the core of this Boilerplate, as I see them as being additions, forks, or other contributions to the Boilerplate.

The same is true of using tools like Grunt, Composer, etc. These are all fantastic tools, but not everyone uses them. In order to  keep the core Boilerplate as light as possible, these features have been removed and will be introduced in other editions, and will be listed and maintained on the project homepage.

# Credits

The WordPress Plugin Boilerplate was started in 2011 by [Tom McFarlin](http://twitter.com/tommcfarlin/) and has since included a number of great contributions. In March of 2015 the project was handed over by Tom to Devin Vinson.

The current version of the Boilerplate was developed in conjunction with [Josh Eaton](https://twitter.com/jjeaton), [Ulrich Pogson](https://twitter.com/grapplerulrich), and [Brad Vincent](https://twitter.com/themergency).

The homepage is based on a design as provided by [HTML5Up](http://html5up.net), the Boilerplate logo was designed by Rob McCaskill of [BungaWeb](http://bungaweb.com), and the site `favicon` was created by [Mickey Kay](https://twitter.com/McGuive7).

## Documentation, FAQs, and More

If you’re interested in writing any documentation or creating tutorials please [let me know](http://devinvinson.com/contact/) .
