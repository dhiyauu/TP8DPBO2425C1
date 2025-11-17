<?php

class LecturersEditView {

    public function render($lecturer, $departments)
    {
        include_once "Template.php";

        $view = new Template("lecturers_edit.html");

        // Replace basic lecturer data
        $view->replace("DATA_ID", $lecturer['id']);
        $view->replace("DATA_NAME", $lecturer['name']);
        $view->replace("DATA_NIDN", $lecturer['nidn']);
        $view->replace("DATA_PHONE", $lecturer['phone']);
        $view->replace("DATA_JOIN_DATE", $lecturer['join_date']);

        // Dropdown departments
        $options = "";
        foreach ($departments as $d) {
            $selected = ($d['id'] == $lecturer['department_id']) ? "selected" : "";
            $options .= "<option value='{$d['id']}' $selected>{$d['department_name']}</option>";
        }

        $view->replace("DATA_DEPARTMENT_OPTIONS", $options);

        $view->write();
    }
}