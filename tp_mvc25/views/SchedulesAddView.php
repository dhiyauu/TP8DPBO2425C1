<?php

class SchedulesAddView {

    public function render($lecturers)
    {
        include_once "Template.php";

        $view = new Template("schedules_add.html");

        // Generate dropdown lecturer
        $options = "";
        foreach ($lecturers as $l) {
            $options .= "<option value='{$l['id']}'>{$l['name']}</option>";
        }

        $view->replace("DATA_LECTURER_OPTIONS", $options);

        $view->write();
    }
}