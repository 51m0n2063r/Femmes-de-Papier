<?php
namespace MBSocial;


class vkontakteNetwork extends mbNetwork
{
	protected $network = 'vkontakte';
	protected $priority = 'readmore';
	protected $icon = 'fa-vk';
	protected $color = '#4c75a3';


	public function __construct()
	{

		$this->label = __('Share', 'mbsocial');
		$this->share_url = 'https://vkontakte.ru/share.php?url={url}';
		$this->count_api = 'https://vk.com/share.php?act=count&url={url}';
		$this->profile_url = 'https://vk.com/{profile}';

		$this->countable = true;
		parent::__construct();

		// count function  vKontakteCount
	}

	public function remoteRequest($url)
	{

		$response = wp_remote_get($url);

		if (is_wp_error($response) || $response['response']['code'] != 200) {
				return false;
			}
		else {
				$result = wp_remote_retrieve_body($response);
		}

		preg_match('/(\d+),\s+(\d+)/i', $result, $matches);
		if (isset($matches[2]))  // 0 is both patterns, one is first number (not used?).
		{	$count = $matches[2];
			return $count;
		}
		return 0;

	}

}
