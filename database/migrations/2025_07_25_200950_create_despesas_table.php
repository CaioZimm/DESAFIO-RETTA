<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_despesa')->nullable();
            $table->date('data_documento')->nullable();
            $table->string('fornecedor')->nullable();
            $table->decimal('valor_documento', 10, 2)->default(0);
            $table->foreignId('deputado_id')->constrained('deputados')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('despesas');
    }
};
