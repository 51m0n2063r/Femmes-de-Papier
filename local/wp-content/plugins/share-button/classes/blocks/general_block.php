<?php
namespace MBSocial;
defined('ABSPATH') or die('No direct access permitted');

use \MaxButtons\maxField as maxField;
use \MaxButtons\maxBlocks as maxBlocks;

$collectionBlock["general"] = array('class' => "generalBlock",
									'order' => 5);


class generalBlock extends block
{
	protected $blockname = 'general';
	protected $fields = array(
					   'name' => array('default' => ''),
					   'active' => array('default' => 1),
					   );

	function save_fields($data, $post)
	{
	 		$data = parent::save_fields($data, $post);
			if (! isset($post['active']) && ! is_null($post) )
			{
					$data[$this->blockname]['active'] = 0;
			}

			return $data;
	}

	 public function do_meta_boxes($content, $post)
	 {

	 	$admin = mbSocial()->admin();

	 	$metadata = $this->get_block_meta_data($post->ID);

		$is_hidden = isset($metadata['hide']) ? $metadata['hide']: 0;

		$active = new maxField('switch');
		$active->label = __('Hide', 'mbsocial');
		$active->id = 'mbsocial_hide';
		$active->name = $active->id;
		$active->value = '1';
		$active->note = __('This option can be used to hide the social share only here', 'mb-social');
		$active->checked = checked( $is_hidden , 1, false);

		$admin->addField($active, 'start','end');

	 	$fields = $admin->display_fields(true, true, false);

	 	$content['display'] = array('title' => __('Display Options', 'mbsocial'),
	 								'icon' => 'display',
	 								'content' => $fields,
	 						);

	 	return $content;
	 }

public function save_meta_boxes($metadata, $post_id, $post)
{
	 $is_active = isset($post['mbsocial_hide']) ? intval($post['mbsocial_hide']) : 0;
	 $metadata[$this->blockname]['hide'] = $is_active;

	 return $metadata;


}

	public function admin()
	{
		$admin = MBSocial()->admin();

	?>
		<div class='option-container general' id='generalBlock' >
		<div class='title'><?php _e('General','mbsocial'); ?></div>
		<div class='inside'>
	<?php

		$field_name = new maxField() ;
		$field_name->label = __('Name', 'mbsocial');
	//	$field_name->note = __('Something that you can quickly identify the button with.', 'maxbuttons');
		$field_name->value = $this->getValue('name');
		$field_name->id = 'name';
		$field_name->name = $field_name->id;
		$field_name->placeholder = __("Name","mbsocial");
		$field_name->output('start','end');

		// until multi-collection done not in use
		//$admin->addField($field_name, 'start','end');

		$active = new maxField('switch');
		$active->label = __('Active', 'mbsocial');
		$active->id = 'active';
		$active->name = $active->id;
		$active->value = '1';
		$active->checked = checked( $this->getValue('active'), 1, false);

		$admin->addField($active, 'start','end');


		$admin->display_fields();
	?>
			</div>
		</div>
	<?php
	}


}
