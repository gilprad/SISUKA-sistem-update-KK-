<?php

use App\Submission;
use Illuminate\Database\Seeder;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Submission::create([
            'user_id' => '12',
            'reason' => 'baru menikah',
            'status' => Submission::STATUS_PENDING
        ]);
    }
}
