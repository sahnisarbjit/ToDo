<?php

class TodoHandler
{
    private $host;
    private $db = 'todos';
    private $table = 'tasks';
    private $user = 'root';
    private $password = '';
    private $connection;

    public function __construct()
    {
        $this->connection = mysqli_connect(
            $this->host,
            $this->user,
            $this->password,
            $this->db
        );
    }

    public function getTodos($offset, $limit)
    {
        $offset = intval($offset);
        $limit = intval($limit);
        $query = "SELECT   *
                  FROM     tasks
                  LIMIT    $offset,$limit";

        $result = mysqli_query($this->connection, $query);

        $todos = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $todos[] = $row;
            }
        }

        return $todos;
    }

    public function getTodo($id)
    {
        $id = intval($id);
        $query = "SELECT   *
                  FROM     tasks
                  WHERE    id = $id";

        $result = mysqli_query($this->connection, $query);

        if (mysqli_num_rows($result) > 0) {
            $todo = mysqli_fetch_assoc($result);
        } else {
            $todo = array();
        }

        return $todo;
    }

    public function postTodo($task, $dueDate='0000-00-00 00:00:00')
    {
        $query = "INSERT INTO   tasks
                  SET           task = \"$task\",
                                created = now(),
                                due = \"$dueDate\"";

        try {
            $result = mysqli_query($this->connection, $query);
        } catch (\Exception $e) {
            return false;
        }

        if ($result === false || mysqli_affected_rows($this->connection) != 1) {
            return false;
        }

        return $this->getTodo(mysqli_insert_id($this->connection));
    }

    public function putTodo($attibutes) {
        if (!isset($attibutes['id'])) return false;
        $id = $attibutes['id'];
        $task = $this->getTodo($id);

        if (empty($task)) return false;

        unset($attibutes['id']);
        $variables = array();
        foreach ($attibutes as $key => $value) {
            if ($key == 'task_status') {
                $value = $value == 'done' ? 'done' : 'pending';
            }
            $variables[] = "$key = '$value'";
        }
        $variables = implode(', ', $variables);

        $query = "UPDATE  tasks
                  SET     $variables
                  WHERE   id = $id";

        mysqli_query($this->connection, $query);
        if (mysqli_affected_rows($this->connection) === 1) {
            return $this->getTodo($id);
        } else {
            return false;
        }
    }

    public function deleteTodo($id) {
        $id = intval($id);
        $task = $this->getTodo($id);

        if (empty($task)) return false;

        $query = "DELETE FROM  tasks
                  WHERE        id = $id";

        mysqli_query($this->connection, $query);
        if (mysqli_affected_rows($this->connection) === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function __destruct() {
        mysqli_close($this->connection);
    }

}

?>