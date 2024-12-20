<?php

declare(strict_types=1);

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('group_messages', function (Blueprint $table): void {
            $table->id();

            $table->foreignIdFor(User::class, 'sender_id')
                ->references('id')->on('users');

            $table->foreignIdFor(Group::class)
                ->references('id')->on('groups');

            $table->text('message');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
