<?php

class School extends Eloquent {

	public function user() {
		return $this->hasMany('User');
	}

}