<?php
/**
 * ---------------------------------------------------
 * Created by Jason de Ridder <mail@deargonauten.com>.
 * ---------------------------------------------------
 * File: DriverInterface.php
 * Date: 19-01-17
 * Time: 12:20
 */


namespace HeerEnFrezer\MediaManager\Drivers;


interface DriverInterface
{
	
	public function save();
	public function remove();
	public function update();
}