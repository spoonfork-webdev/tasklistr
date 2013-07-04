<?php defined('_JEXEC') or die('Restricted Access');

class TasklistrHelpersView
{
    function load($viewName, $layoutName='default', $viewFormat='html', $vars=null)
    {
        $app = JFactory::getApplication();

        $app->input->set('view', $viewName);

        $paths = new SplPriorityQueue;
        $paths->insert(JPATH_COMPONENT . '/views/' . $viewName . '/tmpl', 'normal');

        $viewClass = 'TasklistrViews'.ucfirst($viewName).ucfirst($viewFormat);
        $modelClass = 'TasklistrModels'.ucfirst($viewName);

        if(false === class_exists($modelClass)) {
            $modelClass = 'TasklistrModelsDefault';
        }

        $view = new $viewClass(new $modelClass, $paths);
        $view->setLayout($layoutName);

        if(isset($vars)) {
            foreach ($vars as $varName => $var) {
                $view->$varName = $var;
            }
        }

        return $view;
    }

    function getHtml($view, $layout, $item, $data)
    {
        $objectView = TasklistrHelpersView::load($view, $layout, 'phtml');
        $objectView->$item = $data;

        ob_start();
            echo $objectView->render();
            $html = ob_get_contents();
        ob_clean();

        return $html;
    }
}