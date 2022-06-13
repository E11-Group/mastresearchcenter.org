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

class ThreeColumnText {
	protected $defaults;
	protected $context;

	public function __construct( $args=[] ){
		$this->defaults = [
			'content' => false,
            'column1' => false,
            'column2' => false,
			'classes' => [
				'l__module',
                'threeColumnText'
			]
		];

		extract(array_merge($this->defaults, $args));

		$this->context = Timber::get_context();
		$this->context['column1'] = $column1;
        $this->context['column2'] = $column2;
        $this->context['column3'] = $column3;
		$this->context['classes'] = implode(' ', $classes);

	}

	public function render(){
		Timber::render('threeColumnText.twig', $this->context);
	}

}
