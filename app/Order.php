<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [ 'user_id', 'cart', 'address'];

    public function users(){
      return $this->belongsTo('App\User');
    }
}
