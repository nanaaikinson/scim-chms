<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GenericExport implements FromCollection, WithHeadings
{
  public $rows = [];
  public $heading = [];

  public function __construct($rows, $heading)
  {
    $this->rows = $rows;
    $this->heading = $heading;
  }

  public function collection()
  {
    return new Collection($this->rows);
  }

  public function headings(): array
  {
    return $this->heading;
  }
}
