<?php namespace App\Listeners;

class BugEventListener { 

    /**
     * Handle new bug posted. 
     */ 
    public function onNewBug($event) {
    }

    /**
     * Handle new bug comment.
     */
    public function onNewBugComment($event) {
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