<?php

class SchoolController extends BaseController {

	public function getNew() {
		return View::make('createSchool');
	}

}