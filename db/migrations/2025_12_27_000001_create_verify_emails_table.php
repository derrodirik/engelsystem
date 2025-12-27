<?php

declare(strict_types=1);

namespace Engelsystem\Migrations;

use Engelsystem\Database\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVerifyEmailsTable extends Migration
{
    use Reference;

    /**
     * Run the migration
     */
    public function up(): void
    {
        $this->schema->create('verify_emails', function (Blueprint $table): void {
            $this->referencesUser($table, true);

            $table->text('token');

            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migration
     */
    public function down(): void
    {
        $this->schema->drop('password_resets');
    }
}
