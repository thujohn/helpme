<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>[ADMIN] <?php echo $config->sitename.' :: '.$title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php echo css_asset('bootstrap')."\n"; ?>
<?php echo css_asset('bootstrap-responsive')."\n"; ?>
<?php echo css_asset('default')."\n"; ?>
<?php echo css_asset('print')."\n"; ?>
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if IE 8]>
	<?php echo css_asset('ie')."\n"; ?>
<![endif]-->
<link rel="shortcut icon" href="<?php echo other_asset_url('ico/favicon.ico', '', 'images'); ?>">
<?php
	foreach ($css as $url){
		echo $url."\n";
	}
?>
</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<?php echo anchor('admin', '[ADMIN] '.$config->sitename, 'class="brand"'); ?>
				<div class="nav-collapse collapse">
					<div class="divider-vertical pull-left"></div>
					<ul class="nav">
						<li><?php echo anchor('admin', 'Tableau de bord'); ?></li>
						<li><?php echo anchor('admin/tickets', 'Tickets'); ?></li>
						<li><?php echo anchor('admin/faq', 'FAQ'); ?></li>
						<li><?php echo anchor('admin/contact', 'Contact'); ?></li>
						<li><?php echo anchor('admin/user', 'Utilisateurs'); ?></li>
						<li><?php echo anchor('admin/config', 'Configuration'); ?></li>
						<li class="visible-phone visible-tablet"><?php echo anchor('user/logout', 'Déconnexion'); ?></li>
					</ul>
					<div class="btn-group pull-right hidden-phone hidden-tablet">
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="icon-user"></i>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><?php echo anchor('user/logout', 'Déconnexion'); ?></li>
						</ul>
					</div>
					<div class="divider-vertical pull-right"></div>
					<?php echo form_open('admin/tickets/search', array('class' => 'navbar-search form-search pull-right')); ?>
						<div class="input-append">
							<input type="text" class="span2 search-query" name="search" id="search" />
							<button type="submit" class="btn btn-inverse"><i class="icon-search icon-white"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<?php if ($this->session->flashdata('alert')) : ?>
			<div class="alert">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<?php echo $this->session->flashdata('alert'); ?>
			</div>
			<?php endif; ?>
			<?php if ($this->session->flashdata('error')) : ?>
			<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<?php echo $this->session->flashdata('error'); ?>
			</div>
			<?php endif; ?>
			<?php if ($this->session->flashdata('success')) : ?>
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<?php echo $this->session->flashdata('success'); ?>
			</div>
			<?php endif; ?>
			<?php if ($this->userManager->isLoggedIn()) { ?>
			<div class="span3 bs-docs-sidebar">
				<ul class="nav nav-list bs-docs-sidenav">
					<li><a href="<?php echo site_url('admin/tickets/open'); ?>"><i class="icon-chevron-right"></i>Ouverts<span class="badge badge-success pull-right"><?php echo $nb_open; ?></span></a></li>
					<li><a href="<?php echo site_url('admin/tickets/closed'); ?>"><i class="icon-chevron-right"></i>Fermés<span class="badge badge-important pull-right"><?php echo $nb_close; ?></span></a></li>
					<li><a href="<?php echo site_url('admin/tickets'); ?>"><i class="icon-chevron-right"></i>Tous<span class="badge badge-info pull-right"><?php echo $nb_all; ?></span></a></li>
				</ul>
			</div>
			<div class="span9">
				<?php echo $output; ?>
			</div>
			<?php }else{ ?>
				<?php echo $output; ?>
			<?php } ?>
		</div>
	</div>

	<footer class="container">
		<div class="row">
			<div class="span12">
				<hr />
				<div class="tcenter">&copy; <a href="https://github.com/thujohn/helpme" target="_blank"><?php echo $config->sitename; ?></a> :: {elapsed_time} secondes :: <?php echo ($this->db->total_queries() > 1) ? $this->db->total_queries().' requêtes' : $this->db->total_queries().' requête'; ?></div>
			</div>
		</div>
	</footer>

	<script type="text/javascript">
		var base_url = '<?php echo base_url(); ?>';
		var assets_url = '<?php echo config_item('assets_url'); ?>';
		var current_url = '<?php echo current_url(); ?>';
	</script>
	<?php echo js_asset('jquery-1.8.2.min')."\n"; ?>
	<!--[if lt IE 9]>
	<?php echo js_asset('respond.min')."\n"; ?>
	<?php echo js_asset('selectivizr.min')."\n"; ?>
	<noscript><link rel="stylesheet" href="[fallback css]" /></noscript>
	<![endif]-->
	<?php echo js_asset('bootstrap.min')."\n"; ?>
	<?php echo js_asset('default')."\n"; ?>
	<?php
		foreach ($js as $url){
			echo $url."\n";
		}
	?>
</body>
</html>