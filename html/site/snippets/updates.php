<section class="Section Section--updates" id="updates">
	<?php snippet('security-ribbon') ?>
	<h2 class="Section-header">
		Actualizaciones
		<br> Updates
	</h2>
	<div class="Section-body">
		<div class="UpdateList">
			<?php foreach ($site->updates()->toStructure() as $update): ?>
				<update-block class="Update">
					<span class="Update-body">
						<meta-text class="MetaText">
							<?= $update->date()->toDate() ?>
						</meta-text>
						<span class="Update-body">
							<?= $update->text() ?>
						</span>
					</span>
					<?php if ($image = $update->image()->image()->toFile()): ?>
						<?php $width = 600 ?>
						<?php $height = floor($width * ($image->height() / $image->width())) ?>
						<div class="Update-image"
							style="
								max-width: <?= $width ?>px;
								aspect-ratio: <?= $width ?> / <?= $height ?>;
								mask-image: url(<?= $image->etch('wave', $width, $height)->url() ?>);
								-webkit-mask-image: url(<?= $image->etch('wave', $width, $height)->url() ?>);
							">
						</div>
					<?php endif; ?>
				</update-block>
			<?php endforeach; ?>
		</div>
	</div>
</section>