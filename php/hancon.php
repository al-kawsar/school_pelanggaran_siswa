<?php
date_default_timezone_set('Asia/Jakarta');
session_start();

function random($length)
{
	$data = '1234567890AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSstuuUvVwWxXyYyZz';
	$string = '';
	for ($i = 1; $i <= $length; $i++) {
		$pos = rand(0, strlen($data) - 1);
		$string .= $data[$pos];
	}
	return $string;
}

require 'config.php';

if (empty($_GET['thisposition'])) {
	header('location:../login');
	exit; // Stop execution after redirect
} else {
	require 'rootcon.php';
	$ru = new con();
	$to = $_GET['thisposition'];

	if ($to == md5('login')) {
		if (isset($_POST['v'])) {
			switch ($_POST['v']) {
				case 'guru':
					$ru->loginguru($con, $_POST['username'], $_POST['password']);
					break;
				case 'admin':
					$ru->loginadmin($con, $_POST['username'], $_POST['password']);
					break;

				default:
					header('location:' . $base . 'login');
					exit; // Stop execution after redirect
			}
		} else {
			header('location:' . $base . 'login');
			exit; // Stop execution after redirect
		}
	} elseif ($to == md5('logout')) {
		$ru->logout();
	} else {
		// Handle unknown position
		header('location:' . $base . 'login');
		exit; // Stop execution after redirect
	}
}
