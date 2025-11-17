<?php

class LecturersAddView {

    public function render($departments)
    {
        include_once "Template.php";

        // load template add lecturer
        $view = new Template("lecturers_add.html");

        // Buat dropdown department
        $options = "";
        foreach ($departments as $d) {
            $options .= "<option value='{$d['id']}'>{$d['department_name']}</option>";
        }

        // Replace placeholder pada template
        $view->replace("DATA_DEPARTMENT_OPTIONS", $options);

        // Tampilkan hasil render
        $view->write();
    }
}