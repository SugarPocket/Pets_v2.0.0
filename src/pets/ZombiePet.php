<?php

namespace pets;

class ZombiePet extends Pets {

	const NETWORK_ID = 32;

	public $width = 0.6;
	public $length = 0.6;
	public $height = 1.8;

	public function getName() {
		return "ZombiePet";
	}

	public function getSpeed() {
		return 2.0;
	}

}
