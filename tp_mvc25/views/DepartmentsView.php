<?php

class DepartmentsView {

    public function render($data) 
    {
        include_once "Template.php";

        // Load file template HTML
        $view = new Template("departments.html");

        // Generate table row HTML
        $tableData = "";
        foreach ($data['departments'] as $d) {
            $tableData .= "
                <tr>
                    <td>{$d['id']}</td>
                    <td>{$d['department_name']}</td>
                    <td>{$d['location']}</td>
                    <td>{$d['email']}</td>
                    <td>
                        <a class='btn btn-warning btn-sm' href='/tp_mvc25/departments/edit.php?id={$d['id']}'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/tp_mvc25/departments/delete.php?id={$d['id']}'>Delete</a>
                    </td>
                </tr>
            ";
        }

        // Replace placeholders in template
        $view->replace("DATA_TITLE", "Departments");
        $view->replace("DATA_TABLE", $tableData);

        // Print the final result
        $view->write();
    }
}