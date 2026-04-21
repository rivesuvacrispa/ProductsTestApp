<?php

namespace App\Enums;

enum ProductSortType: int
{
    case PRICE_ASC = 0;
    case PRICE_DESC = 1;
    case RATING_DESC = 2;
    case NEWEST = 3;
}
