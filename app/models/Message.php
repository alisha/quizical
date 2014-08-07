<?php

class Message extends Eloquent {

	protected $dates = ['deleted_at'];

	public function user() {
		return $this->belongsToMany('User');
	}

	public function reply() {
		return $this->hasMany('Reply');
	}

	public function getOtherUsers() {
		$allUsers = $this->user->all();
		$returnUsers = [];

		foreach ($allUsers as $user) {
			if ($user->id != Auth::user()->id) {
				array_push($returnUsers, $user);
			}
		}

		return $returnUsers;
	}

}