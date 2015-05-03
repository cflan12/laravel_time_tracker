<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\TimeEntry;
use App\Comment;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		//call the seed classes to run the seeds
		$this->call('UsersTableSeeder');
		$this->call('TimeEntriesTableSeeder');
		$this->call('CommentsTableSeeder');
	}

}

class UsersTableSeeder extends Seeder {

	public function run()
	{
		//Delete users table if it exists before seeding
		DB::table('users')->delete();

		$users = array(
                ['first_name' => 'Ryan', 'last_name' => 'Chenkie', 'email' => 'ryanchenkie@gmail.com', 'password' => Hash::make('secret')],
                ['first_name' => 'Chris', 'last_name' => 'Sevilleja', 'email' => 'chris@scotch.io', 'password' => Hash::make('secret')],
                ['first_name' => 'Holly', 'last_name' => 'Lloyd', 'email' => 'holly@scotch.io', 'password' => Hash::make('secret')],
                ['first_name' => 'Adnan', 'last_name' => 'Kukic', 'email' => 'adnan@scotch.io', 'password' => Hash::make('secret')],
        );

        //Loop through each user and create the record in the DB
        foreach($users as $user)
        {
        	User::create($user);
        }
	}
}

class TimeEntriesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('time_entries')->delete();

		$time_entries = array(
                ['user_id' => 1, 'start_time' => '2015-02-21 18:56:48', 'end_time' => '2015-02-21 20:33:10', 'comment' => 'Initial project setup.'],
                ['user_id' => 2, 'start_time' => '2015-02-27 10:22:42','end_time' => '2015-02-27 14:08:10','comment' => 'Review of project requirements and notes for getting started.'],
                ['user_id' => 3, 'start_time' => '2015-03-03 09:55:32','end_time' => '2015-03-03 12:07:09','comment' => 'Front-end and backend setup.'],
        );

        foreach($time_entries as $time_entry)
        {
        	TimeEntry::create($time_entry);
        }
	}
}


class CommentsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('comments')->delete();

		$comments = array(
			['comment' => 'Clock In'],
			['comment' => 'Clock Out'],
			['comment' => 'Vacation'],
			['comment' => 'Sick'],
			['comment' => 'Personal'],
			['comment' => 'Lunch'],
			['comment' => 'Remote'],
			['comment' => 'Offline']
		);

		foreach($comments as $comment)
		{
			Comment::create($comment);
		}
	}
}
