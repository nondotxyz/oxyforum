<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Topic;
use Auth;
use Illuminate\Http\Request;
use Validator;

class PostController extends Controller
{
    public function index(Group $group, Topic $topic, Request $request)
    {
        $topic->load("user");
        $posts = $topic->posts()
            ->with("user")
            ->paginate(5);
        return inertia("Post/Index", [
            "group" => $group,
            "topic" => $topic,
            "posts" => $posts,
        ]);
    }


    public function reply(Group $group, Topic $topic)
    {
        return inertia("Post/Create", [
            "group" => $group,
            "topic" => $topic
        ]);
    }


    public function store(Group $group, Topic $topic, Request $request)
    {
        $request->validate([
            "content" => "required|min:10"
        ]);

        $topic->posts()->create([
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
        ]);

        return redirect(route('post', ['group' => $group->id, 'topic' => $topic->id]));
    }
}
