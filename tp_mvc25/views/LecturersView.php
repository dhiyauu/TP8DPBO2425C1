<?php

class LecturersView {

    public function render($data)
    {
        include_once "Template.php";

        $view = new Template("lecturers.html");

        $tableData = "";

        foreach ($data['lecturers'] as $l) {
            $tableData .= "
                <tr>
                    <td>{$l['id']}</td>
                    <td>{$l['name']}</td>
                    <td>{$l['nidn']}</td>
                    <td>{$l['phone']}</td>
                    <td>{$l['join_date']}</td>
                    <td>{$l['department_name']}</td>
                    <td>
                        <a class='btn btn-warning btn-sm' href='/tp_mvc25/lecturers/edit.php?id={$l['id']}'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/tp_mvc25/lecturers/delete.php?id={$l['id']}'>Delete</a>
                    </td>
                </tr>
            ";
        }

        $view->replace("DATA_TITLE", "Lecturers");
        $view->replace("DATA_TABLE", $tableData);
        
        $view->write();
    }
}