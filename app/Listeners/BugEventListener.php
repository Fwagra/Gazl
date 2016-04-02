<?php namespace App\Listeners;

use Auth;
use App\Bug;
use App\Project;
use App\User;
use Mail;

class BugEventListener {

    /**
     * Handle new bug posted.
     */
    public function onNewBug($event)
    {
        $bug = $event->bug;
        $project = $bug->project;
        $emails = [];

        if(Auth::check())
        {
            $user = Auth::user();
            $notifieds =  $project->notifications()->where('user_id','!=', $user->id)->get();
        }else
        {
            $notifieds = $project->notifications;
        }

        if($notifieds)
        {
            foreach ($notifieds as $key => $notifications)
            {
                $emails[] = User::find($notifications->user_id)->email;
            }
        }

        if(count($emails))
        {
            Mail::send('email.bugs.new', ['bug' => $bug, 'project' => $project], function($message) use ($emails, $project)
            {
                $message->to($emails)->subject(trans('email.new_bug_subject', ['project' => $project->name]));
            });
        }

    }

    /**
     * Handle new bug comment.
     */
    public function onNewBugComment($event)
    {
      $comment = $event->comment;
      $bug = Bug::find($comment->bug_id);
      $user = Auth::user();
      $project = $bug->project;
      $emails = [];

      if($comment->guest == 1)
      {
        $notifieds =  $project->notifications;
      }
      elseif($bug->guest == 1)
      {
        $emails[] = $bug->email;
      }else{
        $notifieds =  $project->notifications()->where('user_id','!=', $user->id)->get();
      }

      if($notifieds)
      {
          foreach ($notifieds as $key => $notifications)
          {
              $emails[] = User::find($notifications->user_id)->email;
          }
      }

      if(count($emails))
      {
        Mail::send('email.bugs.newcomment', ['bug' => $bug, 'project' => $project, 'comment' => $comment], function($message) use ($emails, $project, $bug)
        {
            $message->to($emails)->subject(trans('email.new_bugcomment_subject', ['project' => $project->name, 'id' => $bug->id]));
        });
      }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\NewBug',
            'App\Listeners\BugEventListener@onNewBug'
        );

        $events->listen(
            'App\Events\NewBugComment',
              'App\Listeners\BugEventListener@onNewBugComment'
        );
    }
}
