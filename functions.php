<?php

	use \Banco\Model\User;
	//use \Banco\Model\Cart;

	function formatPrice($vlprice)
	{

		return number_format($vlprice, 2, ",",".");

	}

	function checkLogin($inadmin = true)
	{

		return User::checkLogin($inadmin);

	}

	function getUserName()
	{

		$user = User::getFromSession();

		$user->get($user->getiduser());

		return utf8_decode($user->getdesperson());

	}

?>