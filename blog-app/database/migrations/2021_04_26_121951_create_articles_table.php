<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('post_title');
            $table->longText('post_content');
            $table->text('post_excerpt')->nullable()->comment("記事の概要.なければpost_contentの先頭何文字かをとる");
            $table->datetime('post_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('post_status')->comment("1:公開済み2:ペンディング3:草稿4:非公開5:予約投稿")->default(1);
            $table->string('img_name')->nullable();
            $table->string('img_path')->nullable();
            $table->integer('comment_status')->comment("1:許可2:不許可3:登録ユーザーのみ")->default(1);
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
