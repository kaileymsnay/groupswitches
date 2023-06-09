<?php
/**
 *
 * Group Switches extension for the phpBB Forum Software package
 *
 * @copyright (c) 2021, Kailey Snay, https://www.snayhomelab.com/
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace kaileymsnay\groupswitches\migrations\v10x;

class m1_initial_data extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v330\v330'];
	}

	public function update_data()
	{
		return [
			['module.add', [
				'acp',
				'ACP_GROUPS',
				[
					'module_basename'	=> '\kaileymsnay\groupswitches\acp\main_module',
					'auth'				=> 'ext_kaileymsnay/groupswitches && acl_a_group',
					'modes'				=> ['main'],
				],
			]],
		];
	}
}
