<?php

use App\Story;
use Illuminate\Database\Seeder;

class StoryToMarkdown extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stories = Story::all();
        foreach ($stories as $key => $value) {
            $value->content = preg_replace("#\r\n#Ui", "\r\n\r\n", $value->content);
            $value->save();
        }
    }
}
