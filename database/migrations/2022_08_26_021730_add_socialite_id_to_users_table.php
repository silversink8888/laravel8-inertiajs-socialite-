<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AddSocialiteIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("users", function (Blueprint $table) {
            // 追加
            $table->string("provider")->after('password')->nullable();
            $table->string("line_id")->after('provider')->nullable();
            $table->string("google_id")->after('line_id')->nullable();
            $table->string("facebook_id")->after('google_id')->nullable();
            $table->string("yahoo_id")->after('facebook_id')->nullable();
            $table->string("twitter_id")->after('yahoo_id')->nullable();
            $table->string("github_id")->after('twitter_id')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("users", function (Blueprint $table) {
            // 追加
            $table->dropColumn('provider');
            $table->dropColumn('line_id');
            $table->dropColumn('google_id');
            $table->dropColumn('facebook_id');
            $table->dropColumn('yahoo_id');
            $table->dropColumn('twitter_id');
            $table->dropColumn('github_id');
        });
    }
}