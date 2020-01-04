<?php

use App\Field;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Field::TABLE, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string(Field::A_TITLE);
            $table->enum(Field::A_TYPE, Field::TYPES);

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
        Schema::dropIfExists(Field::TABLE);
    }
}
