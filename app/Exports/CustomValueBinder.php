<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\IValueBinder;

class CustomValueBinder extends DefaultValueBinder implements IValueBinder
{
    public function bindValue(Cell $cell, mixed $value): bool
    {
        return parent::bindValue($cell, $value);
    }
}

