<?php

namespace StanfordNlpClient;

interface IResult {
  public function __construct($query, $tags, $parseTree, $dependencies = null, $dependenciesEnhanced = null);
  public function getParseTree();
}
