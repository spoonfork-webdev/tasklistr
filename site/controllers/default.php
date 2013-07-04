<?php defined('_JEXEC') or die('Restricted Access');

class TasklistrControllersDefault extends JControllerBase
{
	public function execute()
	{
		$app = JFactory::getApplication();
		$document = JFactory::getDocument();

	    $viewName     = $app->input->getWord('view', 'task');
	    $viewFormat   = $document->getType();
	    $layoutName   = $app->input->getWord('layout', 'default');

	    $app->input->set('view', $viewName);

		$paths = new SplPriorityQueue;
		$paths->insert(JPATH_COMPONENT.'/views/'.$viewName.'/tmpl', 'normal');

		$viewClass = 'TasklistrViews'.ucfirst($viewName).ucfirst($viewFormat);
		$modelClass = 'TasklistrModels'.ucfirst($viewName);

		if (false === class_exists($modelClass))
		{
			$modelClass = 'TasklistrModelsDefault';
		}

		$view = new $viewClass(new $modelClass, $paths);
		$view->setLayout($layoutName);

		echo $view->render();

		return true;
	}
}