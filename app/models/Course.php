<?php

class Course extends Eloquent {

	public function user() {
		return $this->belongsTo('User');
	}

	public function assessment() {
		return $this->hasMany('Assessment');
	}

}