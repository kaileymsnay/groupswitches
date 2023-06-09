<?php
/**
 *
 * Group Switches extension for the phpBB Forum Software package
 *
 * @copyright (c) 2021, Kailey Snay, https://www.snayhomelab.com/
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace kaileymsnay\groupswitches\acp;

/**
 * Group Switches ACP module info
 */
class main_info
{
	public function module()
	{
		return [
			'filename'	=> '\kaileymsnay\groupswitches\acp\main_module',
			'title'		=> 'GROUP_SWITCHES',
			'modes'		=> [
				'main'	=> [
					'title'	=> 'GROUP_SWITCHES',
					'auth'	=> 'ext_kaileymsnay/groupswitches && acl_a_group',
					'cat'	=> ['ACP_GROUPS'],
				],
			],
		];
	}
}
