<?php

namespace App\Http\Controllers\API;

use App\Requests\Maravel as Request;
use App\Story;
use Illuminate\Validation\Rule;

class StoryController extends Controller
{
    public $order_list = ['story_number' => 'posts.order'];
    public function index(Request $request)
    {
        return $this->_index($request);
    }

    public function store(Request $request)
    {
        return $this->_store($request, function($request, $data){
            $data['creator_id'] = auth()->id();
            if(!isset($data['order']))
            {
                $last = Story::orderBy('order', 'DESC')->first();
                $data['order'] = $last ? $last->order + 1 : 1;
            }
            return $this->model::create($data);
        });
    }

    public function show(Request $request, Story $story)
    {
        return $this->_show($request, $story);
    }

    public function update(Request $request, Story $story)
    {
        return $this->_update($request, $story, function($request, $story, $data){
            $story->update($data);
        });
    }

    public function destroy(Request $request, Story $story)
    {
    }

    public function rules(Request $request, $action, $story = null)
    {
        switch ($action) {
            case 'store':
                return [
                    'title' => 'required',
                    'content' => 'required',
                    'summary' => 'required',
                    'status' => 'nullable|in:draft,publish',
                    'order' => [
                        'nullable',
                        'integer',
                        Rule::unique('posts')->where('type', 'post:story')
                    ]
                ];
            case 'update':
                return [
                    'title' => 'required',
                    'content' => 'required',
                    'summary' => 'required',
                    'status' => 'nullable|in:draft,publish',
                    'order' => [
                        'nullable',
                        'integer',
                        Rule::unique('posts')->where('type', 'post:story')->whereNot('id', $story->id)
                    ]
                ];
        }
        return [];
    }
    public function filters($request, $model)
    {
        $allowed = [
            'status' => ['draft', 'publish']
        ];
        $current = [];
        if(in_array($request->status, $allowed['status']))
        {
            $current['status'] = $request->status;
            $model->where('status', $request->status);
        }

        return [$allowed, $current];
    }
}
