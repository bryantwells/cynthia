<figure class="Product Product--issue">

	<!-- Thumbnai -->
	<img class="Product-image"
		src="<?= $product->image()->toFile()->url() ?>" alt="">

	<!-- Caption -->
	<figcaption class="Product-caption">

		<!-- Header -->
		<header class="Product-header">
			<?php if ($product->issue_number()): ?>
				<?php $num = str_pad($product->issue_number(), 3, '0', STR_PAD_LEFT) ?>
				<p class="Product-issueNumber" data-num="<?= $num ?>">
					<?= $num ?>
				</p>
			<?php endif; ?>
		</header>

		<!-- Meta -->
		<div class="Product-meta">
			<h2 class="Product-title">
				<?= $product->title() ?>
			</h2>
			<?= $product->description()->kt() ?>
			<p class="Product-meta">
				<?= number_format($product->price_mxn()->toFloat(),2) ?>MXN
				<?= number_format($product->price_usd()->toFloat(),2) ?>USD
			</p>
			<p class="Product-meta">
				<a href="<?= $product->payment_link() ?>">Compra</a>
				<a href="<?= $product->payment_link() ?>">Purchase</a>
			</p>
		</div>

	</figcaption>
</figure>