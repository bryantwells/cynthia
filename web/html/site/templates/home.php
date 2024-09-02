<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cynthia Magazine</title>
	<link rel="stylesheet" href="/assets/style.css?v=<?= rand() ?>">
</head>
<body>
	<?php snippet('header') ?>
	<?php snippet('shop') ?>
	<?php snippet('updates') ?>
	<?php snippet('about') ?>
	<?php snippet('footer') ?>
	<script src="/assets/scripts.js?v=<?= rand() ?>"></script>
</body>
</html>