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
 * File: MediaFile.php
 * Date: 19-01-17
 * Time: 12:27
 * Copyright: © 2017 - Heer en Frezer B.V.
 */


namespace HeerEnFrezer\MediaManager;


use HeerEnFrezer\MediaManager\Drivers\AbstractDriver;

class MediaFile
{

	static $domain;
	static $root = '/media';
	static $driver;

	private $attributes = [
		'locale' 		=> null,
		'name'			=> null,
		'slug'			=> null,
		'type'			=> null,
		'mime_type'		=> null,
		'disposition'	=> null,
		'location'		=> null,
		'preview_image'	=> null
	];

	/**
	 * MediaFile constructor.
	 *
	 * @param	array			$attributes		The attributes for a file
	 * @param	AbstractDriver	$driver			The driver for only this file
	 */
	public function __construct(array $attributes = [], AbstractDriver $driver = null)
	{
		if(!is_null($driver))
			self::$driver 	= $driver;

		if(count($attributes) > 0)
			$this->setAttributes($attributes);
	}

	/**
	 * Set a list of attributes
	 *
	 * @param array 		$attributes		The attributes to set
	 * @return MediaFile 	$this
	 */
	public function setAttributes(array $attributes)
	{
		foreach($attributes as $attribute => $value)
			$this->setAttribute($attribute, $value);

		return $this;
	}

	/**
	 * Set an attribute
	 *
	 * @param string		$attribute
	 * @param string|null	$value
	 * @return MediaFile	$this
	 */
	public function setAttribute($attribute, $value)
	{
		if(array_key_exists($attribute, $this->attributes) && (is_null($value) || is_string($value)))
			$this->attributes[$attribute] = $value;

		return $this;
	}

	/**
	 * Get an attribute value
	 *
	 * @param string		$attribute
	 * @return string|null	The attribute value
	 */
	public function getAttribute($attribute)
	{
		if(isset($this->attributes[$attribute]))
			return $this->attributes[$attribute];

		return null;
	}
	
	public function __set($attribute, $value)
	{
		$this->setAttributes($attribute, $value);
	}

	public function __get($attribute)
	{
		return $this->getAttribute($attribute);
	}

	/**
	 * Get the protocol.
	 *
	 * @return string
	 */
	public function getProtocol()
	{
		$protocol	= (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";

		return rtrim(\Config::get('mediamanager.protocol', $protocol ), '://') . '://';
	}


	/**
	 * Returns the domain with or without protocol
	 *
	 * @param bool $includeProtocol
	 * @return string
	 */
	public function getDomain($includeProtocol = TRUE)
	{
		$domain		= $_SERVER['SERVER_NAME'];
		$domain 	= rtrim(\Config::get('mediamanager.domain', $domain), '/');

		return ($includeProtocol ? $this->getProtocol() : '') . $domain;
	}

	/**
	 * Get the filename slugged
	 *
	 * @param bool $includePath
	 * @return string
	 */
	public function getSlug($includePath = TRUE)
	{
		if(!is_null($this->attributes['slug'])
			&& !is_empty($this->attributes['slug'])
			&& strstr($this->attributes['slug'], '.') !== FALSE)
		{
			return $this->attributes['slug'];
		}
		$filename = Helpers::slug($this->attributes['name']) . '.' . Helpers::MimeToExt($this->attributes['mime_type']);
		$filepath = self::$root . '/' . (!empty(Helpers::slug($this->attributes['type'])) ? Helpers::slug($this->attributes['type']) . 's/' : '');

		return strtolower(($includePath ? $filepath : '') . $filename);
	}

	/**
	 * Get the URL to the media file
	 *
	 * @param bool $includeDomain
	 * @return string
	 */
	public function getUrl($includeDomain = TRUE)
	{
		return ($includeDomain ? $this->getDomain(TRUE)  : '') . '/'. ltrim($this->getSlug(TRUE), '/');
	}

	/**
	 * Get the media file as url
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->getUrl(TRUE);
	}

	/**
	 * Serve the file. Request ends here.
	 */
	public function serve()
	{
		if($this->getDomain(FALSE) !== $_SERVER['SERVER_NAME'])
		{
			header('HTTP/1.0 307 Temporary Redirect');
			header('Location: ' . $this->getUrl(TRUE));
			exit;
		}

		echo 'SERVING IMAGE: ' . $this->getSlug();
	}


}