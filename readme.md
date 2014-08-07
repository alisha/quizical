# Quizical

This is a web app that lets high school teachers plan dates for their tests and quizzes. Check it out at [quizical.io](quizical.io)

Note: this is not complete, as there are some features that need to be completed. The "forgot your password" links do not work.

## Test Credentials

To test out quizical, use the following credentials:

* School ID: 1
* School password: test
* User 1 email: test@example.com
* User 1 password: test
* User 2 email: test2@example.com
* User 2 password: test

## Acknowledgements

Thanks to [Ben Zweig](tfzweig.com) for the name.

### Code

* [Laravel](laravel.com)
* [Bootstrap](getbootstrap.com)
* [Laravel Calendar](https://github.com/makzumi/laravel-calendar) by makzumi
	* The `getOldGET()` function was modified slightly for calendar filters
* [Select To Autocomplete: Redesigned Country Selector](http://baymard.com/labs/country-selector)

## To Do

* Allow users to reset their passwords if they forgot them
* Let schools login to view the calendar and update their info
* Archive messages
* Suggest dates that don't have many assessments when a teacher is creating a new one
* For schools with block rotations, show dates that a block meets on when a teacher is creating an assessment
* Feedback form