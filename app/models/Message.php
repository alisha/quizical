<?php

class Message extends Eloquent {

	protected $dates = ['deleted_at'];

	public function user() {
		return $this->belongsToMany('User');
	}

	public function reply() {
		return $this->hasMany('Reply');
	}

}