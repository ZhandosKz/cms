<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=Yii::app()->name?> <?=$this->pageTitle?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<link href="/themes/twitter_bootstrap/public/css/bootstrap.css" rel="stylesheet">
	<script src="/themes/twitter_bootstrap/public/js/bootstrap.min.js"></script>
	<style>
		body {
			padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
		}
	</style>
	<link href="/themes/twitter_bootstrap/public/css/bootstrap-responsive.css" rel="stylesheet">

</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand" href="#">Гостевая книга</a>
		</div>
	</div>
</div>

<div class="container">
	<h1><?=$this->pageTitle?></h1>
	<?=$content?>
</div> <!-- /container -->
</body>
</html>