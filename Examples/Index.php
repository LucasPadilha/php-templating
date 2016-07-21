<?php 
	require_once('../Template.php');

	$file = "index.templ";
	$data = array(
		"title" => "Test",
		"content" => "Testing"
	);

	// Loading with Constructor method.
	$template = new Template($file, $data);
	$result = $template->render();
	echo $result;  // echoing the result

	// Loading with loadTemplate() method.
	$template = new Template();
	$template->loadTemplate($file);
	$template->setData($data);
	$template->render('echo'); // echoing the result
?>