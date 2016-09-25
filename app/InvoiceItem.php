<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model {
    protected $table = 'invoice_items';

    public function product(){
        return $this->belongsTo('App\Product');
    }
}
