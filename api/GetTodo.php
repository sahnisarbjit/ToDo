<?php

require_once 'TodoHandler.php';

$handler = new TodoHandler();

$id = isset($_GET['id']) && intval($_GET['id']) >= 0 ? $_GET['id'] : 0;

echo json_encode($handler->getTodo($id));

?>