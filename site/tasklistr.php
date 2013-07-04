<?php defined('_JEXEC') or die('Restricted Access');

$debugger = JPATH_COMPONENT.'/DEBUGGER/ChromePhp.php';
include_once $debugger;

jimport('joomla.session.session');

JTable::addIncludePath(JPATH_COMPONENT.'/tables');

JLoader::registerPrefix('Tasklistr', JPATH_COMPONENT);

JPluginHelper::importPlugin('tasklistr');

TasklistrHelpersScript::load();

$app = JFactory::getApplication();

if($controller = $app->input->getWord('controller', 'default')) {
	require_once (JPATH_COMPONENT.'/controllers/'.$controller.'.php');
}

$className = 'TasklistrControllers'.ucfirst($controller);
$controller = new $className();

$controller->execute();