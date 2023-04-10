<?php

namespace GrayWings\Console;

class Color
{
    private bool $isIntensity;
    private Colors $colors;

    public function __construct(
        Colors $colors,
        bool $isIntensity
    ) {
        $this->isIntensity = $isIntensity;
        $this->colors = $colors;
    }

    public function isIntensity(): bool
    {
        return $this->isIntensity;
    }

    public function colors(): Colors
    {
        return $this->colors;
    }
}
