<?php

class DepartmentsAddView {

    public function render()
    {
        include_once "Template.php";

        // Load template add department
        $view = new Template("departments_add.html");

        // Render tampilan ke layar
        $view->write();
    }
}