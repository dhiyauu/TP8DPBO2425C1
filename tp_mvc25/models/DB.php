<?php

class DB
{
    protected $db_host;
    protected $db_user;
    protected $db_pass;
    protected $db_name;
    protected $db_link;
    protected $result;

    public function __construct($db_host, $db_user, $db_pass, $db_name)
    {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
    }

    public function open()
    {
        $this->db_link = mysqli_connect(
            $this->db_host,
            $this->db_user,
            $this->db_pass,
            $this->db_name
        );

        if (!$this->db_link) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function execute($query)
    {
        $this->result = mysqli_query($this->db_link, $query);

        if (!$this->result) {
            die("Query error: " . mysqli_error($this->db_link));
        }

        return $this->result;
    }

    public function getResult()
    {
        return mysqli_fetch_assoc($this->result);
    }

    public function close()
    {
        if ($this->db_link && $this->db_link instanceof mysqli) {
            @mysqli_close($this->db_link);
            $this->db_link = null;
        }
    }

}