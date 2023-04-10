<?php

namespace GrayWings\Console;

class Console
{
    private ?Color $backgroundColor;
    private ?Color $fontColor;
    private ?Decorations $decorations;

    private const FORMAT_STRING = "\e[%sm%s\e[0m";

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->backgroundColor = null;
        $this->fontColor = null;
        $this->decorations = null;
    }

    public function setDecoration(Decorations $decorations): void
    {
        $this->decorations = $decorations;
    }

    public function setBackgroundColor(Color $color): void
    {
        $this->backgroundColor = $color;
    }

    public function setFontColor(Color $color): void
    {
        $this->fontColor = $color;
    }

    private function fontColorNumber(): int
    {
        if ($this->fontColor === null) {
            return 0;
        } else {
            return $this->fontColor->isIntensity()
                ? $this->fontColor->colors()->value + 90
                : $this->fontColor->colors()->value + 30;
        }
    }

    private function backgroundColorNumber(): int
    {
        if ($this->backgroundColor === null) {
            return 0;
        } else {
            return $this->backgroundColor->isIntensity()
                ? $this->backgroundColor->colors()->value + 100
                : $this->backgroundColor->colors()->value + 40;
        }
    }

    private function buildDecorationString(): string
    {
        $built = '';
        if ($this->decorations !== null) {
            $this->decorations->value === 0 ?: $built .= $this->decorations->value . ';';
        }
        if ($this->fontColor !== null) {
            $this->fontColorNumber() === 0 ?: $built .= $this->fontColorNumber() . ';';
        }
        if ($this->backgroundColor !== null) {
            $this->backgroundColorNumber() === 0 ?: $built .= $this->backgroundColorNumber() . ';';
        }
        if (empty($built)) {
            return '0';
        } else {
            return trim($built, ';');
        }
    }

    private function format(string $text): string
    {
        return sprintf(
            self::FORMAT_STRING,
            $this->buildDecorationString(),
            $text
        );
    }

    private function getConsoleWidth(): int
    {
        $width = `tput cols`;
        if ($width === null) {
            $width = 80;
        }
        return $width;
    }

    public function write(string $text): void
    {
        echo $this->format($text);
    }

    public function break(): void
    {
        echo PHP_EOL;
    }

    public function writeLine(string $text): void
    {
        $this->write($text);
        $this->break();
    }

    public function writeConstLength(
        string $text,
        int $length = null
    ): void {
        $this->write($text);
        $emptyLength = ($length ?? $this->getConsoleWidth()) - strlen($text);
        $this->write(str_repeat(' ', max($emptyLength, 0)));
        $this->break();
    }

    public function writeConstPercentage(
        string $text,
        int $percentage = 100
    ): void {
        $this->write($text);
        $emptyLength = ($this->getConsoleWidth() * $percentage / 100) - strlen($text);
        $this->write(str_repeat(' ', max($emptyLength, 0)));
        $this->break();
    }
}
