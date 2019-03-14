<?php

/**
 *
 */
class Request
{
  public static function post() {
    return filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  }
}
