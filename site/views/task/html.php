<?php defined('_JEXEC') or die('Restricted Access');

class TasklistrViewsTaskHtml extends JViewHtml
{
	function render()
	{
		$app = JFactory::getApplication();
		$user = JFactory::getUser();
		$type = $app->input->get('type');
		$id = $app->input->get('id');
		$view = $app->input->get('view');

		$model = new TasklistrModelsTask();

		$this->list = $model->listItems();

		$this->user_id = $user->id;

		return parent::render();
	}
}