class HologramSticker extends HTMLElement {
	constructor() {
		super();
		this.layers = this.querySelectorAll('.HologramSticker-layer');
		this.init();
	}
	init() {
		window.addEventListener('scroll', (e) => {
			this.layers.forEach((layer) => {
				layer.style.setProperty('--a', `${ window.scrollY/20 }deg`);
			});
		});
	}
}

class MetaText extends HTMLElement {
	constructor() {
		super();
		this.text = this.innerText;
		this.init();
	}
	init() {
		this.innerHTML = '';
		this.text.split('').forEach((c, i) => {
			this.innerHTML += (i%2)
				? `<span style="top: var(--offset);">${ c }</span>`
				: `<span style="top: calc(0px - var(--offset));">${ c }</span>`;
		})
	}
}

class UpdateBlock extends HTMLElement {
	constructor() {
		super();
		this.body = this.querySelector('.Update-body');
		this.image = this.querySelector('.Update-image');
		this.init();
	}
	
	init() {
		this.update();
		window.addEventListener('resize', () => {
			this.update();
		});
	}

	update() {
		if (this.image) {
			const bodyHeight = this.body.getBoundingClientRect().bottom - this.body.getBoundingClientRect().top;
			const imageHeight = this.image.getBoundingClientRect().bottom - this.image.getBoundingClientRect().top;
			this.style.minHeight = `calc(${ imageHeight }px)`;
			// this.image.style.marginTop = (this.image.getBoundingClientRect().left == this.getBoundingClientRect().left)
			// 	? `calc(-${ bodyHeight }px - 0.25lh)`
			// 	: `calc(0.75lh - ${ bodyHeight }px)`;
		}
	}
}

class SecurityRibbon extends HTMLElement {

	constructor() {
		super();
		this.label = this.getAttribute('label');
		this.value = this.getAttribute('value');
		this.init();
	}

	init() {
		
		// create style element
        const style = document.createElement("style");
        style.textContent = `
            .wrapper {
                white-space: nowrap;
                overflow: hidden;
				display: flex;
				justify-content: space-between;
            }
        `;

		// apply style to the shadow
		this.shadow = this.attachShadow({ mode: "open" });
		this.shadow.appendChild(style);

		// stamp
		this.stamp = document.createElement('div');
		this.stamp.classList.add('stamp');
		this.stamp.innerText = this.value;

		// wrapper
		this.wrapper = document.createElement('div');
		this.wrapper.classList.add('wrapper');
		this.wrapper.appendChild(this.stamp);
        this.shadow.appendChild(this.wrapper);

		

		this.update();

		window.addEventListener('resize', () => {
			this.update();
		});
	}

	update() {

		// get stamp width
		this.stampWidth = this.stamp.getBoundingClientRect().right - this.stamp.getBoundingClientRect().left;
		
		// get num copies
		this.numCopies = Math.floor(window.innerWidth / this.stampWidth / 2);

		if (this.wrapper.childElementCount != this.numCopies) {
			while (this.wrapper.childElementCount < this.numCopies) {
				const clone = this.stamp.cloneNode(true);
				this.wrapper.appendChild(clone);
			}
			while (this.wrapper.childElementCount > this.numCopies) {
				this.wrapper.removeChild(this.wrapper.lastElementChild);
			}
		}

	}
}

customElements.define('security-ribbon', SecurityRibbon);
customElements.define('update-block', UpdateBlock);
customElements.define('meta-text', MetaText);
customElements.define('hologram-sticker', HologramSticker);