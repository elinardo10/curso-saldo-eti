<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillPay extends Model
{
    protected $fillable = ['name', 'date_due', 'value'];
}
