<figure class="Product Product--subscription">

	<!-- Thumbnai -->
	<div class="Product-hologram">
		<a href="<?= $product->payment_link() ?>">
			<hologram-sticker class="HologramSticker">
				<div class="HologramSticker-layer" data-layer="1"></div>
				<div class="HologramSticker-layer" data-layer="2"></div>
				<div class="HologramSticker-layer" data-layer="3"></div>
				<!-- <div class="HologramSticker-layer" data-layer="4"></div> -->
				<h2 class="HologramSticker-text">
					<?= $product->title() ?>
				</h2>
			</hologram-sticker>
		</a>
	</div>
	

	<!-- Caption -->
	<figcaption class="Product-caption">
		<div class="Product-meta">
			<?= $product->description()->kt() ?>
			<p>
				<?= number_format($product->price_mxn()->toFloat(),2) ?>MXN
				<?= number_format($product->price_usd()->toFloat(),2) ?>USD
			</p>
			<p>
				<a href="<?= $product->payment_link_mxn() ?>">Compra (MX)</a>
				<a href="<?= $product->payment_link_usd() ?>">Purchase (INTL)</a>
			</p>
		</div>
	</figcaption>
</figure>