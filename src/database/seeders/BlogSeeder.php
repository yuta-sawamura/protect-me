<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run(): void
    {
        DB::table('blogs')->insert([
            [
                'user_id' => 1,
                'title' => 'The Benefits of Meditation',
                'content' => 'Meditation is an ancient practice that has been shown to have numerous health benefits. It can help reduce stress, improve concentration, and promote feelings of peace and well-being.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'title' => 'Tips for Eating a Healthy Diet',
                'content' => 'Eating a healthy diet is essential for maintaining good health. Some tips for eating a healthy diet include eating a variety of fruits and vegetables, choosing whole grains over refined grains, and limiting intake of processed foods.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'title' => 'The Importance of Regular Exercise',
                'content' => 'Regular exercise is important for maintaining good physical and mental health. It can help reduce the risk of chronic diseases such as heart disease, diabetes, and obesity, and can also improve mood and reduce stress.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'title' => 'How to Improve Your Sleep Quality',
                'content' => 'Getting good quality sleep is essential for maintaining good health. Some tips for improving sleep quality include establishing a regular sleep schedule, avoiding caffeine and alcohol before bedtime, and creating a relaxing sleep environment.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'title' => 'The Benefits of Spending Time in Nature',
                'content' => 'Spending time in nature has been shown to have numerous health benefits. It can help reduce stress, improve mood, and promote feelings of well-being. Some ways to spend time in nature include going for a walk in the park, going on a hike, or gardening.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Tips for Managing Stress',
                'content' => 'Stress can have negative effects on both physical and mental health. Some tips for managing stress include practicing relaxation techniques such as deep breathing and meditation, getting regular exercise, and seeking support from friends and family.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'title' => 'The Benefits of Drinking Water',
                'content' => 'Drinking water is essential for maintaining good health. It helps regulate body temperature, transport nutrients, and remove waste from the body. Some tips for staying hydrated include drinking water throughout the day, and choosing water over sugary drinks.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'title' => 'Tips for Maintaining Good Oral Health',
                'content' => 'Maintaining good oral health is important for overall health. Some tips for maintaining good oral health include brushing and flossing regularly, using fluoride toothpaste, and visiting the dentist regularly for checkups and cleanings.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'title' => 'The Benefits of Spending Time with Loved Ones',
                'content' => 'Spending time with loved ones has been shown to have numerous health benefits. It can help reduce stress, improve mood, and promote feelings of well-being. Some ways to spend time with loved ones include going for a walk together, cooking a meal together, or playing a game.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
