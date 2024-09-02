<?php

use Kirby\Http\Remote;
use Kirby\Cms\File;
use Kirby\Cms\Page;

Kirby::plugin('beedot/discord-spider', [

	'fields' => [
        'discord_spider' => []
    ],

	'siteMethods' => [
		'discordMessages' => function () {
			$response = Remote::get('http://discord-spider:8888');
			
			if ($response->code() === 200) {

				// get json data
				$data = $response->json();

				// Create page if it doesnt exist
				if (!$this->pages()->find('discord-spider')) {
					Page::create([
						'slug' => 'discord-spider',
						'draft' => false,
					]);
				}
				
				// build messages object
				$messages = array_map(
					function ($d) {

						// metadata
						$id = $d['data']['target_id'];
						$message = $d['data']['resolved']['messages'][$id];
						$username = $message['author']['username'];
						$content = $message['content'];
						$time = date_format(date_create($message['timestamp']), 'h:ia');
						$attachment = null;
						
						// if message has attachment(s)
						if (count($message['attachments'])) {

							// vars
							$contentType = $message['attachments'][0]['content_type'];
							$filename = $message['attachments'][0]['filename'];
							$sourceUrl = $message['attachments'][0]['url'];
							$targetRoot = __DIR__ . '/assets/' . $filename;
							$parent = $this->pages()->find('discord-spider');

							// create the file if it doesnt exist
							if (!$parent->files()->find($filename)) {
								$file = file_get_contents($sourceUrl);
								file_put_contents($targetRoot, $file);
								File::create([
									'source' => $targetRoot,
									'parent' => $parent,
									'type' => 'image',
								], true);
							}

							// return appropriate type
							switch ($contentType) {
								case 'image/png':
								case 'image/jpeg':
									$attachment = $parent->files()->find($filename);
									break;
							}
						}
						
						// return formatted object
						return (object) [
							'id' => $id,
							'username' => $username,
							'time' => $time,
							'attachment' => $attachment,
							'content' => $content,
						];

					},
					$data
				);

				return $messages;

			} else { return []; }
		}
	]

]);