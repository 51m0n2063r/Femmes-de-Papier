<?php
namespace MBSocial;

class googleplusNetwork extends mbNetwork
{
	protected $network = 'googleplus';
	protected $icon = 'fa-google-plus-g';
	protected $color = '#dd4b39';

	public function __construct()
	{
		$this->label = __('+1','mbsocial');
		$this->share_url = 'https://plus.google.com/share?url={url}';
		$this->profile_url = 'https://plus.google.com/{profile}';
		$this->countable = true;
		$this->count_api = '{url}';
		$this->popup_dimensions = array(600,600);
		parent::__construct();

	}

	public function remoteRequest($url)
	{
		 $args = array(
            'method' => 'POST',
            'headers' => array(
                // setup content type to JSON
                'Content-Type' => 'application/json',
            ),
            // setup POST options to Google API
            'body' => json_encode(array(
                'method' => 'pos.plusones.get',
                'id' => 'p',
                'method' => 'pos.plusones.get',
                'jsonrpc' => '2.0',
                'key' => 'p',
                'apiVersion' => 'v1',
                'params' => array(
                    'nolog' => true,
                    'id' => $url,
                    'source' => 'widget',
                    'userId' => '@viewer',
                    'groupId' => '@self',
                ),
             )),

            'sslverify' => false,
        );
	  $response = wp_remote_post('https://clients6.google.com/rpc', $args);


	 	if (is_wp_error($response) || $response['response']['code'] != 200) {
			return false;
		}
		else {
			$result = wp_remote_retrieve_body($response);
		}

		$result = json_decode($result, true);
		$count = 0;
		if (isset($result['result']['metadata']['globalCounts']['count']))
	 	{	$count = intval($result['result']['metadata']['globalCounts']['count']);
	 		return $count;
	 	}

 		return 0;

	}
}
