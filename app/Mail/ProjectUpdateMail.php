<?php

namespace App\Mail;

use App\Models\Project;
use App\Models\ProjectUpdate;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class ProjectUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $unsubscribeUrl;

    public function __construct(
        public Project $project,
        public ProjectUpdate $update,
        public User $recipient,
    ) {
        $this->unsubscribeUrl = URL::signedRoute('projects.unsubscribe', [
            'project' => $project->id,
            'user'    => $recipient->id,
        ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[' . $this->project->title . '] ' . $this->update->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.project-update',
        );
    }
}
