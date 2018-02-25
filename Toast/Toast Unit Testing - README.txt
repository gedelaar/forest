+---------------------------------------------------------------------+
|                                                                     |
|  TOAST - Unit Testing for CodeIgniter v. 1.5                        |
|                                                                     |
|  Licensed under Creative Commons Attribution 3.0 (cc)               |
|                                                                     |
|  DISCLAIMER: I take no responsibility for you messing up your work  |
|  and/or hurting someone by using this script. It's tiny, it's open  |
|  source, and it isn't that hard to read the instructions; but if    |
|  you have any doubts about your ability to use this script safely,  |
|  just don't. Thank you.                                             |
|                                                                     |
|  Created by: Jens Roland, 2010  (mail@jensroland.com)               |
|  Credits to: t'mo & redguy from the CodeIgniter Forums              |
|                                                                     |
+---------------------------------------------------------------------+

CONTENTS:

	1. Background
	2. Installation
	3. Requirements
	4. Known Bugs
	5. Usage
	6. Feature List
	7. Reserved Names
	8. Changelog

+---------------------------------------------------------------------+

1) BACKGROUND:

I had been looking for a unit testing suite for CodeIgniter that's a little more JUnit-like than the one included in CI.

My criteria were:

	1. It must be lightweight and completely unobtrusive - I don't want a lot of bloat or a ton of files littering my CI installation

	2. It must integrate perfectly with CI - ie. no hacking the core, no intricate workarounds to make it work inside CI Controller classes, and no duplicate index.php files

	3. It must use simple JUnit-like syntax (meaning it must support a range of assert_*() functions)

	4. It must work entirely in the browser - I don't always have shell access to my servers, and you might not either

	5. It must offer a simple way to run both individual tests, groups of tests, and all tests at once

After searching the forums for a while, I came across a brilliant unit testing solution by t'mo and a class of assert functions by redguy. By simply combining these, I had (1), (2) and (3) solved already. It took a bit more work, and more than a little magic, to meet all five criteria, but here it is.

Enjoy!

+---------------------------------------------------------------------+

2) INSTALLATION:

	The entire testing suite consists of just two controllers, three views, and an example class ;)

		Toast.php			The base class handling all the magic
		Toast_all.php		Optional - runs all your tests at once

		header.php			View - header HTML
		results.php			View - results wrapped in <li></li> elements
		footer.php			View - footer HTML

		example_tests.php	Optional - example test class (view source for tips)


	INSTRUCTIONS:

	1. Download and unzip the files
	2. Create two new folders:
		/app/controllers/test
		/app/views/test
	3. Move the two controller files and the example test class to the first folder, and the three view files to the second
	4. Go outside and play.

+---------------------------------------------------------------------+

3) REQUIREMENTS:

	* CodeIgniter 1.7.0 framework or later
	* PHP 5 (although I'm sure it could be rewritten to run under PHP 4 fairly easily)
	* CURL running on your web server (only required to run Toast_all, not necessary for regular use of Toast)

+---------------------------------------------------------------------+

4) KNOWN BUGS:

None.

That's right. Fucking NONE! Released means stable, motherfuckers! Take *that*, perpetual-beta-web-2.0-wussies! </rant></profanity>

