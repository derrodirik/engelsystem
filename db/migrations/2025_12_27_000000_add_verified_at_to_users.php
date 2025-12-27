<?php

declare(strict_types=1);

namespace Engelsystem\Migrations;

use Engelsystem\Database\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddVerifiedAtToUsers extends Migration
{
    use Reference;

    /**
     * Run the migration
     */
    public function up(): void
    {
        $this->schema->table('users', function (Blueprint $table): void {
            $table->timestamp('verified_at')->nullable()->after('last_login_at');
        });
    }

    /**
     * Reverse the migration
     */
    public function down(): void
    {
        $this->schema->table('users', function (Blueprint $table): void {
            $table->dropColumn('verified_at');
        });
    }
}
