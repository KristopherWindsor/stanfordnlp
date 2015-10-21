<?php

use GuzzleHttp\Client;

namespace StanfordNlpClient;

class Result implements IResult {
  private $query, $tags, $parseTree, $dependencies, $dependenciesEnhanced;

  public function __construct($query, $tags, $parseTree, $dependencies = null, $dependenciesEnhanced = null) {
    $this->query                = $query;
    $this->tags                 = $tags;
    $this->parseTree            = $parseTree;
    $this->dependencies         = $dependencies;
    $this->dependenciesEnhanced = $dependenciesEnhanced;
  }

  public function getParseTree() {
    return $this->parseTree;
  }

}
