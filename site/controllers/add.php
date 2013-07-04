<?php defined('_JEXEC') or die('Restricted Access');

class TasklistrControllersAdd extends JControllerBase
{
	public function execute()
	{
		$app = JFactory::getApplication();

		$return = array('success'=>false);

		$modelName = $app->input->get('model', 'Task');
		$viewName = $app->input->getWord('view', 'task');
		$displayView = $app->input->getWord('layout', '_display');
		$editView = $app->input->getWord('layout', '_edit');
		$itemName = 'task';
		
		$modelClass = 'TasklistrModels'.ucfirst($modelName);
		$model = new $modelClass();

		if ($row = $model->store()) {
			$return['success'] = true;
			$return['msg'] = 'save success';
			$return['row'] = $row;
			$return['due_date'] = $row->due_date;
			$return['displayHtml'] = TasklistrHelpersView::getHtml($viewName, $displayView, $itemName, $row);
			$return['editHtml'] = TasklistrHelpersView::getHtml($viewName, $editView, $itemName, $row);
		}

		echo json_encode($return);
	}
}