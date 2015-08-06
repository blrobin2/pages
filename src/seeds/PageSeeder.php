<?php namespace BruceCms\Pages\Seeds;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            'title' => 'Home',
            'link' => 'home',
            'body' => '<p>This is the home page! I\'m in the database and ready to be edited!</p>',
            'sort' => 1,
            'hidden' => 0
        ]);
    }
}