<?php

class SchedulesView {

    public function render($data)
    {
        include_once "Template.php";

        $view = new Template("schedules.html");

        $tableData = "";

        foreach ($data['schedules'] as $s) {
            $tableData .= "
                <tr>
                    <td>{$s['id']}</td>
                    <td>{$s['lecturer_name']}</td>
                    <td>{$s['day']}</td>
                    <td>{$s['time_start']}</td>
                    <td>{$s['time_end']}</td>
                    <td>
                        <a class='btn btn-warning btn-sm' href='/tp_mvc25/schedules/edit.php?id={$s['id']}'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/tp_mvc25/schedules/delete.php?id={$s['id']}'>Delete</a>
                    </td>
                </tr>
            ";
        }

        $view->replace("DATA_TITLE", "Schedules");
        $view->replace("DATA_TABLE", $tableData);

        $view->write();
    }
}