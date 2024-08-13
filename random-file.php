<?php
/**
 * Plugin Name: Random File
 * Version:     2.0
 * Plugin URI:  https://coffee2code.com/wp-plugins/random-file/
 * Author:      Scott Reilly
 * Author URI:  https://coffee2code.com/
 * Text Domain: random-file
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Description: Retrieve the name, path, or link to a randomly chosen file or files in a specified directory.
 *
 * Compatible with WordPress 2.8 through 6.6+.
 *
 * =>> Read the accompanying readme.txt file for instructions and documentation.
 * =>> Also, visit the plugin's homepage for additional information and updates.
 * =>> Or visit: https://wordpress.org/plugins/random-file/
 *
 * @package Random_File
 * @author  Scott Reilly
 * @version 2.0
 */

/*
	Copyright (c) 2004-2024 by Scott Reilly (aka coffee2code)

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

defined( 'ABSPATH' ) or die();

if ( ! function_exists( 'c2c_random_file' ) ):

/**
 * Retrieves the name, path, or link to a randomly chosen file in a specified
 * directory.
 *
 * Details on the acceptable values for $reftype:
 *
 *   'relative' => A location relative to the primary domain:
 *      /journal/random/randomfile.txt
 *      [This is the default setting as it is the most applicable.  Relative
 *      referencing is necessary if the random file is to be used as an
 *      argument to include() or virtual().  It's also a valid way to reference
 *      a file for A HREF= and IMG SRC= linking.]
 *
 *   'absolute' => An absolute location relative to the root of the server's
 *      file system:
 *      /usr/local/htdocs/example.com/www/journal/random/randomfile.txt
 *
 *   'url' => The URL of the random file:
 *      https://example.com/journal/random/randomfile.txt
 *      [If you desire the use of full URL, i.e. for A HREF= or IMG SRC= link.]
 *
 *   'filename' => The filename of the random file:
 *      randomefile.txt
 *
 *   'hyperlink' => The filename of the random file hyperlinked to that random file:
 *      <a href='https://example.com/journal/random/randomfile.txt' title='randomfile.txt'>randomfile.txt</a>
 *
 * @param  string $dir        The directory (relative to the root of the site)
 *                            containing the files to be random chosen from.
 * @param  string[]|string $extensions Optional. An array, or space-separated list,
 *                            of file extensions, one of which the chosen file must
 *                            have. (Case insensitive.) Default empty array.
 * @param  string $reftype    Optional. One of: absolute, filename, hyperlink,
 *                            relative, or url.  Default 'relative'.
 * @param  array  $exclusions Optional. Filenames to exclude from consideration
 *                            as a random file. Default empty array.
 * @return string|false The random file chosen, or false if no file was found.
 */
function c2c_random_file( $dir, $extensions = array(), $reftype = 'relative', $exclusions = array() ) {
	$files   = array();
	$i       = -1;
	$pattern = '/.*';

	if ( ! empty( $extensions ) ) {
		if ( is_string( $extensions ) ) {
			$extensions = explode( ' ', $extensions );
		}
		$exts = array_map( '__c2c_random_file__sanitize_extension', (array) $extensions );
		$pattern .= '\.(' . implode( '|', $exts ) . ')';
	}
	$pattern .= '$/i';

	$dir     = trim( $dir, '/' );
	$abs_dir = ABSPATH . $dir;

	if ( ! file_exists( $abs_dir ) ) {
		return false;
	}

	$handle = @opendir( $abs_dir );
	if ( false === $handle ) {
		return false;
	}

	$exclusions = empty( $exclusions ) ? array() : array_map( 'basename', (array) $exclusions );

	while ( false != ( $file = readdir( $handle ) ) ) {
		if ( is_file( $abs_dir . '/' . $file ) && preg_match( $pattern, $file ) && ! in_array( $file, $exclusions ) ) {
			$files[] = $file;
			++$i;
		}
	}

	closedir( $handle );

	if ( empty( $files ) ) {
		return false;
	}
	
	$rand = wp_rand( 0, $i );

	if ( ! empty( $dir ) ) {
		$dir .= '/';
	}

	$random_file = $files[ $rand ];

	if ( in_array( $reftype, array( 'hyperlink', 'url' ) ) ) {
		$url = trailingslashit( get_option( 'siteurl' ) ) . $dir . $random_file;
	}

	switch ( $reftype ) {
		case 'absolute':
			return $abs_dir . DIRECTORY_SEPARATOR . $random_file; /* could also do realpath($random_file); */
		case 'filename':
			return $random_file;
		case 'hyperlink':
			return sprintf(
				'<a href="%s" title="%s">%s</a>',
				esc_url( $url ),
				esc_attr( $random_file ),
				esc_html( $random_file )
			);
		case 'url':
			return $url;
		case 'relative':
		default:
			// Need to obtain location relative to root of domain (in case site is based out of subdirectory)
			preg_match( "/^(https?:\/\/)?([^\/]+)\/?(.+)?$/", get_option( 'siteurl' ), $matches );
			$relpath = isset( $matches[3] ) ? '/' . $matches[3] : '';
			return $relpath . '/' . $dir . $random_file;
	}
} //end c2c_random_file()

add_filter( 'c2c_random_file', 'c2c_random_file', 10, 4 );

endif;

/**
 * Sanitizes a file extension string before use.
 *
 * Currently:
 * - Strips surrounding whitespace
 * - Strips leading period, in case something like ".jpg" is provided
 * - Escapes regular expression characters that may be present
 *
 * @access private
 *
 * @param string $extension The file extension to sanitize.
 * @return string
 */
function __c2c_random_file__sanitize_extension( $extension ) {
	$extension = ltrim( trim( $extension ), '.' );
	return preg_quote( $extension, '/' );
}

if ( ! function_exists( 'c2c_random_files' ) ) :

/**
 * Retrieves the name, path, or link to a specified number of randomly chosen
 * files in a specified directory.
 *
 * Note: the number of files returned will be UP TO the specified number.
 * Obviously, if the directly has less than that number of files, then
 * only those files can be returned
 *
 * (see docs for c2c_random_file() for more details regarding values for
 * arguments)
 *
 * @param  int    $number     The number of random files to select from the
 *                            specified directory.
 * @param  string $dir        The directory (relative to the root of the site)
 *                            containing the files to be random chosen from.
 * @param  string[]|string $extensions Optional. An array, or space-separated list,
 *                            of file extensions, one of which the chosen file must
 *                            have. (Case insensitive.) Default empty array.
 * @param  string $reftype    Optional. One of: absolute, filename, hyperlink,
 *                            relative, or url. Default 'relative'.
 * @param  array  $exclusions Optional. Filenames to exclude from consideration
 *                            as a random file. Default empty array.
 * @return string[] The random files chosen.
 */
function c2c_random_files( $number, $dir, $extensions = array(), $reftype = 'relative', $exclusions = array() ) {
	$number     = absint( $number );
	$exclusions = (array) $exclusions;
	$files      = array();
	for ( $i = 0; $i < $number; $i++ ) {
		$f = c2c_random_file( $dir, $extensions, $reftype, $exclusions );
		if ( ! $f ) {
			break;
		}
		$files[]      = $f;
		$exclusions[] = $f;
	}
	return $files;
}

add_filter( 'c2c_random_files', 'c2c_random_files', 10, 5 );

endif;
