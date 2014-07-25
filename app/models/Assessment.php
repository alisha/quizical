<?php

class Assessment extends Eloquent {

	public function course() {
		return $this->belongsTo('Course');
	}

}