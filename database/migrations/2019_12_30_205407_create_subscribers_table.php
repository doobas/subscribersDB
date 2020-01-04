<?php

use App\Subscriber;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Subscriber::TABLE, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string(Subscriber::A_NAME);
            $table->string(Subscriber::A_EMAIL)->unique();
            $table->enum(Subscriber::A_STATE, Subscriber::STATES)->default(Subscriber::DEFAULT_STATE);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Subscriber::TABLE);
    }
}
