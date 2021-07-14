<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container-fluid">
		<a href="<?php echo base_url() ?>" class="navbar-brand">ACL</a>
		 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<?php 
				$menu = $this->session->userdata('menu');
				foreach ($menu as $key => $value) { ?>
				<li class="nav-item"><a href="<?= base_url().substr($value['url_link'],1) ?>" class="nav-link"><?= strtoupper($value['menu_name']) ?></a></li>
				<?php } ?>
			</ul>
			<form class="d-flex">
				<a href="<?= base_url() ?>auth/logout" class="btn btn-outline-warning me-2" style="float: right;">Logout</a>
			</form>
		</div>
	</div>
</nav>