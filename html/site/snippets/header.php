<header class="Section Section--home" id="home">
	<?php snippet('security-ribbon') ?>
	<?php $image = $site->logo()->toFile() ?>
	<h1 class="Section-header">
		Cynthia
	</h1>
	
	<div class="Logo">
		<div class="Logo-image" 
			style="
				aspect-ratio: 1/1;
				mask-image: url(<?= $image->etch('circle', 600, 600)->url() ?>);
				-webkit-mask-image: url(<?= $image->etch('circle', 600, 600)->url() ?>);
			"></div>
	</div>
	
</header>