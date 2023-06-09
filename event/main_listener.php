<?php
/**
 *
 * Group Switches extension for the phpBB Forum Software package
 *
 * @copyright (c) 2021, Kailey Snay, https://www.snayhomelab.com/
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace kaileymsnay\groupswitches\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Group Switches event listener
 */
class main_listener implements EventSubscriberInterface
{
	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var */
	protected $root_path;

	/** @var */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\template\template  $template
	 * @param \phpbb\user               $user
	 * @param                           $root_path
	 * @param                           $php_ext
	 */
	public function __construct(\phpbb\template\template $template, \phpbb\user $user, $root_path, $php_ext)
	{
		$this->template = $template;
		$this->user = $user;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	public static function getSubscribedEvents()
	{
		return [
			'core.page_header'	=> 'main',
		];
	}

	public function main($event)
	{
		if (!function_exists('group_memberships'))
		{
			include($this->root_path . 'includes/functions_user.' . $this->php_ext);
		}

		$groups = group_memberships(false, $this->user->data['user_id']);

		if (count($groups))
		{
			foreach ($groups as $grouprec)
			{
				$this->template->assign_vars([
					'S_GROUP_' . $grouprec['group_id']	=> true,
				]);
			}
		}
	}
}
