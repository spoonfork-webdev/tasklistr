<?php defined('_JEXEC') or die('Restricted Access');

class TasklistrControllersDelete extends JControllerBase
{
	public function execute () {
		$app = JFactory::getApplication();
		$id = JRequest::get('post');

		$return = array('success'=>false);

		$type = $app->input->get('type', 'task');
		$modelName = 'TasklistrModels'.ucfirst($type);
		$model = new $modelName();

		if ($row = $model->delete($id)) {
			$return['success'] = true;
		}

		echo json_encode($return);
	}
}