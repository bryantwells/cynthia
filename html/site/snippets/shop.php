<section class="Section Section--shop" id="shop">
	<?php snippet('security-ribbon') ?>
	<!-- <h2 class="Section-header">
		Comercio
	</h2> -->
	<div class="Section-body">
		<div class="ProductList">
			<?php foreach ($site->shop()->toBlocks() as $product): ?>
				<?php $productInfo = $product->info()->toStructure()->first() ?>
				<?php if ($product->type() == 'issue'): ?>
					<?php snippet('product--issue', ['product' => $productInfo ]) ?>
				<?php elseif ($product->type() == 'subscription'): ?>	
					<?php snippet('product--subscription', ['product' => $productInfo ]) ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>