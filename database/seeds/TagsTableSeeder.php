<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect(['Laravel', 'Sport','Bug','Game']) ;
        $tags->each(function($c){
                Tag::create([
                    'name' => $c,
                    'slug' => \Str::slug($c),
                ]);
        });
    }
}
