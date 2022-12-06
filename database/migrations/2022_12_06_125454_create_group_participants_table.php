<?php

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('group_participants', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Group::class)
                ->references('id')->on('groups');

            $table->foreignIdFor(User::class, 'participant_id')
                ->references('id')->on('users');

            $table->foreignIdFor(User::class, 'creator_id')
                ->references('id')->on('users');

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
        Schema::dropIfExists('group_participants');
    }
};
