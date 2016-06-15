<?php
session_start();

if (isset($_SESSION['client_id']))
	echo 'success';
else 	
	echo 'failure';
?>