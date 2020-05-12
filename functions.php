<?php

	use \Banco\Model\User;
	use \Banco\Model\Cart;

	function formatPrice($vlprice)
	{

		if (!$vlprice > 0) $vlprice = 0;		

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

	function getCartNrQtd()
	{

		$cart = Cart::getFromSession();

		$totals = $cart->getProductsTotals();

		return $totals['nrqtd'];

	}

	function getCartVlSubTotal()
	{

		$cart = Cart::getFromSession();

		$totals = $cart->getProductsTotals();

		return formatPrice($totals['vlprice']);

	}


?>