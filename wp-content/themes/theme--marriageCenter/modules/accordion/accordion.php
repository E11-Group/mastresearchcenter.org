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
	// $new_module = new Accordion($args);
	// $new_module->render();

class Accordion {
	protected $defaults;
	protected $context;

	public function __construct( $args=[] ){
		$this->defaults = [
            'section_title' => 'false',
            'accordions' => false,
			'classes' => [
				'l__module',
				'accordionWrap',
			]
		];

		extract(array_merge($this->defaults, $args));

        
		$this->context = Timber::get_context();
        $this->context['sectionTitle'] = $section_title;
		$this->context['accordions'] = $accordions;
		$this->context['classes'] = implode(' ', $classes);

	}

	public function render(){
		Timber::render('accordion.twig', $this->context);
	}

}
