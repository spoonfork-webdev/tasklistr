<?php defined('_JEXEC') or die('Restricted Access');

class TasklistrModelsDefault extends JModelBase
{
	function __construct()
	{

		parent::__construct();
	}

	public function store($data=null)
	{
		$data = $data ? $data : JRequest::get('post');
		$row = JTable::getInstance('task', 'Table');

		$date = date("Y-m-d H:i:s");

		if(!$row->bind($data))
		{
			return false;
		}

	    $row->modified = $date;
	    if (!$row->created)
	    {
	      $row->created = $date;
	    }

		if(!$row->check())
		{
			return false;
		}

		if(!$row->store())
		{
			return false;
		}

		return $row;
	}

	protected function _getList($query, $limitStart=0, $limit=0)
	{
		$db = JFactory::getDBO();
		$db->setQuery($query, $limitStart, $limit);
		$result = $db->loadObjectList();

		return $result;
	}

	public function listItems()
	{
		$query = $this->_buildQuery();
		$query = $this->_buildWhere($query);

		$list = $this->_getList($query);

		return $list;
	}
}