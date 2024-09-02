panel.plugin('beedot/discord-spider', {
	fields: {
		discord_spider: {
			data() {
				return { messages: [] }
			},
			mounted() {
				this.fetchData();
			},
			methods: {
				async fetchData() {

					// fetch json
					const response = await fetch('/discord-spider');
					const data = await response.json();
					this.update(data);

				},
				async removeMessage(id) {

					// send delete request
					const response = await fetch(`/discord-spider?id=${id}`, { 
						method: 'DELETE' 
					});
					const data = await response.json();
					this.update(data);

				},
				update(data) {

					// create messages array
					this.messages = data.map((d) => { 
						const id = d.id;
						const message = d.data.resolved.messages[d.data.target_id];
						const info = new Date(message.timestamp).toLocaleString();
						const text = [
							message.author.username,
							(message.attachments.length) 
								? `${message.attachments.length} attachment(s)` 
								: '',
								message.content,
						].filter(Boolean).join(' : ');
						return { id, text, info }
					});

				}
			},
			template: `
				<k-section label="Updates">
					<k-grid style="gap: 0.25rem; --columns: 1">
						<k-item
							v-for="message in messages"
							:buttons="[{ 
								icon: 'trash',
								click: () => { removeMessage(message.id) }
							}]"
							:text="message.text"
							:info="message.info"
							width="1/2"
						/>
					</k-grid>
				</k-section>
			`,
		},
	}
});