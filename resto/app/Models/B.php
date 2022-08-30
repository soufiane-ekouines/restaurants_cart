<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class B extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'qte',
        'created_at'
    ];

    public function product()
    {
        return $this->belongsTo(product::class,'product_id');
    }

    public static function totaltoday()
    {
        $t=0;
        foreach (B::with('product')->whereDate('b_s.created_at', Carbon::today()->toDateString())->get() as $key => $value) {
            if($value->product->user_id == Auth()->user()->id)
                $t+=$value->qte * $value->product->prix;
        }
        return $t;
    }
    public static function totalmonth()
    {
        $t=0;
        foreach (B::with('product')->whereMonth('created_at', date('m'))->get() as $key => $value) {
            if($value->created_at->year == date('20y') && $value->product->user_id == Auth()->user()->id)
                $t+=$value->qte * $value->product->prix;
        }
        return $t;
    }
}
