<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeSerialNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $platform = Schema::getConnection()->getDoctrineSchemaManager()->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');

        Schema::table('assets', function (Blueprint $table) {
            $table->string('serial')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
