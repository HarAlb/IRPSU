<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsAdminUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  I would not to use guard 
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->after('email_verified_at')->default(false);
        });
    }
}
