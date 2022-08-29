<?php

namespace App\Models;

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
        foreach (B::with('product')->where('user_id',Auth()->user()->id)->where('b_s.created_at',today())->get() as $key => $value) {
           $t+=$value->qte * $value->product->prix;
        }
        return $t;
    }
    public static function totalmonth()
    {
        $t=0;
        foreach (B::with('product')->where('user_id',Auth()->user()->id)->whereMonth('created_at', date('m'))->get() as $key => $value) {
           $t+=$value->qte * $value->product->prix;
        }
        return $t;
    }
}
