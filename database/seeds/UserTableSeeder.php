<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Subject;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        factory(User::class)->create([
            'email' => 'admin@gmail.com',
            'name' => 'Admin',
            'password' => bcrypt('12345678'),
            'is_admin' => 1,
        ]);

        for ($i = 0; $i <= 10; $i++) {
        	$mssv = "$i$i$i$i$i$i$i";
        	$user = User::create([
        		'name' => $faker->name,
        		'email' => $mssv . '@sv.com.vn',
        		'password' => bcrypt('12345678'),
        	]);
        	$user->student()->create([
        		'name' => $user->name,
        		'mssv' => $mssv,
        		'class' => ($i > 0 && $i < 10 ? '1' . $i . 'T1' : '11T4'),

        	]);
        }

        Subject::create([
    		'name' => 'Môn học 1',
    		'start_time' => '07:00:00',
    		'end_time' => '12:00:00',
    		'learn_time' => 1,
    	]);
    	Subject::create([
    		'name' => 'Môn học 2',
    		'start_time' => '13:00:00',
    		'end_time' => '17:00:00',
    		'learn_time' => 1,
    	]);
    	Subject::create([
    		'name' => 'Môn học 3',
    		'start_time' => '07:00:00',
    		'end_time' => '12:00:00',
    		'learn_time' => 2,
    	]);
    	Subject::create([
    		'name' => 'Môn học 4',
    		'start_time' => '13:00:00',
    		'end_time' => '17:00:00',
    		'learn_time' => 2,
    	]);
    	Subject::create([
    		'name' => 'Môn học 5',
    		'start_time' => '07:00:00',
    		'end_time' => '12:00:00',
    		'learn_time' => 3,
    	]);
    	Subject::create([
    		'name' => 'Môn học 6',
    		'start_time' => '13:00:00',
    		'end_time' => '17:00:00',
    		'learn_time' => 3,
    	]);
    	Subject::create([
    		'name' => 'Môn học 7',
    		'start_time' => '07:00:00',
    		'end_time' => '12:00:00',
    		'learn_time' => 4,
    	]);
    	Subject::create([
    		'name' => 'Môn học 8',
    		'start_time' => '13:00:00',
    		'end_time' => '17:00:00',
    		'learn_time' => 4,
    	]);
    	Subject::create([
    		'name' => 'Môn học 9',
    		'start_time' => '07:00:00',
    		'end_time' => '12:00:00',
    		'learn_time' => 5,
    	]);
    	Subject::create([
    		'name' => 'Môn học 10',
    		'start_time' => '13:00:00',
    		'end_time' => '17:00:00',
    		'learn_time' => 5,
    	]);
    }
}
