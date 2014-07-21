<?php

require_once 'TodoHandler.php';

$handler = new TodoHandler();

$id = isset($_GET['id']) && intval($_GET['id']) >= 0 ? $_GET['id'] : 0;

$result = $handler->deleteTodo($id);

if ($result === false) {
    http_response_code(400);
}

echo '';

?>