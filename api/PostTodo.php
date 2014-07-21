<?php


$putdata = fopen("php://input", "r");

$data = '';
while ($temp = fread($putdata, 1024))
    $data .= $temp;

$data = json_decode($data);

if (!isset($data->task)) {
    http_response_code(400);
    echo ''; exit();
}

$task = $data->task;

require_once 'TodoHandler.php';

$handler = new TodoHandler();

if (isset($data->due)) {
    $todo = $handler->postTodo($task, $data->due);
} else {
    $todo = $handler->postTodo($task);
}

if ($todo === false) {
    http_response_code(400);
}

echo json_encode($todo);

?>