=== Random File ===
Contributors: coffee2code
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6ARCFJ9TX3522
Tags: random, file, coffee2code
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Requires at least: 2.8
Tested up to: 5.8
Stable tag: 1.8.11

Retrieve the name, path, or link to a randomly chosen file or files in a specified directory.


== Description ==

This plugin provides template tags that allow you to retrieve the name, path (relative or absolute), url, or fully marked-up link to a randomly chosen file or files in a specified directory.

Arguments to the functions permit you to specify limit what file(s) can be randomly selected based on a given set of file extensions. You can also explicitly specify files that should not be randomly selected.

This functionality can be useful for displaying random images/logos or including text from random files onto your site (writing excerpts, multi-line quotes, etc). Other ideas: random ads, random CSS files, random theme template selection.

Notes:

* If you want to actually display the name of the random file, be sure to 'echo' the results:
`<?php echo c2c_random_file( '/random' ); ?>`

* Unless you limit the file search to only include a particular extension (via `$extensions` argument), all files in the specified `$dir` will be under consideration for random selection

* Can be run inside or outside of "the loop"

Links: [Plugin Homepage](https://coffee2code.com/wp-plugins/random-file/) | [Plugin Directory Page](https://wordpress.org/plugins/random-file/) | [GitHub](https://github.com/coffee2code/random-file/) | [Author Homepage](https://coffee2code.com)


== Installation ==

1. Install via the built-in WordPress plugin installer. Or download and unzip `random-file.zip` inside the plugins directory for your site (typically `wp-content/plugins/`)
1. Activate the plugin through the 'Plugins' admin menu in WordPress
1. Make use of the `c2c_random_file()` or `c2c_random_files()` template function in your code or template (see examples below).


== Frequently Asked Questions ==

= Does this plugin do dynamic random rotation within a loaded page (i.e. randomly rotating images within a loaded page)? =

No. This plugin only selects a random file when the page is loaded. Once loaded, it does not currently add any dynamic functionality to automatically retrieve another random file on its own.

= Does this plugin include unit tests? =

Yes.


== Template Tags ==

The plugin provides two optional template tag for use in your theme templates.

= Functions =

* `<?php function c2c_random_file( $dir, $extensions = '', $reftype = 'relative', $exclusions = array() ) ?>`
This retrieves the name of a random file from a specified directory and returns information based on the file according to the `$reftype` value.

* `<?php function c2c_random_files( $number, $dir, $extensions = '', $reftype = 'relative', $exclusions = array() ) ?>`
This retrieves the name, path, or link to a specified number of randomly chosen files in a specified directory. All but the `$number` argument are passed along in calls to `c2c_random_file()`.

= Arguments =

* `$number` (only for `c2c_random_files()`)
The number of random files to select from the specified directory. If less files are present in the specified directory, then all files in the directory will be returned (but will be listed in random order).

* `$dir`
The directory to search for a random file. The directory must exist at the directory structure level of your WordPress installation or below. (i.e., if your site is installed on your server at `/usr/local/htdocs/example.com/www/journal/`, then the directory of random files you specified will assume that as its base... so a value of `'randomfiles'` would be assumed to actually be: `/usr/local/htdocs/example.com/www/journal/randomfiles/`)

* `$extensions`
Optional argument. A space-separated list of extensions (case insensitive), i.e. 'jpg gif png jpeg'.

* `$reftype`
Optional argument. Can be one of the following: 'relative' (which is the default), 'absolute', 'url', 'filename', 'hyperlink'. See Examples section for more details and examples.

* `$exclusions`
Optional argument. If specified, MUST be an array of filenames to exclude from consideration as a random file.

= Examples =

* The reference to the randomly selected file can be returned in one of five ways:
[Assume your WordPress installation is at https://example.com/journal/ and you've invoked `c2c_random_file('random/', 'txt', $reftype)`]

	$reftype = 'relative'

	=> A location relative to the primary domain:

    `/journal/random/randomfile.txt`

	[This is the default setting as it is the most applicable. Relative referencing is necessary if the random file is to be used as an argument to include() or virtual(). It's also a valid way to reference a file for A HREF= and IMG SRC= linking.]

    `$reftype = 'absolute'`

	=> An absolute location relative to the root of the server's file system:

    `/usr/local/htdocs/example.com/www/journal/random/randomfile.txt`

	$reftype = 'url'

	=> The URL of the random file:

    `https://example.com/journal/random/randomfile.txt`

	[If you desire the use of full URL, such as for a A HREF= or IMG SRC= link.]

	$reftype = 'filename'

	=> The filename of the random file:

    `randomefile.txt`
	
	$reftype = 'hyperlink'

	=> The filename of the random file hyperlinked to that random file:

    `<a href='https://example.com/journal/random/randomfile.txt' title='randomfile.txt'>randomfile.txt</a>`

* Include random logo or image on your site:

    `<img alt="logo" class="logo" src="<?php echo c2c_random_file( 'wp-content/images/logos/' ); ?>" />`

* Insert text from a random file (i.e. for random multi-line quotes) (Apache web-server only, probably):

`
<div class="todayquote">
   <?php virtual( c2c_random_file( 'quotes/', 'txt' ) ); ?>
</div>
`

* If you wanted to source a random .php file:

    `<?php include( c2c_random_file( '/randomphp', 'php' ) ); ?>`

* List 5 random files:

`
<ul>
	<?php
		$random_files = c2c_random_files( 5, 'wp-content/files' );
		foreach ( $random_files as $f ) {
			echo "<li>$f</li>";
		}
	?>
</ul>
`


== Hooks ==

The plugin exposes two filters for hooking. Typically, customizations utilizing these hooks would be put into your active theme's functions.php file, or used by another plugin.

**c2c_random_file (filter)**

The 'c2c_random_file' hook allows you to use an alternative approach to safely invoke `c2c_random_file()` in such a way that if the plugin were deactivated or deleted, then your calls to the function won't cause errors in your site.

Arguments:

* same as for `c2c_random_file()`

Example:

Instead of:

`<?php $file = c2c_random_file( 'wp-content/randomfiles' ); ?>`

Do:

`<?php $file = apply_filters( 'c2c_random_file', 'wp-content/randomfiles' ); ?>`

**c2c_random_files (filter)**

The 'c2c_random_files' hook allows you to use an alternative approach to safely invoke `c2c_random_files()` in such a way that if the plugin were deactivated or deleted, then your calls to the function won't cause errors in your site.

Arguments:

* same as for `c2c_random_files()`

Example:

Instead of:

`<?php $files = c2c_random_files( 5, 'wp-content/randomfiles' ); ?>`

Do:

`<?php $files = apply_filters( 'c2c_random_files', 5, 'wp-content/randomfiles' ); ?>`



== Changelog ==

= 1.8.11 (2021-09-18) =
* Change: Note compatibility through WP 5.8+
* Unit tests:
    * Change: Restructure unit test directories
        * Change: Move `phpunit/` into `tests/`
        * Change: Move `phpunit/bin` into `tests/`
    * Change: Remove 'test-' prefix from unit test file
    * Change: In bootstrap, store path to plugin file constant
    * Change: In bootstrap, add backcompat for PHPUnit pre-v6.0

= 1.8.10 (2021-04-23) =
* Change: Note compatibility through WP 5.7+
* Change: Update copyright date (2021)

= 1.8.9 (2020-08-31) =
* New: Add TODO.md and move existing TODO list from top of main plugin file into it
* Change: Restructure unit test file structure
    * New: Create new subdirectory `phpunit/` to house all files related to unit testing
    * Change: Move `bin/` to `phpunit/bin/`
    * Change: Move `tests/bootstrap.php` to `phpunit/`
    * Change: Move `tests/` to `phpunit/tests/`
    * Change: Rename `phpunit.xml` to `phpunit.xml.dist` per best practices
* Change: Note compatibility through WP 5.5+
* New: Add FAQ indicating presence of unit tests
* Change: Unit tests: Change regex delimiters from `/` to `~` to avoid having to escape frequent use of `/` in patterns

_Full changelog is available in [CHANGELOG.md](https://github.com/coffee2code/random-file/blob/master/CHANGELOG.md)._


== Upgrade Notice ==

= 1.8.11 =
Trivial update: noted compatibility through WP 5.8+ and minor reorganization and tweaks to unit tests

= 1.8.10 =
Trivial update: noted compatibility through WP 5.7+ and updated copyright date (2021).

= 1.8.9 =
Trivial update: Restructured unit test file structure, added a TODO.md file, and noted compatibility through WP 5.5+.

= 1.8.8 =
Trivial update: Updated a few URLs to be HTTPS and noted compatibility through WP 5.4+.

= 1.8.7 =
Trivial update: noted compatibility through WP 5.3+ and updated copyright date (2020)

= 1.8.6 =
Trivial update: modernized unit tests, noted compatibility through WP 5.2+

= 1.8.5 =
Trivial update: noted compatibility through WP 5.1+, updated copyright date (2019)

= 1.8.4 =
Trivial update: noted compatibility through WP 4.9+, added README.md for GitHub, and updated copyright date (2018)

= 1.8.3 =
Recommended minor update: fixed inccorect name of variable, noted compatibility through WP 4.7+, updated copyright date

= 1.8.2 =
Trivial update: noted compatibility through WP 4.4+ and updated copyright date (2016)

= 1.8.1 =
Trivial update: noted compatibility through WP 4.1+ and updated copyright date (2015)

= 1.8 =
Recommended minor update: fixed bug which prevented specified multiple file extensions from working; added unit tests; noted compatibility through WP 3.8+

= 1.7.1 =
Trivial update: noted compatibility through WP 3.5+

= 1.7 =
Recommended minor update: improved compatibility and data sanitization; noted compatibility through WP 3.4+; explicitly stated license

= 1.6.2 =
Trivial update: noted compatibility through WP 3.3+

= 1.6.1 =
Trivial update: noted compatibility through WP 3.2+

= 1.6 =
Feature update. Highlights: added c2c_random_files() to retrieve array of random unique files; added hooks to allow customizations; verified WP 3.0 compatibility.
