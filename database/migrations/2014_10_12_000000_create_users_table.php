<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function id(){
        $id_role = \App\Models\Role::all()->first(function ($item){
            return $item->EN_name == 'Patient';
        });
        return $id_role->id;
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullName');
            $table->enum('gender',['Мужчина', 'Женщина']);
            $table->date('birthday');
            $table->foreignIdFor(\App\Models\Role::class)->default($this->id())->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Cabinet::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
