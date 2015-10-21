<?php

require_once( __DIR__ . '/bootstrap.php' );

// let's parse this
$text = 'The quick fox jumped over the lazy dog. Hello World!';

// get instance of StanfordNlpClient\Result
$result = StanfordNlpClient\Api::getResult($text);

// get the parse tree as a string
$parsed = $result->getParseTree();

// preview time
echo $parsed . "\n\n\n";

// build an actual tree (of Node objects) per sentence
$parse_trees = StanfordNlpClient\Node::getNodesArray($parsed);

// demo time -- show the second sentence
var_dump($parse_trees[1]);
