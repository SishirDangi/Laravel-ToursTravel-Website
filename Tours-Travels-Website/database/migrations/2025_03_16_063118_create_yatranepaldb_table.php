<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Roles Table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name')->unique();
            
        });

        // Users Table
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->string('password');
            $table->dateTime('last_logged_in')->nullable();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        // Country Table
        Schema::create('country', function (Blueprint $table) {
            $table->id();
            $table->string('country_code', 10)->unique();
            $table->string('country_name', 100)->unique();
            $table->string('phone_code', 10)->nullable(); 
            $table->timestamps();
        });

        // Contacts Table
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('mobile_no', 20)->unique();
            $table->string('email', 100)->unique();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('country')->onDelete('cascade');
        });

        // Status Table
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->string('status_name')->unique(); // Will store values like 'pending', 'booking', etc.
           
        });

        // Package Table
        Schema::create('package', function (Blueprint $table) {
            $table->id('package_id');
            $table->string('package_name');
            $table->text('package_description')->nullable();
            $table->string('package_type', 100)->nullable();
            $table->decimal('package_price', 10, 2);
            $table->unsignedBigInteger('status')->nullable();
            $table->timestamps();

            $table->foreign('status')->references('id')->on('status')->onDelete('set null');
        });

        // Booking Table
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('contact_id');
            $table->date('booking_date');
            $table->time('booking_time');
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('total_price', 10, 2);
            $table->unsignedBigInteger('status')->nullable();
            $table->timestamps();

            $table->foreign('package_id')->references('package_id')->on('package')->onDelete('cascade');
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->foreign('status')->references('id')->on('status')->onDelete('set null');
        });

        // FAQ Table
        Schema::create('faq', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->string('question_asked_by_email_id', 100);
            $table->text('answer')->nullable();
            $table->timestamps();
        });

        // Enquiries Table
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('fullName', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('message')->nullable();
            $table->timestamps(); // Let Laravel handle the timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enquiries');
        Schema::dropIfExists('faq');
        Schema::dropIfExists('booking');
        Schema::dropIfExists('package');
        Schema::dropIfExists('status');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('country');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
};

