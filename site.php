<?php

	use \Banco\Page;
	use \Banco\Model\Product;

	$app->get('/', function() {

	$products = Product::listAll();	

	$page = new Page();

	$page->setTpl("index", [

		'products'=>Product::checkList($products)
	]);	

});

?>