<?php

namespace App\Enums;

enum TypeOfDocument: int
{
    case CI = 1;
    case RUC = 2;
    case DNI = 3;
}
