<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposalRecord extends Model
{
  protected $fillable = ['waste_id', 'method', 'disposal_date', 'location'];

  public function waste()
  {
    return $this->belongsTo(Waste::class);
  }
}
