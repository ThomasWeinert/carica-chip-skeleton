<?php
require(__DIR__ . '/vendor/autoload.php');

Carica\Io\Loader::register();

use Carica\Io as Io;
use Carica\Firmata as Firmata;

if (@include(__DIR__ . '/configuration.php')) {
  if (!defined('CARICA_FIRMATA_SERIAL_BAUD')) {
    define('CARICA_FIRMATA_SERIAL_BAUD', 57600);
  }

  switch (CARICA_FIRMATA_MODE) {
  case 'tcp':
    $stream = new Io\Stream\Tcp(
      CARICA_FIRMATA_TCP_SERVER,
      CARICA_FIRMATA_TCP_PORT
    );
    break;
  case 'serial-dio':
    $stream = new Io\Stream\Serial\Dio(
      CARICA_FIRMATA_SERIAL_DEVICE,
      CARICA_FIRMATA_SERIAL_BAUD
    );
    break;
  case 'serial':
    $stream = new Io\Stream\Serial(
      CARICA_FIRMATA_SERIAL_DEVICE,
      CARICA_FIRMATA_SERIAL_BAUD
    );
    break;
  default:
    die('Invalid CARICA_FIRMATA_MODE: '.CARICA_FIRMATA_MODE);
  }

  return new Firmata\Board($stream);

} else {
  die('Please copy "dist.configuration.php" to "configuration.php" and adapt the configuration options');
}