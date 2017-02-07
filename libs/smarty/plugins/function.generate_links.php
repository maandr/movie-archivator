<?php
function smarty_function_generate_links($params, $template) {
  $links = explode(', ', $params['value']);

  for($i=0; $i < sizeof($links); $i++) {
    $link =  sprintf('<a href="%s/%s">%s</a>', $params['href'], $links[$i], $links[$i]);
    $links[$i] = $link;
  }

  return implode(', ', $links);
}
?>
