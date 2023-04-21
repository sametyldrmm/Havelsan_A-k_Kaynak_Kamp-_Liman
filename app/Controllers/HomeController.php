<?php
namespace App\Controllers;

class HomeController
{
	public function index()
	{
		return view('index');
	}

	public function example()
	{
		/*
		$isActive = checkPort("0.0.0.0", 22);

		if ($isActive) {
			// 22 Portu aktifse bunları yap
		} else {
			// 22 Portu kapalıysa bunları yap...
		}
		*/

		/*
		dd([
			server(),
			user(),
			extension()
		]);
		*/

	}
}
