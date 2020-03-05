<?php

	use \Banco\Page;

	$app->get('/', function() {

	$page = new Page();

	$page->setTpl("index");	

});

?>