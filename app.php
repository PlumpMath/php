<?php

class PHP
{
  static function requireVersion($ver)
  {
    $operator = static::getOperator($ver);
    $ver = static::getVersion($ver);
    return static::compareVersion($ver, $operator);
  }

  static function compareVersion($ver, $operator)
  {
    switch ($operator) {
      case '>':
        return static::version() > $ver;
      case '<':
        return static::version() < $ver;
      case '>=':
        return static::version() >= $ver;
      case '<=':
        return static::version() <= $ver;
      default:
        return static::version() === $ver;
    }
  }

  static function getOperator($ver)
  {
    return preg_match(static::operatorPattern(), $ver, $match)
      ? trim($match[0])
      : false;
  }

  static function getVersion($ver)
  {
    return preg_match(static::versionPattern(), $ver, $match)
      ? $match[0]
      : false;
  }

  static function operatorPattern()
  {
    return '/^(((<|>)=?|=)\s*)/';
  }

  static function versionPattern()
  {
    return '/(\d|x){1,3}(\.(\d|x){1,3}){0,2}/';
  }

  static function version()
  {
    return phpversion();
  }
}
