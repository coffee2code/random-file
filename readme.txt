=== Random File ===
Contributors: coffee2code
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6ARCFJ9TX3522
Tags: random, file, coffee2code
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Requires at least: 2.8
Tested up to: 6.6
Stable tag: 2.0

Retrieve the name, path, or link to a randomly chosen file or files in a specified directory.


== Description ==

This plugin provides template tags that allow you to retrieve the name, path (relative or absolute), url, or fully marked-up link to a randomly chosen file or files in a specified directory.

Arguments to the functions permit you to limit what file(s) can be randomly selected based on a given set of file extensions. You can also explicitly specify files that should not be randomly selected.

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

Yes. The tests are not packaged in the release .zip file or included in plugins.svn.wordpress.org, but can be found in the [plugin's GitHub repository](https://github.com/coffee2code/configure-smtp/).


== Developer Documentation ==

Developer documentation can be found in [DEVELOPER-DOCS.md](https://github.com/coffee2code/random-file/blob/master/DEVELOPER-DOCS.md). That documentation covers the template tags and hooks provided by the plugin.

As an overview, these are the template tags provided by the plugin:

* `c2c_random_file()`  : Retrieves the name of a random file from a specified directory and returns information based on the file.
* `c2c_random_files()` : Retrieves the name, path, or link to a specified number of randomly chosen files in a specified directory.

Theses are the hooks provided by the plugin:

* `c2c_random_file`  : Filter to safely invoke `c2c_random_file()` in such a way that if the plugin were deactivated or deleted, then your calls to the function won't cause errors in your site.
* `c2c_random_files` : Filter to safely invoke `c2c_random_files()` in such a way that if the plugin were deactivated or deleted, then your calls to the function won't cause errors in your site.


== Changelog ==

= 2.0 (2024-08-13) =
Highlights:

This minor update features improved randomization of file selection, adds support for the extensions arugment to be an array, notes compatibility through WP 6.6+, removes unit tests from release packaging, updates copyright date (2024), and other code improvements and minor changes.

Details:

* Change: Switch to using `wp_rand()` for more reliable randomization
* Change: Allow `$extensions` argument to also accept an array of extensions
* Change: Strip surrounding whitespace and leading periods from provided extensions
* Change: Explicitly return false if no file could be found
* Change: Switch to use a switch statement, which is more concise
* Change: Use cleaner `sprintf()` approach to outputting markup
* Hardening: Escape text shown via 'hyperlink' output (though it's never anything other than plaintext)
* Change: Note compatibility through WP 6.6+
* Change: Update copyright date (2024)
* Change: Tweak filter descriptions in `readme.txt`
* New: Add `.gitignore` file
* Change: Remove development and testing-related files from release packaging
* Unit tests:
    * Hardening: Prevent direct web access to `bootstrap.php`
    * Allow tests to run against current versions of WordPress
    * New: Add more unit tests
    * New: Add `composer.json` for PHPUnit Polyfill dependency
    * Change: In bootstrap, store path to plugin directory in a constant
    * Change: Rename a test

= 1.8.12 (2023-05-21) =
* New: Add DEVELOPER-DOCS.md and move hooks documentation into it
* Change: Note compatibility through WP 6.3+
* Change: Update copyright date (2023)

= 1.8.11 (2021-09-18) =
* Change: Note compatibility through WP 5.8+
* Unit tests:
    * Change: Restructure unit test directories
        * Change: Move `phpunit/` into `tests/`
        * Change: Move `phpunit/bin` into `tests/`
    * Change: Remove 'test-' prefix from unit test file
    * Change: In bootstrap, store path to plugin file constant
    * Change: In bootstrap, add backcompat for PHPUnit pre-v6.0

_Full changelog is available in [CHANGELOG.md](https://github.com/coffee2code/random-file/blob/master/CHANGELOG.md)._


== Upgrade Notice ==

= 2.0 =
Minor update: improved randomization of file selection, added support for the extensions arugment to be an array, noted compatibility through WP 6.6+, removed unit tests from release packaging, updated copyright date (2024), and other code improvements and minor changes

= 1.8.12 =
Trivial update: added DEVELOPER-DOCS.md, noted compatibility through WP 6.3+, and updated copyright date (2023)

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
