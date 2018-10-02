<?php
namespace MBSocial;
defined('ABSPATH') or die('No direct access permitted');

use \MaxButtons\maxField as maxField;
use \MaxButtons\maxBlocks as maxBlocks;
use \MaxButtons\maxUtils as maxUtils;

$collectionBlock["profile"] = array('order' => 60,
								   'class' => "profileBlock"
								  );

class profileBlock extends block
{
	protected $blockname = "profile";
	protected $fields = array();


	public function __construct()
	{
			// create the fields
			$networks = MBSocial()->networks()->get();
			foreach($networks as $network)
			{
					if ($network->is_share_icon())
					{
						$name = $network->get('network');
						$this->fields['profile_' . $name] = array('default' => '');

						if ($network->is_social_share())
						{
							$this->fields['useprofile_' . $name] = array('default' => 0);
						}
					}
			}

			MBSocial()->whistle()->listen('display/vars/profile', array($this, 'get_profile'), 'ask'); // somebody asks for profile name
			MBSocial()->whistle()->listen('editor/profile/use', array($this, 'get_profile_use'), 'ask');  // somebody asks for useprofile settings
	}

	public function get_profile()
	{
		$network = MBSocial()->whistle()->ask('display/parse/network');

		if (is_object($network))
		{
				$name = $network->get('network');
				$blockdata = $this->data[$this->blockname];

				if (isset($blockdata['profile_' . $name]))
				{
					$profile = $blockdata['profile_' . $name];
					return $profile;
				}
		}

		return '';
	}

	public function get_profile_use()
	{
		$network = MBSocial()->whistle()->ask('display/parse/network');

		if (is_object($network))
		{
			$name = $network->get('network');
			$blockdata = $this->data[$this->blockname];

			if (isset($blockdata['useprofile_'. $name]))
			{
				return $blockdata['useprofile_' . $name];
			}
			else {
					return false;
			}
		}
	}

	public function admin()
	{
		$admin = mbSocial()->admin();
		$active_networks = isset($this->data['network']['active']) ? $this->data['network']['active'] : array();
		$networks = mbSocial()->networks()->get(); // all networks!

		foreach($networks as $network)
		{
			if ($network->is_share_icon() )
			{
				$name = $network->get('network');
				$placeholder = $network->get('profile_placeholder');
				$profile_url = $network->get('profile_url');

					$profile_url = str_replace('{profile}', '', $profile_url);
				if ($profile_url != '')
					 $profile_url = trailingslashit($profile_url);
				$conditional = htmlentities(json_encode(array("target" => 'network_item_active[]', 'values' => array($name))));

				$field = new maxField('text');
				$field->id = 'profile_' . $name;
				$field->name = $field->id;
				$field->label = $network->get_nice_name();
				$field->value = $this->getValue($field->id);
				$field->placeholder = $placeholder;
				$field->before_input = $profile_url;
				$field->inputclass = 'medium';

				$field->start_cond_type = 'has';
				$field->start_conditional = $conditional;

				if ($network->is_social_share())
					$admin->addField($field, 'start', '', false);
				 else {
					 $admin->addField($field, 'start', 'end', false);
				 }

				// when it's both, display choice
				if ($network->is_social_share() )
				{
					$sw = new maxField('switch');
					$sw->id = 'useprofile_' . $name;
					$sw->name = $sw->id;
					$sw->label = '';
					$sw->label = __('Use Profile', 'mbsocial');
					$sw->value = 1;
					$sw->inputclass = 'check_button icon';
					$sw->checked = checked(1, $this->getValue($sw->name), false);

					$admin->addField($sw, '','end', false);
				}

			}


		}

		if (count($networks) > 0)
		{
			?>
			<div class='help-side'>
					<h3><?php _e('Profile Options', 'mbsocial'); ?></h3>

					<p>Fill out the link to your profile on the network. </p>

					<p><strong>Use Profile :</strong> Check this to share your profile instead of the current page. This option is available for networks supporting both options</p>
			</div>

			<div class='options option-container layout' id='profileBlock' data-refresh='previewBlock'  >
				<div class='title'><?php _e('Profiles', 'mbsocial' ); ?></div>
				<div class='inside'>
			<?php
			$admin->display_fields();
			?>
				</div>
			</div>
			<?php
		}

	}

}
