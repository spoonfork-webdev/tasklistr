<?php defined('_JEXEC') or die('Restricted Access');

class TasklistrModelsTask extends TasklistrModelsDefault
{
	var $_task_id = null;

	protected function _buildQuery()
	{
		$db = JFactory::getDBO();
		$user = JFactory::getUser();

		$query = $db->getQuery(TRUE);

		$query->select('*');
		$query->where('user_id = ' . (int) $user->id);
		$query->from('#__tasklistr_tasks');

		return $query;
	}

	protected function _buildWhere($query)
	{
		if(is_numeric($this->_task_id)) {
			$query->where('task_id = '. (int) $this->_task_id);
		}

		return $query;
	}

	public function delete($id)
	{
		$db = JFactory::getDBO();
		$row = JTable::getInstance('task', 'Table');
		$row->load($id);

		if($row->delete()) {
			return true;
		}

		return false;
	}
}