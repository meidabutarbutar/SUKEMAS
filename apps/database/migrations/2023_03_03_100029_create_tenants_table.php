<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $tableName = 'tenants';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)
                ->index();
            $table->string('short_name', 40)
                ->nullable();
            $table->string('website', 255)
                ->nullable();
            $table->string('address', 255)
                ->nullable();
            $table->string('postal_code', 8)
                ->nullable();
            $table->foreignId('province_id')
                ->constrained('provinces');
            $table->foreignId('regency_id')
                ->nullable()
                ->constrained('regencies');
            $table->foreignId('district_id')
                ->nullable()
                ->constrained('districts');
            $table->string('slug', 255)
                ->nullable()
                ->index();
            $table->string('token', 8)
                ->unique();
            $table->string('logo_path', 255);
            $table->double('latitude');
            $table->double('longitude');
            $table->text('description')
                ->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->tableName);
    }
};
