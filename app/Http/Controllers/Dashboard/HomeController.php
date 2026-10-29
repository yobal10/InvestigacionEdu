<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Survey;
use App\Models\SurveyResponse;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $posts = Post::count();
        $comments = Comment::count();
        $users = User::count();
        $categories = Category::count();
        $surveys = Survey::query()
            ->when(auth()->user()->role !== 3, fn ($query) => $query->where('user_id', auth()->id()))
            ->count();
        $surveyResponses = SurveyResponse::query()
            ->whereHas('survey', fn ($query) => $query->when(auth()->user()->role !== 3, fn ($owned) => $owned->where('user_id', auth()->id())))
            ->count();
        return view("dashboard.home.index", compact("posts", "comments", "users", "categories", "surveys", "surveyResponses"));
    }
}
