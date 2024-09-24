<?php 
	$payment_link = '';
	$price = '';
	$currency = '';
	if ($product->payment_link_usd()->isEmpty() && $product->price_usd()->isEmpty()) {
		$payment_link = $product->payment_link_mxn();
		$price = number_format($product->price_mxn()->toFloat(),2);
		$currency = 'MXN';
	} elseif ($product->payment_link_mxn()->isEmpty() && $product->price_mxn()->isEmpty()) {
		$payment_link = $product->payment_link_usd();
		$price = number_format($product->price_usd()->toFloat(),2);
		$currency = 'USD';
	}
?>

<figure class="Product Product--subscription">

	<!-- Thumbnail -->
	<div class="Product-hologram">
		<a href="<?= $payment_link ?>">
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
		</div>
		<div class="Product-meta">
			<div class="BuyForm">
				<a 
					class="BuyForm-button"
					href="<?= $payment_link ?>">
					$<?= $price ?> <?= $currency ?>
				</a>
			</div>
		</div>
	</figcaption>
</figure>