Ahem. Anyway, if you *do* find a bug (and there's ALWAYS another bug), or if you make an improvement to the test suite, or just want to send a shoutout to a guy who codes when he's drunk, feel free to drop me an email on mail@jensroland.com.

+---------------------------------------------------------------------+

5) USAGE:

	Simply subclass the Toast file and write your tests as functions with the prefix 'test_':

		require_once(APPPATH . '/controllers/test/Toast.php');
		class My_test_class extends Toast
		{
			function My_test_class()
			{
				parent::Toast(__FILE__); // Remember this
			}
			function test_some_action()
			{
				// Test code goes here
				$my_var = 2 + 2;
				$this->_assert_equals($my_var, 4);
			}
			function test_some_other_action()
			{
				// Test code goes here
				$my_var = true;
				$this->_assert_false($my_var);
			}
		}

	Place your test classes INSIDE the /test/ folder (Toast_all can't find them otherwise), and you're ready to rock 'n' roll.

	To run all the tests in a test class, simply point your browser to the class name:

		--- http://www.example.com/test/my_test_class ---
	
	To run an individual test, point your browser to the test function, WITHOUT the 'test_' prefix:
	
		--- http://www.example.com/test/my_test_class/some_action ---

	And to run all the tests classes in the /test/ folder at once, point your browser to the Toast_all controller:
	
		--- http://www.example.com/test/toast_all ---

	That's all! If you need more flexibility, check the feature list below, but there's really not much more to it. All the dirty work is handled behind the scenes.

+---------------------------------------------------------------------+

6) FEATURE LIST:

	MULTIPLE ASSERT FUNCTIONS

	You can use multiple asserts within the same function; if any one of them fails, the test fails. The assert functions available are (remember to call them using $this->):

		_assert_true()								== true
		_assert_false()								== false
		_assert_equals()							==
		_assert_not_equals()					!=
		_assert_empty()								empty()
		_assert_not_empty()						! empty()

	Plus the strict (===) versions:

		_assert_true_strict()					=== true
		_assert_false_strict()				=== false
		_assert_equals_strict()				===
		_assert_not_equals_strict()		!==

	After evaluating the input, each assert function returns the result of its evaluation, in case you want to use it for branching or conditionals inside the test function. Though, if you don't need that level of fanciness, you can just run the asserts you need and let Toast handle the rest.

	CLEANUP FUNCTIONS

	Also available are the following two optional cleanup functions. If defined in a test class, they are automatically called when the individual tests are run:
	
		_pre()		Called before each test
		_post()		Called after each test

	Simply override these functions in your test classes if you need to do some housekeeping before and/or after each test (like adding/removing test data in the database, performing logins, re-instantiating classes, clearing memory, etc.)

	DEBUG MESSAGES

	If you need to echo a debug message while you're unit testing, simply use the message variable:
	
		$this->message = 'if this test case fails, blame it on my_var: ' . $my_var;

		(Of course you're using a decent debugger so you never actually need to echo debug data like that.. but let's pretend you weren't)
	
	Any value you assign to the message variable is automatically embedded in the test result page next to the test in which it was assigned.

	FAILING NICELY

	In some cases, it is useful to force a test to fail. Instead of using the classic but slightly cryptic _assert_true(FALSE) method, you can just call the _fail function:

		$this->_fail();

	You can even include an error message which will be embedded in the test result page next to the test:

		$this->_fail('Deprecated code should not be called');

	Note that the error message will override the $this->message variable (for now).

	BENCHMARKING

	Toast uses CodeIgniter's built-in benchmarking class to calculate how long it takes for the tests to run. This is all handled automatically by CI and displayed in footer.php.
	
	Why would you need benchmarking in a unit testing suite? Well, one of the big advantages of unit testing is that it enables you to do massive refactoring of your base classes without worrying about hidden side effects. And I find that whenever I've completed a round of refactoring of my central classes, I really want to know how it's affected my site's performance. The benchmarking numbers come in handy for just that.
	
	Of course, they are no substitute for proper profiling of your functions and controllers, but if your test coverage is good, they can help you catch most major performance screwups.

+---------------------------------------------------------------------+

7) RESERVED NAMES:

	Because of the way Toast parses test functions, the following function names are reserved and can not be used / overridden in the test classes:
	
		index
		show_results
		test_index
		test_show_results
		test__* (double underscores)
		_get_test_methods
		_remap
		_run
		_run_all
		_show
		_show_all
		_fail

	You may override the '_assert_*' functions all you want, but that shouldn't be necessary.


+---------------------------------------------------------------------+

8) CHANGELOG:

	Version 1.5		Minor cosmetic changes
								Added missing functions _assert_true_strict and _assert_false_strict as well as the _fail function (thanks to Chris from oedo.net)

	Version 1.4		Removed all PHP shorttags from the views (thanks to Andree Surya)
								Removed shorttag requirement in README file
								Tightened up some language in the README file

	Version 1.3		Added support for CI's language packs
								Added shorttag requirement in README file

	Version 1.2		Fixed some typos and cleaned up the README file

	Version 1.1		Added links to results pages
								Now uses site_url() as CI recommends
								Added changelog
								Minor cosmetic changes

	Version 1.0		Initial release


+---------------------------------------------------------------------+