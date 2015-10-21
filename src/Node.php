<?php

namespace StanfordNlpClient;

use GuzzleHttp\Client;

class Node {
  public $n;
  public $children;

  private $is_leaf;

  /**
   * Return an array of nodes if parsing multiple tree (ie multiple sentences)
   * @param string $item_as_text the Node or tree in string form, ie: (ROOT (DT the) (JJ lazy) (NN dog)) (ROOT (DT the) (JJ lazy) (NN dog))
   * @return array
   */
  public static function getNodesArray($item_as_text) {
    $node = new Node('(MASTER ' . $item_as_text . ')');
    return $node->children;
  }

  /**
   * @param string $item_as_text the Node or tree in string form, ie: (NP (DT the) (JJ lazy) (NN dog))
   */
  public function __construct($item_as_text) {
    $this->children = [];
    $this->is_leaf = true;

    $item_as_text = trim(str_replace("\n", ' ', $item_as_text));

    $l = strlen($item_as_text) - 1;
    if ($item_as_text[0] != '(' || $item_as_text[$l] != ')')
      throw new \Exception("Bad node format [$item_as_text]");
    $t = substr($item_as_text, 1, $l - 1) . ' ';

    $last_stop = 0;
    $space_prev = false;
    $deep = 0;
    for ($i = 0; $i < $l; $i++) {
      $space = ctype_space($t[$i]) && $deep == 0;
      if ($space_prev && !$space)
        $last_stop = $i;

      if ($t[$i] == '(')
        $deep++;
      else if ($t[$i] == ')')
        $deep--;
      else if ($space && !$space_prev)
        $this->addItem( substr($t, $last_stop, $i - $last_stop) );

      $space_prev = $space;
    }

    $this->n = array_shift($this->children);
  }

  public function isLeaf(){
    return $this->is_leaf;
  }

  private function addItem($item){
    if ($item[0] == '(') {
      $this->children[] = new Node($item);
      $this->is_leaf = false;
    } else
      $this->children[] = $item;
  }
}
