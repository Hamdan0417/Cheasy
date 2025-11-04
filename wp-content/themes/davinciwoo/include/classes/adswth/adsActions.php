<?php
/**
 * Created by PhpStorm.
 * User: sunfun
 * Date: 26.01.18
 * Time: 9:42
 */

namespace adswth;

class adsActions {

	const repository = [
		'adsFields' =>adsFields::class,
		'adsMedia' =>adsMedia::class
	];

	/**
	 * @param $name
	 *
	 * @return Ads
	 *
	 * @throws \Exception
	 */
	static function create($name){
		if( null === self::repository[$name] ){
			throw new \Exception('not class');
		}
		$class = self::repository[$name];
		return new $class;
	}

}