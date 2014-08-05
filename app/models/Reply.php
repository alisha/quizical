<?php

class Reply extends Eloquent {

	public function user() {
		return $this->belongsTo('User');
	}

	public function message() {
		return $this->belongsTo('Message');
	}

}