<?php

class Course extends Eloquent {

	public function user() {
		return $this->belongsTo('Course');
	}

	public function assessment() {
		return $this->hasMany('Assessment');
	}

}