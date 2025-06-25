<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First check if the foreign key doesn't already exist
        $constraints = DB::select("
            SELECT CONSTRAINT_NAME
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_TYPE = 'FOREIGN KEY'
            AND TABLE_NAME = 'sub_meta'
            AND CONSTRAINT_NAME = 'sub_meta_meta_id_foreign'
        ");

        // If constraint doesn't exist, add it
        if (empty($constraints)) {
            DB::statement('ALTER TABLE `sub_meta` ADD CONSTRAINT `sub_meta_meta_id_foreign` FOREIGN KEY (`meta_id`) REFERENCES `meta` (`id`) ON DELETE CASCADE');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Try to drop the constraint if it exists
        DB::statement('ALTER TABLE `sub_meta` DROP FOREIGN KEY IF EXISTS `sub_meta_meta_id_foreign`');
    }
};