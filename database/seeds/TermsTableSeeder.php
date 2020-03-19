<?php

use Illuminate\Database\Seeder;
use App\Requests\Maravel as Request;
use App\Http\Controllers\API\TermController;

class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $terms = [
            [
                'id' => 1,
                'title' => 'tag',
                'creator_id' => 1,
            ],
            [
                'id' => 3,
                'title' => 'story',
                'creator_id' => 1,
            ],
            [
                'id' => 2,
                'title' => 'special',
                'creator_id' => 1,
            ],
        ];
        foreach ($terms as $key => $value) {
            $request = new Request($value);
            $controller = new TermController($request);
            $controller->store($request);
        }
    }
}
