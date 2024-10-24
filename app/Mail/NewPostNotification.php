<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewPostNotification extends Mailable
{
  use Queueable, SerializesModels;

  public $post;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(Post $post)
  {
    $this->post = $post;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->subject('Un nouveau post a été publié')
      ->view('emails.new_post_notification');
  }
}
