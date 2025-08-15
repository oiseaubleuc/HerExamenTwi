<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->after('name');
        });

        DB::table('users')->orderBy('id')->chunkById(500, function ($users) {
            foreach ($users as $u) {
                $base = \Illuminate\Support\Str::slug($u->name) ?: 'user'.$u->id;
                $username = $base; $i = 1;
                while (DB::table('users')->where('username', $username)->where('id','<>',$u->id)->exists()) {
                    $username = $base.'-'.$i++;
                }
                DB::table('users')->where('id', $u->id)->update(['username' => $username]);
            }
        });
        Schema::table('users', function (Blueprint $table) {
            $table->unique('username');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
