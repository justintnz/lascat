<?php

namespace Database\Seeders;

use App\Models\Mclass;
use Illuminate\Database\Seeder;
use App\Models\School;
use App\Models\Student;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $schoolNames = [
            'ACG Parnell College',
            'Auckland Grammar',
            'Auckland International College',
            'Avondale College',
            'Baradene College of the Sacred Heart',
            'Dilworth School',
            'Epsom Girls\' Grammar School',
            'Glendowie College',
            'Lynfield College',
            'Marcellin College',
            'Marist College',
            'Michael Park School',
            'Mount Albert Grammar School',
            'Mount Roskill Grammar School',
            'Mt Hobson Middle School',
            'One Tree Hill College',
            'Onehunga High School',
            'Sacred Heart College',
            'Selwyn College',
            'St Cuthbert\'s College',
            'St Mary\'s College',
        ];

        foreach ($schoolNames as $name) {
            School::create(['name' => $name]);
        }

        $classNames = [
            'Accounting',
            'Business law',
            'Business management',
            'Consumer education',
            'Entrepreneurial skills',
            'Introduction to business',
            'Marketing',
            'Personal finance',
            'Animation',
            'App development',
            'Audio production',
            'Computer programming',
            'Computer repair',
            'Film production',
            'Graphic design',
            'Media technology',
            'Music production',
            'Typing',
            'Video game development',
            'Web design',
            'Web programming',
            'Word processing',
        ];


        foreach ($classNames as $name) {
            $schools = School::inRandomOrder()->limit(15)->get();
            foreach ($schools as $school)
                Mclass::create([
                    'name' => $name,
                    'school_id' => $school->id
                ]);
        }

        Student::factory()
            ->count(150)
            ->create();

        foreach (Student::all() as $student) {
            $availableClasses = $student->school->classes()->get();
            $regClasses = [];
            foreach ($availableClasses as $class)
                if (rand(0, 1) == 1) {
                    $regClasses[] = $class->id;
                }
            $student->classes()->sync($regClasses);
        }

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => 'Ye4oKoEa3Ro9llC',
        ]);
    }
}
