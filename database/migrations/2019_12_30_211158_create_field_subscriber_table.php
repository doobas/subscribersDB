<?php

use App\Field;
use App\Subscriber;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldSubscriberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_subscriber', function (Blueprint $table) {
            $table->unsignedBigInteger('field_id');
            $table->unsignedBigInteger('subscriber_id');
            $table->string(Field::PIVOT_VALUE)->nullable();
        });

        Schema::table('field_subscriber', function (Blueprint $table) {

            $table->foreign('field_id')
                ->references('id')->on(Field::TABLE)
                ->onDelete('cascade');

            $table->foreign('subscriber_id')
                ->references('id')->on(Subscriber::TABLE)
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('field_subscriber');
    }
}
