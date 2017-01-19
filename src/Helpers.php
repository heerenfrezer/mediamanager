<?php
/**
 * =========================================================
 *                  HEER EN FREZER B.V.
 *                      ------------
 *  Heer en Frezer is a company for producing fast, high-
 *  quality products for a good price. We build your ideas
 *  into something you can touch.
 *                      ------------
 *                     Oudeweg 91 - 95
 *                     _____unit F-0.3
 *                     2031 CC  HAARLEM
 *
 *                  [t] +31 85 75 00 415
 *                  [e] info@heerenfrezer.nl
 *                  [w] https://heerenfrezer.nl
 * =========================================================
 *
 * File: Helpers.php
 * Date: 19-01-17
 * Time: 13:17
 * Copyright: © 2017 - Heer en Frezer B.V.
 */


namespace HeerEnFrezer\MediaManager;


use Illuminate\Support\Facades\Config;

class Helpers
{
	private static $MIME_TO_EXT = [
		'image/jpeg'			=> 'jpg',
		'image/png'				=> 'png',
		'image/svg+xml'			=> 'svg',
		'image/gif'				=> 'gif',
		'image/bmp'				=> 'bmp',
		'application/xml'		=> 'xml',

		// PDF
		'application/pdf'		=> 'pdf',
		'application/x-pdf'		=> 'pdf',

		// Microsoft Office
		'application/msword'														=> 'doc',
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document' 	=> 'docx',
		'application/vnd.ms-excel' 													=> 'xls',
		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'			=> 'xlsx',
		'application/vnd.ms-powerpoint'												=> 'pot',
		'application/vnd.openxmlformats-officedocument.presentationml.presentation'	=> 'potx'
	];

	/**
	 * Return the extension belonging to a mime type.
	 *
	 * @param 	string	$mime		The mime type to search for
	 * @param 	string 	$default	When extension is not found output this. Default: unknown
	 * @return 	string				The extension or value of default
	 */
	public static function MimeToExt($mime, $default = 'unknown')
	{
		$mimes = array_merge(self::$MIME_TO_EXT, Config::get('extra_mime_types', []));

		return self::issetArrayOr($mime, $mimes, $default);
	}

	/**
	 * Check if a value is available in an array. Output if so other wise output $default.
	 *
	 * @param string		$needle		The key
	 * @param string		$haystick	The array
	 * @param string 		$default	The default value to return
	 * @return string|null
	 */
	public static function issetArrayOr($needle, &$haystick, $default = null)
	{
		if(isset($haystick[$needle]))
			return $haystick[$needle];

		return $default;
	}

	/**
	 * Slug a string
	 *
	 * @param string		$string			The string to slugify
	 * @param string 		$separator		Default: -
	 * @return string
	 */
	public static function slug($string, $separator = '-')
	{
		// Convert all dashes/underscores into separator
		$flip = $separator == '-' ? '_' : '-';

		$string = preg_replace('!['.preg_quote($flip).']+!u', $separator, $string);

		// Remove all characters that are not the separator, letters, numbers, or whitespace.
		$string = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', mb_strtolower($string));

		// Replace all separator characters and whitespace by a single separator
		$string = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $string);

		return trim($string, $separator);
	}
}