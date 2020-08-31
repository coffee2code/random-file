# Changelog

## _(in-progress)_
* Change: Note compatibility through WP 5.5+

## 1.8.8 _(2020-05-04)_
* Change: Use HTTPS for link to WP SVN repository in bin script for configuring unit tests
* Change: Note compatibility through WP 5.4+
* Change: Update links to coffee2code.com to be HTTPS
* Change: Update examples in documentation to use a proper example URL

## 1.8.7 _(2019-12-15)_
* Change: Note compatibility through WP 5.3+
* Change: Update copyright date (2020)

## 1.8.6 _(2019-06-14)_
* New: Add CHANGELOG.md and move all but most recent changelog entries into it
* Change: Update unit test install script and bootstrap to use latest WP unit test repo
* Change: Note compatibility through WP 5.2+
* Fix: Correct typo in GitHub URL
* Change: Split paragraph in README.md's "Support" section into two

## 1.8.5 _(2019-02-18)_
* Change: Note compatibility through WP 5.1+
* Change: Update copyright date (2019)
* Change: Update License URI to be HTTPS

## 1.8.4 _(2018-04-09)_
* New: Add README.md
* Change: Minor whitespace tweaks to unit test bootstrap
* Change: Add GitHub link to readme
* Change: Note compatibility through WP 4.9+
* Change: Update copyright date (2018)
* Change: Rename readme.txt section from 'Filters' to 'Hooks'
* Change: Modify formatting of hook name in readme to prevent being uppercased when shown in the Plugin Directory
* Change: Update installation instruction to prefer built-in installer over .zip file

## 1.8.3 _(2017-02-15)_
* Fix: Use correct variable name when handling the 'hyperlink' reftype
* Change: Update unit test bootstrap
    * Default `WP_TESTS_DIR` to `/tmp/wordpress-tests-lib` rather than erroring out if not defined via environment variable
    * Enable more error output for unit tests
* Change: Note compatibility through WP 4.7+
* Change: Update copyright date (2017)

## 1.8.2 _(2016-03-22)_
* Change: Add 'Text Domain' to plugin header.
* Change: Explicitly declare methods in unit tests as public.
* Change: Minor inline documentation reformatting.
* New: Add LICENSE file.
* New: Add empty index.php to prevent files from being listed if web server has enabled directory listings.
* Change: Note compatibility through WP 4.4+.
* Change: Update copyright date (2016).

## 1.8.1 _(2015-02-16)_
* Minor plugin header reformatting
* Change documentation links to wp.org to be https
* Minor readme space formatting changes
* Note compatibility through WP 4.1+
* Update copyright date (2015)
* Add plugin icon

## 1.8 _(2014-01-11)_
* Add unit tests
* Fix bug to actually permit multiple extensions to be specified
* Change casting `$number` from `intval()` to `absint()` in `c2c_random_files()`
* Minor code changes (spacing, bracing)
* Note compatibility through WP 3.8+
* Update copyright date (2014)
* Minor readme.txt tweaks
* Change donate link
* Add banner

## 1.7.1
* Add check to prevent execution of code if file is directly accessed
* Note compatibility through WP 3.5+
* Update copyright date (2013)

## 1.7
* Use `DIRECTORY_SEPARATOR` instead of hardcoding '/' when determining absolute path
* Properly escape the attributes for the link markup
* `preg_quote()` the extensions
* Cast `$exclusions` arg to array before use
* Re-license as GPLv2 or later (from X11)
* Add 'License' and 'License URI' header tags to readme.txt and plugin file
* Minor code reformatting (spacing)
* Remove ending PHP close tag
* Note compatibility through WP 3.4+
* Drop support for versions of WP older than 2.8

## 1.6.2
* Note compatibility through WP 3.3+
* Add link to plugin directory page to readme.txt
* Add Upgrade Notice section to readme.txt
* Update copyright date (2012)

## 1.6.1
* Note compatibility through WP 3.2+
* Minor code formatting changes (spacing)
* Minor readme.txt formatting changes
* Add plugin homepage and author links in description in readme.txt
* Update copyright date (2011)

## 1.6
* Add `c2c_random_files()` to retrieve array of random unique files
* Add hooks 'c2c_random_file' (filter) and 'c2c_random_files' (filter) to respond to the function of the same name so that users can use the `apply_filters()` notation for invoking template tags
* Use `get_option()` instead of deprecated `get_settings()`
* Wrap functions in `if(!function_exists())` check
* Remove docs from top of plugin file (all that and more are in readme.txt)
* Tweak description
* Note compatibility with WP 3.0+
* Minor tweaks to code formatting (spacing)
* Add Filters and Upgrade Notice sections to readme.txt
* Remove trailing whitespace

## 1.5.2
* Add PHPDoc documentation
* Note compatibility with WP 2.9+
* Update copyright date
* Update readme.txt

## 1.5.1
* Fixed: missing '/' in path construction for reftype 'absolute'

## 1.5
* Added new reftype of 'hyperlink' to return the filename of the random file hyperlinked to that file
* Added error checking to avoid error when referenced directory does not exist
* Added error checking for when there is an error opening a directory
* Explicit handling of reftype 'absolute' in the code was actually supposed to be 'serverabsolute'
* Minor code tweaks
* Tweaked installation instructions
* Added readme.txt
* Noted and tested compatibility with WP 2.3.3 through 2.8

## 1.0
* Renamed function from `random_file()` to `c2c_random_file()`
* Added new reftype of 'filename'
* Added optional array argument $exceptions for files not to be considered in random file selection
* Updated license and examples
* Verified that plugin works in WP 1.5 (and still works in WP 1.2)

## 0.9
* Initial release
