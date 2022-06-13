<?php
namespace Modules;
use Timber;
use JP\Get;

## Use this module as an example to set up more modules.

class TwoColumnCards {
	protected $defaults;
	protected $context;

	public function __construct( $args=[] ){
		$this->defaults = [
			'section_title' => false,
			'section_cta' => false,
            'cards' => false,
            'classes' => [
                'pageBuilderModule',
                'pageBuilderModule--twoColumnCards',
                'twoColumnCards'
            ]
		];

        extract(array_merge($this->defaults, $args));

        if($section_cta){
            $section_cta_link = '';
            $section_cta_link = $section_cta['link'];
            if($section_cta_link){
                $section_cta_link = $section_cta_link['url'];
            }

            $section_cta_text = $section_cta['text'];
        }

        $cards_output = [];

        if( is_array($cards) and !empty($cards) ):
            foreach( $cards as $card ):


                $image_html = '';
                $image_url = '';
                if( is_array($card['card_image']) && isset($card['card_image']['sizes']['large']) ):
                    $image_args = [
                        'image_array' => $card['card_image'],
                        'size' => 'large',
                        'classes' => ['threeColumn-image'],
                    ];
                    $image_html = Get::image_html( $image_args );

                    $image_url = $card['card_image']['sizes']['large'];
                endif;
                
                $card_link = 'false';
                $card_link = $card['card_link'];
                if(is_array($card_link)){
                    $card_link = $card_link['url'];
                }
                

                $this_card = [
                    'image_url' => $image_url,
                    'title' => $card['card_title'],
                    'link' => $card_link,
                    'content' => $card['card_text']
                    
                ];
                

                $cards_output[] = $this_card;

            endforeach;
        endif;

		

		$this->context = Timber::get_context();
		$this->context['section_title'] = $section_title;
		$this->context['section_cta_link'] = $section_cta_link;
        $this->context['section_cta_text'] = $section_cta_text;
        $this->context['cards'] = $cards_output;
        $this->context['classes'] = implode(' ', $classes);
	}

	public function render(){
		Timber::render('twoColumnCards.twig', $this->context);
	}
}
