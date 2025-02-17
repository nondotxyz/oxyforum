<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Auth;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index(Group $group)
    {
        $topics = $group->topics()->with("user")->paginate(10);

        return inertia("Topic/Index", [
            "group" => $group,
            "topics" => $topics,
        ]);
    }

    public function create(Group $group)
    {
        return inertia("Topic/Create", [
            "group" => $group,
        ]);
    }

    public function store(Group $group, Request $request)
    {
        $group->topics()->create([
            "title" => $request->title,
            "content" => $request->content,
            "user_id" => Auth::id()
        ]);
        return redirect(route("topic", ["group" => $group->id]));
    }
}
