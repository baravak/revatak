<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Term as ResourcesTerm;
use App\Requests\Maravel as Request;
use App\Post;
use App\Term;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public $order_list = ['id' => 'posts.id'];
    public function index(Request $request)
    {
        return $this->_index($request);
    }

    public function queryIndex($request)
    {
        return [null, $this->model::where('type', 'post')];
    }

    public function store(Request $request)
    {
        return $this->_store($request);
    }

    public function show(Request $request, Post $post)
    {
        return $this->_show($request, $post);
    }

    public function update(Request $request, Post $post)
    {
        return $this->_update($request, $post);
    }

    public function destroy(Request $request, Post $post)
    {
    }

    public function rules(Request $request, $action, $post = null)
    {
        switch ($action) {
            case 'store':
                return [
                    'title' => 'required',
                    'content' => 'required',
                    'summary' => 'nullable',
                    'status' => 'nullable|in:draft,publish',
                    'primary_term_id' => 'required|exists_serial:terms,id',
                    'creator_id' => 'nullable'
                ];
            case 'update':
                return [
                    'title' => 'required',
                    'content' => 'required',
                    'summary' => 'nullable',
                    'status' => 'nullable|in:draft,publish'
                ];
        }
        return [];
    }
    public function filters($request, $model)
    {
        $allowed = [
            'status' => ['draft', 'publish'],
            'primary_term' => '$TERM',
            'term_slug' => null,
            'term' => '$TERM'
        ];
        $current = [];
        if(in_array($request->status, $allowed['status']))
        {
            $current['status'] = $request->status;
            $model->where('status', $request->status);
        }
        if ($request->primary_term) {
            $primary_term = Term::findBySerial($request->primary_term);
            if (!$primary_term) {
                $this->fail(Term::class, $request->primary_term);
            }
            $model->where('primary_term_id', $primary_term->id);
            $current['primary_term'] = new ResourcesTerm($primary_term);
        }

        if ($request->term_slug) {
            $term_slug = Term::where('parent_id', 3)->where('title', $request->term_slug)->first();
            if (!$term_slug) {
                $this->fail(Term::class, $request->term_slug);
            }
            $model->where('primary_term_id', $term_slug->id);
            $current['term_slug'] = new ResourcesTerm($term_slug);
        }

        if ($request->term) {
            $term = Term::findBySerial($request->term);
            $ids = $term->parents->pluck('id')->toArray();
            array_push($ids, $term->id);
            $subTerm = Term::where('parent_map', 'LIKE', join(',', $ids) . '%')->without(['parents', 'creator']);
            if (!$term) {
                $this->fail(Term::class, $request->term);
            }
            $model->join('term_usages', function($q) use ($subTerm){
                $q->on('term_usages.table_id', 'posts.id')
                ->where('term_usages.table_name', 'posts')
                ->whereIn('term_usages.term_id', $subTerm->pluck('id')->toArray());
            });
            $current['term'] = new ResourcesTerm($term);
        }

        return [$allowed, $current];
    }

    public function requestData($request, $action, &$data)
    {
        if($action == 'store')
        {
            $data['creator_id'] = auth()->id();
        }
    }
}
