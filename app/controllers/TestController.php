<?php


class TestController {
	public function index()
	{
		$title = 'CRUD-PHP-BASIC';

		$a = new Test;
		$nama = $a->insert('dia');

		return $title;
	}
}