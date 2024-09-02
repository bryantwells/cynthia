<?php

use Kirby\Cms\File;

Kirby::plugin('beedot/etcher', [
	'fileMethods' => [
        'etch' => function (string $script, int $width, int $height) {

			// vars
			$filename = $this->name() . '_etch_' . $width . 'x' . $height . '.png';
			$sourceRoot = $this->root();
			$targetRoot = __DIR__ . '/assets/' . $filename; 

			// build the drawing command
			$commandList = [

				// resize
				'convert',
				$sourceRoot,
				'-resize',
				"{$width}x{$height}",
				__DIR__ . '/assets/' . 'resize_' . $filename,

				// vignette
				'&&',
				__DIR__ . '/vignette',
				'-a 25 -d 90% -s roundrectangle -c white -m lighten',
				__DIR__ . '/assets/' . 'resize_' . $filename,
				__DIR__ . '/assets/' . 'blur_' . $filename,

				// etch
				'&&',
				'xvfb-run',
				'-a /usr/processing-4.3/processing-java',
				'--sketch=' . __DIR__ . '/sketches/' . $script,
				'--run',
				__DIR__ . '/assets/' . 'blur_' . $filename,
				$targetRoot,
				$width,
				$height,
			];

			// run the command
			$command = implode(' ', $commandList);

			// create the image if it doesnt exist
			if (!$this->parent()->files()->find($filename)) {

				exec($command, $output, $result);
				return File::create([
					'source' => $targetRoot,
					'parent' => $this->parent(),
					'type' => 'image',
				], true);
			}

			// return the image if it already exists
			return $this->parent()->files()->find($filename);
			
        }
    ]
]);