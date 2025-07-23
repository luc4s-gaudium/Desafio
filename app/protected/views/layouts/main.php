<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<header class="p-3 mb-3 border-bottom">
		<div class="container">
			<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
				<a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
					<figure class="figure__footer m-0">
						<img src="https://static.wixstatic.com/media/c5ed20_b07fe8ca0ecd4fa59cfca60d58ee03a1~mv2_d_2268_2268_s_2.png/v1/fill/w_80,h_80,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/gaudium-logo-transparente.png" alt="Gaudium logo">
					</figure>

				</a>
				<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-4">
					<?php foreach ($this->navigationLinks as $title => $link): ?>
						<li><a href="<?php echo $link; ?>" class="nav-link px-2 link-secondary"><?php echo $title; ?></a></li>
					<?php endforeach; ?>
				</ul>
				<form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search"> <input type="search"
						class="form-control" placeholder="Pesquisar..." aria-label="Search"> </form>
				<div class="dropdown text-end">
					<a href="#"
						class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
						data-bs-toggle="dropdown"
						aria-expanded="false">
						<img src="https://avatars.githubusercontent.com/u/89052600?v=4" alt="mdo" width="32" height="32" class="rounded-circle">
					</a>
					<ul class="dropdown-menu text-small">
						<?php foreach ($this->navigationLinks as $title => $link): ?>
							<li><a class="dropdown-item" href="<?php echo $link; ?>"><?php echo $title; ?></a></li>
						<?php endforeach; ?>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li><a class="dropdown-item" href="/">Sair</a></li>
					</ul>
				</div>
			</div>
		</div>
	</header>

	<main class="container">
		<?php echo $content; ?>
	</main>

	<footer class="border-top py-3 my-4">
		<div class="d-flex flex-wrap justify-content-between align-items-center container">
			<p class="col-md-4 mb-0 text-body-secondary">© 2025 Gaudium, Inc</p>
			<a href="/"
				class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"
				aria-label="Bootstrap">
				<figure class="figure__footer m-0">
					<img src="https://static.wixstatic.com/media/c5ed20_b07fe8ca0ecd4fa59cfca60d58ee03a1~mv2_d_2268_2268_s_2.png/v1/fill/w_80,h_80,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/gaudium-logo-transparente.png" alt="Gaudium logo">
				</figure>
			</a>
			<ul class="nav col-md-4 justify-content-end">
				<?php foreach ($this->navigationLinks as $title => $link): ?>
					<li class="nav-item"><a href="<?php echo $link; ?>" class="nav-link px-2 text-body-secondary"><?php echo $title; ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>