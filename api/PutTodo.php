<?php

require_once 'TodoHandler.php';

$handler = new TodoHandler();

$id = isset($_GET['id']) && intval($_GET['id']) >= 0 ? $_GET['id'] : 0;

$putdata = fopen("php://input", "r");

$data = '';
while ($temp = fread($putdata, 1024))
    $data .= $temp;

$attributes = json_decode($data, true);
$attributes['id'] = $id;

$todo = $handler->putTodo($attributes);

if ($todo === false) {
    http_response_code(400);
}

echo json_encode($todo);

?>