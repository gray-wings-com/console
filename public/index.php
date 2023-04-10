<?php
require_once './vendor/autoload.php';

use GrayWings\Console\Console;
use GrayWings\Console\Color;
use GrayWings\Console\Colors;
use GrayWings\Console\Decorations;

$console = new Console();
$console->writeLine('Hello, world!');
$console->setBackgroundColor(new Color(
    Colors::GREEN,
    false
));
$console->setFontColor(new Color(
    Colors::WHITE,
    false
));

$console->writeLine('Hello, world!');
$console->reset();
$console->setBackgroundColor(new Color(
    Colors::RED,
    true
));
$console->setFontColor(new Color(
    Colors::WHITE,
    false
));

$console->writeConstLength('Hello, world!', 120);
$console->setDecoration(Decorations::BLINK);
$console->writeConstLength('World is beautiful!', 120);
$console->reset();

$console->setFontColor(new Color(
    Colors::RED,
    true
));
$console->writeLine('Hello, world!');
