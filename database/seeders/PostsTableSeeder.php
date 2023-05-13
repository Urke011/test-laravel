<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $posts = [
           [
               'title'=>'Post one',
               'excerpt'=>'Summary of Post one',
               'body'=>'body of Post one',
               'image_path'=>'empty',
               'is_published'=>false,
               'min_to_read'=>2
           ],
           [
               'title'=>'Post two',
               'excerpt'=>'Summary of Post two',
               'body'=>'body of Post two',
               'image_path'=>'empty',
               'is_published'=>true,
               'min_to_read'=>5
           ]
       ];

       foreach ($posts as $key => $value){
           Post::create($value);
       }
    }
}
