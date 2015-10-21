<?php

namespace StanfordNlpClient;

use GuzzleHttp\Client;

class Api {
  public static function getResult($text) {
    $client = new Client();
    $response = $client->post('http://nlp.stanford.edu:8080/parser/index.jsp', [ 'form_params' => [
      'parse'        => 'Parse',
      'parserSelect' => 'English',
      'query'        => $text,
    ]]);
    $body = $response->getBody();

    return new Result($text, null, self::getParseTree($body));
  }

  protected static function getParseTree($body) {
    $pre = '<pre id="parse" class="spacingFree">';
    $post = '</pre>';
    $a = strpos($body, $pre) + strlen($pre);
    $b = strpos($body, $post, $a);
    return substr($body, $a, $b - $a);
  }
}
