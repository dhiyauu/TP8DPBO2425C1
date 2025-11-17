<?php

class SchedulesEditView {

    public function render($data, $lecturers)
    {
        include_once "Template.php";

        $view = new Template("schedules_edit.html");

        // Replace data utama
        $view->replace("DATA_ID", $data['id']);
        $view->replace("DATA_DAY", $data['day']);
        $view->replace("DATA_TIME_START", $data['time_start']);
        $view->replace("DATA_TIME_END", $data['time_end']);

        // Dropdown lecturers
        $options = "";
        foreach ($lecturers as $l) {
            $sel = ($l['id'] == $data['lecturer_id']) ? "selected" : "";
            $options .= "<option value='{$l['id']}' $sel>{$l['name']}</option>";
        }
        $view->replace("DATA_LECTURER_OPTIONS", $options);

        $view->write();
    }
}