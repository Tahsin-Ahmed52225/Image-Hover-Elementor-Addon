<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}

class Elementor_Image_hover_Scrolling_Tdg extends Widget_Base
{

	public function get_name()
	{
		return 'e_image_hover_effects';
	}

	public function get_title()
	{
		return esc_html__('Image Hover Scrolling Effects', 'tdg-lang');
	}

	public function get_icon()
	{
		return 'eicon-image-rollover';
	}

	protected function _register_controls()
	{

		$this->start_controls_section(
			'tdg_content',
			[
				'label' => esc_html__('Image Scrolling Effects', 'eihe-lang'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);




		$this->add_control(
			'tdg_effect',
			[
				'label'       	=> esc_html__('Effects', 'tdg-lang'),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
					'tdg-scrollUp'						=> esc_html__('Scroll Up', 'tdg-lang'),
					'tdg-scrollDown'				=> esc_html__('Scroll Down', 'tdg-lang'),

				],
				'default' 		=> 'tdg-scrollUp',
			]
		);



		$this->add_control(
			'tdg_image',
			[
				'label' => esc_html__('Choose Image', 'tdg-lang'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'separator' => 'before',
			]
		);

		// Image height customize start 
		$this->add_control(
			'tdg_height',
			[
				'label' => esc_html__('Height', 'tdg-lang'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],

				],
				'default' => [
					'unit' => 'px',
					'size' => 400,
				],
				'selectors' => [
					'{{WRAPPER}} .tdg-box >.tdg_img_wrapper' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		//Image height customize Ends

		//Image Transection Speed Starts 
		$this->add_control(
			'tdg_transition',
			[
				'label' => esc_html__('Transition Time', 'tdg-lang'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['s'],
				'range' => [
					's' => [
						'min' => 0,
						'max' => 10,
						'step' => 1,
					],

				],
				'default' => [
					'unit' => 's',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .tdg-box >.tdg_img_wrapper> img:hover' => 'transition-duration: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tdg-box >.tdg_img_wrapper> img' => 'transition-duration: {{SIZE}}{{UNIT}};',
				],
			]
		);


		//Iamge Transection  Ends 


		//-------------------------------------------------------

		//Turn on switch for Title 

		$this->add_control(
			'tdg_show_title',
			[
				'label' => __('Show Title', 'tdg-lang'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'tdg-lang'),
				'label_off' => __('Hide', 'tdg-lang'),
				'separator' => 'before',
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


		//Turn on switch for Title


		$this->add_control(
			'tdg_title',
			[
				'label' 	  => __('Title', 'tdg-lang'),
				'type' 		  => Controls_Manager::TEXT,
				'default' 	  => __('Title', 'tdg-lang'),
				'placeholder' => __('Type your title here', 'tdg-lang'),

				'label_block' => true
			]
		);

		$this->add_control(
			'tdg_tag',
			[
				'label'     => esc_html__('Title Tag', 'tdg-lang'),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'h1'	=> esc_html__('H1', 'tdg-lang'),
					'h2'	=> esc_html__('H2', 'tdg-lang'),
					'h3'	=> esc_html__('H3', 'tdg-lang'),
					'h4'	=> esc_html__('H4', 'tdg-lang'),
					'h5'	=> esc_html__('H5', 'tdg-lang'),
					'h6'	=> esc_html__('H6', 'tdg-lang'),
					'p'		=> esc_html__('Paragraph', 'tdg-lang'),
					'span'	=> esc_html__('Span', 'tdg-lang'),
				],
				'default' 	=> 'h3',
			]
		);

		// $this->add_control(
		// 	'tdg_description',
		// 	[
		// 		'label' 	  => __('Description', 'tdg-lang'),
		// 		'type' 		  => Controls_Manager::TEXTAREA,
		// 		'rows'	 	  => 5,
		// 		'default' 	  => __('Description', 'tdg-lang'),
		// 		'placeholder' => __('Type your description here', 'tdg-lang'),
		// 		'show_label'  => true,
		// 		'separator' => 'before',
		// 	]
		// );

		$this->add_control(
			'icon',
			[
				'label'       => __('Icon', 'tdg-lang'),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_order',
			[
				'label'       	    => esc_html__('Icon Position', 'tdg-lang'),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
					'before' 	=> esc_html__('Before', 'tdg-lang'),
					'after' 	=> esc_html__('After', 'tdg-lang'),
				],
				'default' 		=> 'after',
			]
		);

		$this->add_control(
			'tdg_link',
			[
				'label' 			=> __('Link To', 'tdg-lang'),
				'type' 				=> Controls_Manager::URL,
				'placeholder' 	    => __('https://your-link.com', 'tdg-lang'),
				'show_external'     => true,
				'separator' => 'before',
				'default' 		    => [
					'url' 		    => '',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				]
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'tdg_content_style',
			[
				'label'         => esc_html__('Style', 'tdg-lang'),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tdg_background_color',
			[
				'label'         => esc_html__('Background', 'tdg-lang'),
				'type'          => Controls_Manager::COLOR,
				'default' 		=> '#6ec1e4',
				'scheme'        => [
					'type'  		=> Scheme_Color::get_type(),
					'value' 		=> Scheme_Color::COLOR_1,
				],
				'selectors'     => [
					"{{WRAPPER}} .tdg-box,
					{{WRAPPER}} .tdg-box .tdg-caption,
					{{WRAPPER}} .tdg-box[class^='tdg-shutter-in-']:after,
					{{WRAPPER}} .tdg-box[class^='tdg-shutter-in-']:before,
					{{WRAPPER}} .tdg-box[class*=' tdg-shutter-in-']:after,
					{{WRAPPER}} .tdg-box[class*=' tdg-shutter-in-']:before,
					{{WRAPPER}} .tdg-box[class^='tdg-shutter-out-']:before,
					{{WRAPPER}} .tdg-box[class*=' tdg-shutter-out-']:before,
					{{WRAPPER}} .tdg-box[class^='tdg-reveal-']:before,
					{{WRAPPER}} .tdg-box[class*=' tdg-reveal-']:before"  => "background-color: {{VALUE}};",
					"{{WRAPPER}} .tdg-box[class*=' tdg-reveal-'] .tdg-caption"  => "background: {{VALUE}};",
					"{{WRAPPER}} .tdg-box[class*=' tdg-shutter-in-'] .tdg-caption"  => "background: {{VALUE}};",
					"{{WRAPPER}} .tdg-box[class*=' tdg-shutter-out-'] .tdg-caption"  => "background: {{VALUE}};",
				]
			]
		);

		$this->add_responsive_control(
			'tdg_align',
			[
				'label'   => esc_html__('Horizontal Alignment', 'tdg-lang'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('flex-start', 'tdg-lang'),
						'icon'  => 'fa fa-align-left',
					],
					'center'    => [
						'title' => esc_html__('center', 'tdg-lang'),
						'icon'  => 'fa fa-align-center',
					],
					'flex-end'  => [
						'title' => esc_html__('flex-end', 'tdg-lang'),
						'icon'  => 'fa fa-align-right',
					]
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .tdg-box .tdg-caption .tdg-title-cover' => 'justify-content: {{VALUE}}',
				]
			]
		);



		$this->add_control(
			'tdg_padding',
			[
				'label'     => esc_html__('Padding', 'tdg-lang'),
				'type'      => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'   => [
					'top'   => 0,
					'right' => 0,
					'bottom' => 0,
					'left'  => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .tdg-box .tdg-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
				]
			]
		);

		$this->add_control(
			'tdg_image_border_radius',
			[
				'label'      	=> esc_html__('Border Radius', 'tdg-lang'),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> ['px', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .tdg-box >.tdg_img_wrapper > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0{{UNIT}} 0{{UNIT}}',
					'{{WRAPPER}} .tdg-box > .tdg_img_wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0{{UNIT}} 0{{UNIT}}',
					'{{WRAPPER}} .tdg-box ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .tdg-box > .tdg-caption' => 'border-radius: 0{{UNIT}} 0{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				]
			]
		);

		$this->add_control(
			'tdg_title_heading',
			[
				'label'     => __('Title', 'tdg-lang'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tdg_title_color',
			[
				'label'     => __('Color', 'tdg-lang'),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .tdg-box .tdg-caption .tdg-title-cover .tdg-title' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'tdg_title_typography',
				'label' 	=> __('Typography', 'eihe-lang'),
				'scheme' 	=> Scheme_Typography::TYPOGRAPHY_1,
				'selector' 	=> '{{WRAPPER}} .tdg-box .tdg-caption .tdg-title-cover .tdg-title'
			]
		);

		// $this->add_control(
		// 	'tdg_description_heading',
		// 	[
		// 		'label'     => __('Description', 'tdg-lang'),
		// 		'type'      => Controls_Manager::HEADING,
		// 		'separator' => 'before',
		// 	]
		// );

		// $this->add_control(
		// 	'tdg_description_color',
		// 	[
		// 		'label'     => __('Color', 'tdg-lang'),
		// 		'type'      => Controls_Manager::COLOR,
		// 		'scheme'    => [
		// 			'type'  => Scheme_Color::get_type(),
		// 			'value' => Scheme_Color::COLOR_1,
		// 		],
		// 		'default'   => '#fff',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .tdg-box .tdg-caption p' => 'color: {{VALUE}}'
		// 		]
		// 	]
		// );

		// $this->add_group_control(
		// 	Group_Control_Typography::get_type(),
		// 	[
		// 		'name' 		=> 'tdg_description_typography',
		// 		'label' 	=> __('Typography', 'tdg-lang'),
		// 		'scheme' 	=> Scheme_Typography::TYPOGRAPHY_1,
		// 		'selector' 	=> '{{WRAPPER}} .tdg-box .tdg-caption p'
		// 	]
		// );

		$this->add_control(
			'icon_heading',
			[
				'label'     => __('Icon', 'tdg-lang'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __('Color', 'tdg-lang'),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => '#dddddd',
				'selectors' => [
					'{{WRAPPER}} .tdg-box .tdg-caption .tdg-title-cover .tdg-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => __('Icon Size', 'tdg-lang'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 30
				],
				'selectors' => [
					'{{WRAPPER}} .tdg-box .tdg-caption .tdg-title-cover .tdg-icon' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_space',
			[
				'label' => __('Icon Space', 'tdg-lang'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'default' => [
					'size' => 15
				],
				'selectors' => [
					'{{WRAPPER}} .tdg-box .tdg-caption .tdg-title-cover .tdg-ileft' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tdg-box .tdg-caption .tdg-title-cover .tdg-iright' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{

		$settings = $this->get_settings_for_display();

		$tdg_tag = $settings['tdg_tag'];
		$icon = $settings['icon'];
		$icon_order = $settings['icon_order'];
		$tdg_align = $settings['tdg_align'];

		$target = $settings['tdg_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['tdg_link']['nofollow'] ? ' rel="nofollow"' : '';

		if (strlen($settings['tdg_link']['url']) > 0) { ?>
			<a href="<?php echo $settings['tdg_link']['url']; ?>" <?php echo $target . $nofollow; ?>>
			<?php } ?>
			<div class="tdg-box <?php echo $settings['tdg_effect'] . ' tdg_' . $tdg_align; ?>">
				<div class="tdg_img_wrapper">
					<?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'tdg_thumbnail', 'tdg_image'); ?>
				</div>
				<div class="tdg-caption">
					<div class="tdg-title-cover">
						<?php if ($icon_order == 'before' && !empty($icon) && !empty($icon['value'])) { ?><div class="tdg-ileft tdg-icon"><?php Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']); ?> </div> <?php } ?>

						<?php if ($settings['tdg_show_title'] == 'yes') {
							echo "<" . $tdg_tag . " class='tdg-title'> " . $settings['tdg_title'] . " </" . $tdg_tag . ">";
						}
						?>
						<?php if ($icon_order == 'after' && !empty($icon) && !empty($icon['value'])) { ?><div class="tdg-iright tdg-icon"><?php Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']);  ?> </div> <?php } ?>

					</div>
				</div>
			</div>
			<?php if (strlen($settings['tdg_link']['url']) > 0) { ?>
			</a>
		<?php }
		}

		protected function _content_template()
		{
		?>
		<# var image={ id: settings.tdg_image.id, url: settings.tdg_image.url, size: settings.tdg_thumbnail_size, dimension: settings.tdg_thumbnail_custom_dimension, model: view.getEditModel() }; var image_url=elementor.imagesManager.getImageUrl(image); var icon=settings.icon; var icon_order=settings.icon_order; var iconHTML='' ; var target=settings.tdg_link.is_external ? ' target="_blank"' : '' ; var nofollow=settings.tdg_link.nofollow ? ' rel="nofollow"' : '' ; if (settings.tdg_link.url.length> 0) { #>
			<a href="{{{ settings.tdg_link.url }}}" {{ target }}{{ nofollow }}>
				<# } #>
					<div class="tdg-box {{{ settings.tdg_effect }}} tdg_{{{ settings.tdg_align }}}">
						<div class="tdg_img_wrapper">
							<img src="{{{ image_url }}}" />
						</div>

						<div class="tdg-caption">
							<div class="tdg-title-cover">
								<# if(icon && settings.icon.value && icon_order=='before' ){ iconHTML=elementor.helpers.renderIcon(view, settings.icon, { 'aria-hidden' : true }, 'i' , 'object' ); #>
									<div class="tdg-ileft tdg-icon">{{{ iconHTML.value }}}</div>
									<# } #>


										<# if ( settings.tdg_show_title=='yes' ) { #>
											<{{{settings.tdg_tag}}} class="tdg-title">{{{ settings.tdg_title }}}</{{{settings.tdg_tag}}}>
											<# } #>

												<# if(icon && settings.icon.value && icon_order=='after' ){ iconHTML=elementor.helpers.renderIcon(view, settings.icon, { 'aria-hidden' : true }, 'i' , 'object' ); #>
													<div class="tdg-iright tdg-icon">{{{ iconHTML.value }}}</div>
													<# } #>

							</div>
						</div>
					</div>
					<# if (settings.tdg_link.url.length> 0) { #>
			</a>
			<# } #>

		<?php
		}
	}

	Plugin::instance()->widgets_manager->register_widget_type(new Elementor_Image_hover_Scrolling_Tdg());
