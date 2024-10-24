<?php

namespace App\Http\Controllers;

use App\Mail\NewPostNotification;
use App\Models\Article;
use App\Models\Post;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{
  // Display a listing of the articles
  public function index()
  {
    $articles = Post::with(['media', 'comments', 'user'])->get();
    return view('articles.index', compact('articles'));
  }

  // Show the form for creating a new article
  public function create()
  {
    // Return the create article view
    return view('articles.create');
  }

  // Store a newly created article in storage
  public function store(Request $request)
  {
    $data = $request->validate([
      'title' => 'required|string|max:255',
      'body' => 'required|string',
      'location' => 'nullable|string|max:255',
      'media' => 'nullable|file|mimes:jpeg,jpg,png,gif,mp4,mov,avi,mkv|max:20480', // Max 20MB
    ]);

    // Create the article
    $article = Post::create([
      'user_id' => 4, // Assuming this is the admin user ID
      'title' => $request->input('title'),
      'body' => $request->input('body'),
      'location' => $request->input('location'),
    ]);

    // Handle file upload (image or video)
    if ($request->hasFile('media')) {
      $file = $request->file('media');

      // Save file in 'public/images' directory
      $filename = time() . '_' . $file->getClientOriginalName();
      $path = $file->move(public_path('images'), $filename);

      // Determine if it's an image or a video
      $is_image = in_array($file->getClientMimeType(), ['image/jpeg', 'image/png', 'image/gif']);

      // Save media record
      Media::create([
        'post_id' => $article->id,
        'path' => 'images/' . $filename, // Save path relative to the public folder
        'is_image' => $is_image,
      ]);
    }

    // Fetch all users except the one with ID 1
    $users = User::where('id', '!=', 1)->get();

    // Send email notification to all users
    foreach ($users as $user) {
      Mail::to($user->email)->send(new NewPostNotification($article));
    }

    return redirect()->route('articles.index')->with('success', 'Article ajouté avec succès');
  }
  // Display the specified article
  public function show(Post $article)
  {
    return view('articles.show', compact('article'));
  }

  // Show the form for editing the specified article
  public function edit(Post $article)
  {
    return view('articles.edit', compact('article'));
  }

  // Update the specified article in storage
  public function update(Request $request, Post $article)
  {
    // Validate the input
    $data = $request->validate([
      'title' => 'required|string|max:255',
      'body' => 'required|string',
      'location' => 'nullable|string|max:255',
      'media' => 'nullable|file|mimes:jpeg,jpg,png,gif,mp4,mov,avi,mkv|max:20480', // Max 20MB
    ]);

    // Update the article fields
    $article->update([
      'title' => $request->input('title'),
      'body' => $request->input('body'),
      'location' => $request->input('location'),
    ]);

    // Handle media upload
    if ($request->hasFile('media')) {
      // Delete old media if exists
      if ($article->media) {
        \Storage::delete($article->media->path);
        $article->media->delete();
      }

      $file = $request->file('media');
      $filename = time() . '_' . $file->getClientOriginalName();
      $path = $file->move(public_path('images'), $filename);

      $is_image = in_array($file->getClientMimeType(), ['image/jpeg', 'image/png', 'image/gif']);

      // Save the new media record
      Media::create([
        'post_id' => $article->id,
        'path' => 'images/' . $filename,
        'is_image' => $is_image,
      ]);
    }

    return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès');
  }

  // Remove the specified article from storage
  public function destroy(Post $article)
  {
    if ($article->media) {
      \Storage::delete($article->media->path);
      $article->media->delete();
    }

    $article->delete();

    return response()->json(['success' => 'Article supprimé avec succès']);
  }
}
