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
 * Group Switches ACP module
 */
class main_module
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\group\helper $group_helper */
	protected $group_helper;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var string */
	public $page_title;

	/** @var string */
	public $tpl_name;

	/** @var string */
	public $u_action;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		global $phpbb_container;

		$this->db = $phpbb_container->get('dbal.conn');
		$this->group_helper = $phpbb_container->get('group_helper');
		$this->language = $phpbb_container->get('language');
		$this->template = $phpbb_container->get('template');

		$this->tables['groups'] = $phpbb_container->getParameter('tables.groups');
	}

	/**
	 * Main ACP module
	 */
	public function main($id, $mode)
	{
		// Load a template from adm/style for our ACP page
		$this->tpl_name = 'acp_groupswitches_body';

		// Set the page title for our ACP page
		$this->page_title = $this->language->lang('GROUP_SWITCHES');

		// Grab all the groups
		$sql = 'SELECT group_name, group_id
			FROM ' . $this->tables['groups'] . '
			ORDER BY group_name';
		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$group_name = $this->group_helper->get_name($row['group_name']);

			$this->template->assign_block_vars('groups', [
				'GROUP_NAME'	=> $group_name,
				'GROUP_ID'		=> $row['group_id'],
			]);
		}
		$this->db->sql_freeresult($result);
	}
}
