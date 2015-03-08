<?php namespace Stevendesu\WorldDistance;

// For Google Maps API caching
use Stevendesu\WorldDistance\WorldDistanceRecord;

// For logging major fail
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

// Default like units, base location, or Earth size
use Illuminate\Config\Repository;
use Illuminate\Database\DatabaseManager;

class WorldDistance {
    
	/**
	* Illuminate config repository instance.
	*
	* @var \Illuminate\Config\Repository
	*/
	protected $config;
    
	/**
	* Illuminate database manager instance.
	*
	* @var \Illuminate\Database\DatabaseManager
	*/
	protected $database;
	
	/**
	 * Create a new WorldDistance instance.
	 *
	 * @param  \Illuminate\Config\Repository         $config
	 * @param  \Illuminate\Database\DatabaseManager  $database
	 */
	public function __construct(Repository $config, DatabaseManager $database) {
		$this->config = $config;
		$this->database = $database;
	}
	
	/**
	 * Calculate the distance between two positions on the globe
	 *
	 * @param  Array  $LatLng1
	 * @param  Array  $LatLng2
	 * @param  bool   $googleMaps
	 */
	public function getDistance($LatLng1, $LatLng2, $googleMaps = false) {
		if( $googleMaps ) {
			return $this->getGoogleMapsDistance($LatLng1, $LatLng2);
		}
		
		$dLat = deg2rad($LatLng2[0] - $LatLng1[0]);
		$dLon = deg2rad($LatLng2[1] - $LatLng1[1]);
		
		$a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($LatLng1[0])) * cos(deg2rad($LatLng2[0])) * sin($dLon/2) * sin($dLon/2);
		$b = 2 * asin(sqrt($a));
		$c = $this->config->get('worlddistance.earth_radius') * $b;
		
		return $c;
	}
}
