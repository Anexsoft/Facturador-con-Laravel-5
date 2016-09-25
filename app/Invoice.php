<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {
    public function detail(){
        return $this->hasMany('App\InvoiceItem');
    }

    public function client(){
        return $this->belongsTo('App\Client');
    }
}
