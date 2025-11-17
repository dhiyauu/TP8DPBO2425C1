<?php

class DepartmentsEditView {

    public function render($data)
    {
        include_once "Template.php";

        // load template edit
        $view = new Template("departments_edit.html");

        // replace placeholder
        $view->replace("DATA_ID", $data['id']);
        $view->replace("DATA_NAME", $data['department_name']);
        $view->replace("DATA_LOCATION", $data['location']);
        $view->replace("DATA_EMAIL", $data['email']);

        $view->write();
    }
}