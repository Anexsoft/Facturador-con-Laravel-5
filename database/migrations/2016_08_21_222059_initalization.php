<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Initalization extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('ruc');
            $table->string('address');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('iva', 10,2);
            $table->decimal('subTotal', 10,2);
            $table->decimal('total', 10,2);
            $table->timestamps();
        });

        Schema::create('invoice_items', function (Blueprint $table) {
            $table->decimal('quantity', 10,2);
            $table->decimal('unitPrice', 10,2);
            $table->decimal('total', 10,2);
            $table->timestamps();
        });

        // Foreign keys
        Schema::table('invoices', function ($table) {
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
        });

        Schema::table('invoice_items', function ($table) {
            $table->integer('invoice_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('product_id')->references('id')->on('products');
        });

        // Default data
        DB::table('clients')->insert([
            ['name' => 'Eduardo Rodriguez', 'ruc' => '12345678912', 'address' => 'Av. Los informáticos 107'],
            ['name' => 'Juan Perez', 'ruc' => '12345678912', 'address' => 'Av. Los informáticos 108'],
        ]);

        DB::table('products')->insert([
            ['name' => 'Guitarra eléctrica Fender', 'price' => 1000.50],
            ['name' => 'Amplicador Marshal JCM 2000', 'price' => 2000],
        ]);
    }

    public function down()
    {

    }
}
