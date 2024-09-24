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
			<div class="BuyForm">

				<?php if ($product->payment_link_mxn() && $product->price_mxn()): ?>
					<a 
						class="BuyForm-button"
						href="<?= $product->payment_link_mxn() ?>">
						$<?= number_format($product->price_mxn()->toFloat(),2) ?> MXN
					</a>
				<?php endif; ?>

				<?php if ($product->payment_link_usd() && $product->price_usd()): ?>
					<a 
						class="BuyForm-button"
						href="<?= $product->payment_link_usd() ?>">
						$<?= number_format($product->price_usd()->toFloat(),2) ?> USD
					</a>
				<?php endif; ?>
				
			</div>
		</div>
	</figcaption>
</figure>