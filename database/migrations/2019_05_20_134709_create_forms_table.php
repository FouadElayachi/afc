<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            // Step 1 (personal)
            $table->string('photo');
            $table->string('cin');
            $table->string('country');
            $table->string('city_local');
            $table->string('city_origin');
            $table->date('birthdate');
            $table->string('city_birth');
            $table->string('phone_number1');
            $table->string('phone_number2')->nullable(); // not required
            $table->string('link_fb');
            $table->string('link_linkedin')->nullable(); // not required
            // Step 2 (school)
            $table->enum('profession', ['student', 'laureat']);	 // etudiant / lauréat
            $table->string('school'); // Abréviation
            $table->string('niveau'); // 2018/2019
            $table->text('specialite');
            $table->longText('specialite_why');
            // Step 3 (activities)
            $table->enum('orema_member', ['yes', 'no']);
            $table->longText('orema_info');
            $table->longText('effect_school'); // clubs et association des étudiants
            $table->longText('experience_assoc'); // associations experiences
            $table->longText('afc_info'); // كيف تعرفت على أكاديمية أطر الغد
            $table->string('afc_participate'); 
            $table->longText('afc_remarque')->nullable(); // not required
            $table->longText('afc_reason'); // اشرح باختصار سبب رغبتك في المشاركة بالأكاديمية
            // Step 4 (life project)
            $table->longText('life_achievements'); // أهم إنجازاتك في الحياة
            $table->longText('choose'); // ما الذي سيجعل اللجنة المنظمة تختارك من دون الآخرين
            $table->longText('ten_years'); // كيف ترى نفسك بعد 10 سنوات ؟ 
            $table->string('files')->nullable();
            // Step 5 (projects competition)
            $table->enum('work_project', ['yes', 'no']); // هل قمت بالعمل على مشروع ربحي من قبل؟
            $table->longText('project_details')->nullable(); // not required // اشرح المشروع في سطور
            $table->longText('project_proposition'); // قم باقتراح ووصف فكرة مشروع تريد العمل عليها داخل الأكاديمية
            // Step 5 (general)
            $table->text('book_share'); 
            $table->string('book_number'); // 1 -> 20 et +20
            $table->text('read_domain');
            $table->text('book_best'); 
            $table->longText('book_idea'); 
            $table->text('talent'); 
            $table->longText('program_propositions');

            $table->timestamps();
        });
        Schema::table('forms', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
    }
}
