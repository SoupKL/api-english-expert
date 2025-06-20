<?php

namespace App\Models\ParamanentData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursePageData extends Model
{
    use HasFactory;

	protected $table = 'curse_page_data';

    protected $fillable = ['cursName', 'purposesInfo', 'textGrout', 'price', 'price_month', 'firstImage'];
}
