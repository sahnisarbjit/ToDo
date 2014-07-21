<?php

require_once 'TodoHandler.php';

$handler = new TodoHandler();

$offset = isset($_GET['offset']) && intval($_GET['offset']) >= 0 ? $_GET['offset'] : 0;
$limit = isset($_GET['limit']) && intval($_GET['limit']) > 0 ? $_GET['limit'] : 10;

echo json_encode($handler->getTodos($offset, $limit));

?>