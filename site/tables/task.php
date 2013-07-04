<?php defined('_JEXEC') or die('Restricted Access');

class TableTask extends JTable
{
	function __construct(&$db) {
		parent::__construct('#__tasklistr_tasks', 'task_id', $db);
	}
}