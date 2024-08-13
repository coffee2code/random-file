# Developer Documentation

This plugin provides [hooks](#hooks) and [template tags](#template-tags).

## Template Tags

The plugin provides two template tags for use in your theme templates, functions.php, or plugins.

### Functions:

* `<?php function c2c_random_file( $dir, $extensions = array(), $reftype = 'relative', $exclusions = array() ) ?>`
This retrieves the name of a random file from a specified directory and returns information based on the file according to the `$reftype` value.
* `<?php function c2c_random_files( $number, $dir, $extensions = array(), $reftype = 'relative', $exclusions = array() ) ?>`
This retrieves the name, path, or link to a specified number of randomly chosen files in a specified directory. All but the `$number` argument are passed along in calls to `c2c_random_file()`.

### Arguments:

* `$number` _(int)_ (only for `c2c_random_files()`)
Required. The number of random files to select from the specified directory. If less files are present in the specified directory, then all files in the directory will be returned (but will be listed in random order).

* `$dir` _(string)_
The directory to search for a random file. The directory must exist at the directory structure level of your WordPress installation or below. (i.e., if your site is installed on your server at `/usr/local/htdocs/example.com/www/journal/`, then the directory of random files you specified will assume that as its base... so a value of `'randomfiles'` would be assumed to actually be: `/usr/local/htdocs/example.com/www/journal/randomfiles/`)

* `$extensions` _(string[] | string)_
Optional argument. An array, or space-separated list, of file extensions (case insensitive), one of which the chosen random file must have, i.e. 'jpg gif png jpeg'. By default the random file can have any extension.

* `$reftype` _(string)_
Optional argument. Can be one of the following: 'relative' (which is the default), 'absolute', 'url', 'filename', 'hyperlink'. See Examples section for more details and examples.

* `$exclusions` _(string[])_
Optional argument. If specified, MUST be an array of filenames to exclude from consideration as a random file.

### Examples:

* The reference to the randomly selected file can be returned in one of five ways:
_Examples assume your WordPress installation is at https://example.com/journal/ and you've invoked `c2c_random_file('random/', 'txt', $reftype)`_
    * `$reftype = 'relative'` => A location relative to the primary domain:
    `/journal/random/randomfile.txt`
    [This is the default setting as it is the most applicable. Relative referencing is necessary if the random file is to be used as an argument to include() or virtual(). It's also a valid way to reference a file for A HREF= and IMG SRC= linking.]
    * `$reftype = 'absolute'`	=> An absolute location relative to the root of the server's file system:
    `/usr/local/htdocs/example.com/www/journal/random/randomfile.txt`
    * `$reftype = 'url'` => The full URL of the random file (useful for a A HREF= or IMG SRC= link):
    `https://example.com/journal/random/randomfile.txt`
    * `$reftype = 'filename'` => The filename of the random file:
    `randomefile.txt`
    * `$reftype = 'hyperlink'` => The filename of the random file hyperlinked to that random file:
    `<a href='https://example.com/journal/random/randomfile.txt' title='randomfile.txt'>randomfile.txt</a>`

* Include random logo or image on your site:

`<img alt="logo" class="logo" src="<?php echo c2c_random_file( 'wp-content/images/logos/' ); ?>" />`

* Insert text from a random file (i.e. for random multi-line quotes) (Apache web-server only, probably):

```php
<div class="todayquote">
   <?php virtual( c2c_random_file( 'quotes/', 'txt' ) ); ?>
</div>
```

* Include the source from a random .php file:

`<?php include( c2c_random_file( '/randomphp', 'php' ) ); ?>`

* List 5 random files:

```php
<ul>
	<?php
		$random_files = c2c_random_files( 5, 'wp-content/files' );
		foreach ( $random_files as $f ) {
			echo "<li>$f</li>";
		}
	?>
</ul>
```


## Hooks

The plugin exposes a number of filters for hooking. Code using these filters should ideally be put into a mu-plugin or site-specific plugin (which is beyond the scope of this readme to explain).

### `c2c_random_file` _(filter)_

The `c2c_random_file` hook allows you to use an alternative approach to safely invoke `c2c_random_file()` in such a way that if the plugin were deactivated or deleted, then your calls to the function won't cause errors in your site.

#### Arguments:

* same as for `c2c_random_file()`

#### Example:

Instead of:

`<?php $file = c2c_random_file( 'wp-content/randomfiles' ); ?>`

Do:

`<?php $file = apply_filters( 'c2c_random_file', 'wp-content/randomfiles' ); ?>`


### `c2c_random_files`_(filter)_

The `c2c_random_files` hook allows you to use an alternative approach to safely invoke `c2c_random_files()` in such a way that if the plugin were deactivated or deleted, then your calls to the function won't cause errors in your site.

#### Arguments:

* same as for `c2c_random_files()`

#### Example:

Instead of:

`<?php $files = c2c_random_files( 5, 'wp-content/randomfiles' ); ?>`

Do:

`<?php $files = apply_filters( 'c2c_random_files', 5, 'wp-content/randomfiles' ); ?>`
