<?php defined('_JEXEC') or die('Restricted Access');

class TasklistrHelpersScript
{
	function load()
	{
		JHtml::_('jquery.framework');

		$document = JFactory::getDocument();
		$document->addScript(JURI::base() . 'components/com_tasklistr/assets/js/tasklistr.js');

		$javascript = 'jQuery(window).load(function(){jQuery("#tasklistr").tasklistr();});';
		$document->addScriptDeclaration($javascript);
	}
}