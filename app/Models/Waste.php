<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waste extends Model
{
  protected $fillable = ['type', 'weight', 'created_at', 'updated_at'];

  public function disposalRecords()
  {
    return $this->hasMany(DisposalRecord::class);
  }
}