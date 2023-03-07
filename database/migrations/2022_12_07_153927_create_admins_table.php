<?php
use App\Models\Admin;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateAdminsTable extends Migration {
    public function up() {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            // $table->enum('type',['admin','employee'])->default('employee');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // $table->string('address')->nullable();
            // $table->foreignId('country_id')->nullable()->constrained()->cascadeOnDelete();
            // $table->foreignId('department_id')->nullable()->constrained()->cascadeOnDelete();
            // $table->text('roles_name')->nullable();
            $table->tinyInteger('status')->default(Admin::NOT_ACTIVE);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('admins');
    }
}
