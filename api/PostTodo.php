<?php

if (!isset($_POST['task'])) {
    http_response_code(400);
    echo '';exit();
}

$task = $_POST['task'];

require_once 'TodoHandler.php';

$handler = new TodoHandler();

if (isset($_POST['due'])) {
    $todo = $handler->postTodo($task, $_POST['due']);
} else {
    $todo = $handler->postTodo($task);
}

if ($todo === false) {
    http_response_code(400);
}

echo json_encode($todo);

?>