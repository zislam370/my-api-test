<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleDetailsToAddProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('add_products', function (Blueprint $table) {
            $table->string('title')->nullable()->after('id');
            $table->string('detail')->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('add_products', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('detail');
        });
    }
}
