<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('user_messages', function (Blueprint $table): void {
            $table->id();

            $table->foreignIdFor(User::class, 'sender_id')
                ->references('id')->on('users');

            $table->foreignIdFor(User::class, 'receiver_id')
                ->references('id')->on('users');

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
        Schema::dropIfExists('user_messages');
    }
};
