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
		</div>
		<div class="Product-meta">
			<p>
				<?= number_format($product->price_mxn()->toFloat(),2) ?> MXN
				<a href="<?= $product->payment_link_mxn() ?>">Compra</a>
			</p>
			<p>
				<?= number_format($product->price_usd()->toFloat(),2) ?> USD
				<a href="<?= $product->payment_link_usd() ?>">Purchase</a>
			</p>
		</div>
	</figcaption>
</figure>