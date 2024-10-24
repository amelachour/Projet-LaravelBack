<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {
    $totalPosts = Post::count();
    $totalLikes = Like::count();
    $totalComments = Comment::count();
    $mostLikedPost = Post::withCount('likes')->orderBy('likes_count', 'desc')->first();
    dd($totalPosts, $totalLikes, $totalComments, $mostLikedPost);
    return view('content.dashboard.dashboards-analytics', [
      'totalPosts' => $totalPosts,
      'totalLikes' => $totalLikes,
      'totalComments' => $totalComments,
      'mostLikedPost' => $mostLikedPost
    ]);
  }}
