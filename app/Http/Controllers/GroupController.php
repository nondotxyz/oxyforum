<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $groups = Group::withCount('topics')
            ->withCount([
                'topics as posts_count' => function ($query) {
                    $query->join('posts', 'topics.id', '=', 'posts.topic_id');
                }
            ])
            ->paginate(10);

        return inertia("Group/Index", [
            "groups" => $groups,
        ]);
    }


    public function create()
    {
        return inertia("Group/Create");
    }

    public function store(Request $request)
    {
        Group::create($request->all());
        return redirect("/group");
    }
}
