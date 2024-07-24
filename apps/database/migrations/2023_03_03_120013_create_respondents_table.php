<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $tableName = 'respondents';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->foreignId('village_id')
                ->nullable()
                ->constrained('villages');
            $table->foreignId('occupation_option_id')
                ->constrained('occupation_options');
            $table->foreignId('tenant_id')
                ->constrained('tenants');
            $table->foreignId('division_id')
                ->constrained('divisions');
            $table->foreignId('service_id')
                ->constrained('services');
            $table->foreignId('age_option_id')
                ->constrained('age_options');
            $table->string('gender', 16);
            $table->string('comment', 255)
                ->nullable();
            $table->timestamp('submitted_at')
                ->index();
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
