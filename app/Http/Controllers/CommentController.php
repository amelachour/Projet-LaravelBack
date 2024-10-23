<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class CommentController extends Controller
{
  public function destroy($id)
  {
    $comment = Comment::findOrFail($id);
    $comment->delete();

    return back()->with('success', 'Commentaire supprimé avec succès');
  }
}
