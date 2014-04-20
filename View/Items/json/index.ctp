<?php
$paginator = $this->Paginator->params();
$code      = 200;
echo json_encode(compact('items', 'paginator', 'code'));
?>
