<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $columns = [
            'ward',
            'post_office',
            'thana',
            'district',
            'postal_code',
        ];

        $columnsToDrop = array_values(array_filter($columns, fn ($column) => Schema::hasColumn('members', $column)));

        if ($columnsToDrop) {
            DB::table('members')
                ->select([
                    'id',
                    'permanent_address',
                    'ward',
                    'post_office',
                    'thana',
                    'district',
                    'postal_code',
                ])
                ->orderBy('id')
                ->chunkById(200, function ($members) {
                    foreach ($members as $member) {
                        $parts = array_filter([
                            $member->ward ? 'Ward: '.$member->ward : null,
                            $member->post_office ? 'Post Office: '.$member->post_office : null,
                            $member->thana ? 'Thana / Upazila: '.$member->thana : null,
                            $member->district ? 'District: '.$member->district : null,
                            $member->postal_code ? 'Postal Code: '.$member->postal_code : null,
                        ]);

                        if (empty($parts)) {
                            continue;
                        }

                        $existing = trim((string) $member->permanent_address);
                        $composed = implode(', ', $parts);
                        $updated = $existing ? $existing.PHP_EOL.$composed : $composed;

                        DB::table('members')
                            ->where('id', $member->id)
                            ->update(['permanent_address' => $updated]);
                    }
                });

            Schema::table('members', function (Blueprint $table) use ($columnsToDrop) {
                $table->dropColumn($columnsToDrop);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            if (!Schema::hasColumn('members', 'ward')) {
                $table->string('ward')->nullable();
            }
            if (!Schema::hasColumn('members', 'post_office')) {
                $table->string('post_office')->nullable();
            }
            if (!Schema::hasColumn('members', 'thana')) {
                $table->string('thana')->nullable();
            }
            if (!Schema::hasColumn('members', 'district')) {
                $table->string('district')->nullable();
            }
            if (!Schema::hasColumn('members', 'postal_code')) {
                $table->string('postal_code')->nullable();
            }
        });
    }
};
