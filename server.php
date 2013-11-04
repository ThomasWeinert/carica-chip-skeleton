<?php
$board = include(__DIR__.'/bootstrap.php');

$board
  ->activate()
  ->done(
    function () use ($board) {
      // Start here!
    }
  );

Carica\Io\Event\Loop\Factory::run();