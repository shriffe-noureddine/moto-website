<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Marc',
            'email' => 'marcsmotorcycles@gmail.com',
            'password' => bcrypt('marc1234'),
            'phone' => '+352 555 555 1',
            'location' => 'hospital',
            'picture' => '/pics/users/marc.jpg',
            'level' => 'administrator',
            'email_verified_at' => '2019-12-08',
            'created_at' => '2019-12-08 10:51:15',
            'updated_at' => '2019-12-08 10:51:31',
        ]);
        DB::table('users')->insert([
            'name' => 'Bugs Bunny',
            'email' => 'bugs.bunny@isonthenet.de',
            'password' => bcrypt('bugs1234'),
            'phone' => '+352 555 555 2',
            'location' => 'rabbit hole',
            'picture' => '/pics/users/bugsbunny.jpg',
            'level' => 'administrator',
            'email_verified_at' => '2019-12-08',
            'created_at' => '2019-12-08 10:51:15',
            'updated_at' => '2019-12-08 10:51:31',
        ]);
        DB::table('users')->insert([
            'name' => 'Daffy Duck',
            'email' => 'daffy.duck@isonthenet.de',
            'password' => bcrypt('daffy1234'),
            'phone' => '+352 555 555 3',
            'location' => 'Mosella',
            'picture' => '/pics/users/daffyduck.png',
            'level' => 'user',
            'email_verified_at' => '2019-12-08',
            'created_at' => '2019-12-08 10:51:15',
            'updated_at' => '2019-12-08 10:51:31',
        ]);
        DB::table('users')->insert([
            'name' => 'Emma Webster',
            'email' => 'emma.webster@isonthenet.de',
            'password' => bcrypt('emma1234'),
            'phone' => '+352 555 555 4',
            'location' => 'Luxembourg Grund',
            'picture' => '/pics/users/emmawebster.jpg',
            'level' => 'user',
            'email_verified_at' => '2019-12-08',
            'created_at' => '2019-12-08 10:51:15',
            'updated_at' => '2019-12-08 10:51:31',
        ]);
        DB::table('users')->insert([
            'name' => 'Olaf',
            'email' => 'mail@olaf-schmidt.com',
            'password' => bcrypt('olaf1234'),
            'phone' => '+352 555 555 5',
            'location' => 'Wasserbillig',
            'picture' => '/pics/users/olaf.jpg',
            'level' => 'administrator',
            'email_verified_at' => '2019-12-08',
            'created_at' => '2019-12-08 10:51:15',
            'updated_at' => '2019-12-08 10:51:31',
        ]);
        DB::table('users')->insert([
            'name' => 'Sylvester Jackson Pussycat',
            'email' => 'sylvester.jackson.pussycat@isonthenet.de',
            'password' => bcrypt('sylvester1234'),
            'phone' => '+352 555 555 6',
            'location' => 'Mersch',
            'picture' => '/pics/users/sylvester.png',
            'level' => 'user',
            'email_verified_at' => '2019-12-08',
            'created_at' => '2019-12-08 10:51:15',
            'updated_at' => '2019-12-08 10:51:31',
        ]);
        DB::table('users')->insert([
            'name' => 'Tweety',
            'email' => 'tweety@isonthenet.de',
            'password' => bcrypt('tweety1234'),
            'phone' => '+352 555 555 7',
            'location' => 'Diekirch',
            'picture' => '/pics/users/tweety.jpg',
            'level' => 'user',
            'email_verified_at' => '2019-12-08',
            'created_at' => '2019-12-08 10:51:15',
            'updated_at' => '2019-12-08 10:51:31',
        ]);
        DB::table('users')->insert([
            'name' => 'Giuseppe',
            'email' => 'giuseppe.somare@yahoo.it',
            'password' => bcrypt('giuseppe1234'),
            'phone' => '+352 555 555 8',
            'location' => 'Luxembourg',
            'picture' => '/pics/users/giuseppe.jpg',
            'level' => 'administrator',
            'email_verified_at' => '2019-12-08',
            'created_at' => '2019-12-08 10:51:15',
            'updated_at' => '2019-12-08 10:51:31',
        ]);
        DB::table('users')->insert([
            'name' => 'Nour',
            'email' => 'noureldincharifh@gmail.com',
            'password' => bcrypt('nour1234'),
            'phone' => '+352 555 555 9',
            'location' => 'Esch',
            'picture' => '/pics/users/nour.jpg',
            'level' => 'administrator',
            'email_verified_at' => '2019-12-08',
            'created_at' => '2019-12-08 10:51:15',
            'updated_at' => '2019-12-08 10:51:31',
        ]);
    }
}
