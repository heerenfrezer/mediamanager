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
 * File: MediaManagerException.php
 * Date: 19-01-17
 * Time: 12:11
 * Copyright: © 2017 - Heer en Frezer B.V.
 */


namespace HeerEnFrezer\MediaManager\Exceptions;


class MediaManagerException extends \Exception
{
	public function __construct($message, array $replace = [], $code = 0, Exception $previous = null)
	{
		array_unshift($replace, $message);
		$message = call_user_func_array('sprintf', $replace);
		parent::__construct($message, $code = 0, $previous = null);
	}

}