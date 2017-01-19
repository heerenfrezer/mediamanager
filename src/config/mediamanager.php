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
 * File: mediamanager.php
 * Date: 19-01-17
 * Time: 11:49
 * Copyright: © 2017 - Heer en Frezer B.V.
 */
 

return [

	/*
	 * -------------------------------------------------------------
	 *  DEFAULT ROUTE TO LISTEN TO
	 * -------------------------------------------------------------
	 *
	 * This is the root route where the media manager needs to listen to.
	 * [https://example.com]/media/{slug}/{filename.ext}
	 *
	 * Default: media
	 *
	 */
	'route' =>	'media',

	/*
	 * ----------------------------------------------------------------
	 *  DOMAIN TO SERVER CONTENT FROM
	 * ----------------------------------------------------------------
	 *
	 * If you have an asset server you may set this to the appropriate
	 * domain. Don't include the protocol.
	 *
	 * Default: null (will server from current domain)
	 *
	 */
	'domain' => null,

	/*
	 * ----------------------------------------------------------------
	 *  PROTOCOL TO USE
	 * ----------------------------------------------------------------
	 *
	 * Set the protocol you wish to use. If null current protocol will
	 * be used.
	 *
	 * Default: https
	 *
	 */
	'protocol' => 'https',

	/*
	 * ----------------------------------------------------------------
	 *  EXTRA MIME TYPES
	 * ----------------------------------------------------------------
	 *
	 * Out of the box MediaManager support a lot of mime types
	 * If you need other or special mime types for revolving to extensions
	 * you can add them here.
	 * Format: '[mime_type]'	=> 		'[extension]'
	 *
	 *
	 */
	'extra_mime_types' => [
		'application/vnd.openxmlformats-officedocument.wordprocessingml.template' => 'dotx',
	],


];