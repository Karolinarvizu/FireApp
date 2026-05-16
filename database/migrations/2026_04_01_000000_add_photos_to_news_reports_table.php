<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhotosToNewsReportsTable extends Migration
{
    public function up()
    {
        Schema::table('news_reports', function (Blueprint $table) {
            $table->json('photos')->nullable()->after('others');
        });
    }

    public function down()
    {
        Schema::table('news_reports', function (Blueprint $table) {
            $table->dropColumn('photos');
        });
    }
}