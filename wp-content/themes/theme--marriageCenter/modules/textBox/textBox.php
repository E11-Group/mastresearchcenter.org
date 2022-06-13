<?php
namespace Modules;
use Timber;

### Example usage
	// $args = [
	// 	'primary_heading' => get_field('primary_heading'),
	// 	'description' => get_field('description'),
	// 	'button_url' => get_field('button_url'),
	// 	'button_label' => get_field('button_label'),
	// ];
	// $new_module = new StandardText($args);
	// $new_module->render();

class textBox {
	protected $defaults;
	protected $context;

	public function __construct( $args=[] ){
		$this->defaults = [
			'content' => false,
			'classes' => [
				'l__module',
				'textBox',
			]
		];

		extract(array_merge($this->defaults, $args));

		$this->context = Timber::get_context();
		$this->context['content'] = $content;
		$this->context['classes'] = implode(' ', $classes);

	}

	public function render(){
		Timber::render('textBox.twig', $this->context);
	}

}
