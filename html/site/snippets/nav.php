<nav class="MainNav">
	<ul class="MainNav-list">
		<li class="MainNav-item <?= ($activeItem == 'home') ? 'is-active' : '' ?>">
			<h1>Cynthia</h1>
		</li>
		<li class="MainNav-item <?= ($activeItem == 'shop') ? 'is-active' : '' ?>">
			<a href="#shop">
				<p>Comercio</p>
				<p>Shop</p>
			</a>
		</li>
		<li class="MainNav-item <?= ($activeItem == 'updates') ? 'is-active' : '' ?>">
			<a href="#updates">
				<p>Actualizaciones</p>
				<p>Updates</p>
			</a>
		</li>
		<li class="MainNav-item <?= ($activeItem == 'about') ? 'is-active' : '' ?>">
			<a href="#about">
				<p>Acerca De</p>
				<p>About</p>
			</a>
		</li>
	</ul>
</nav>