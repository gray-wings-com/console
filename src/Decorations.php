<?php

namespace GrayWings\Console;

enum Decorations: int
{
    case NONE = 0;
    case BOLD = 1;
    case UNDERLINE = 4;
    case BLINK = 5;
    case REVERSE = 7;
    case CONCEALED = 8;
}
