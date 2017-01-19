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
 * File: AbstractDriver.php
 * Date: 19-01-17
 * Time: 12:22
 * Copyright: © 2017 - Heer en Frezer B.V.
 */


namespace HeerEnFrezer\MediaManager\Drivers;


class AbstractDriver implements DriverInterface
{

	private $config;


	public function __construct(ConfigRepository $config)
	{
		$this->config = $config;
	}
}