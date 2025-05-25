<?php

namespace App\Mail;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CourseStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $course;
    public $status;
    public $feedback;

    /**
     * Create a new message instance.
     */
    public function __construct(Course $course, string $status, string $feedback)
    {
        $this->course = $course;
        $this->status = $status;
        $this->feedback = $feedback;
    }
    /**
     * Get the message envelope.
     */
    public function build()
    {
        $subject = $this->status === 'approved'
            ? "Congratulations!, Your Course '{$this->course->title}' Has Been Approved"
            : "Unfortunately!, Your Course '{$this->course->title}' Has Been Rejected";

        return $this->subject($subject)
                    ->view('mail.course_status_notification')
                    ->with([
                        'course' => $this->course,
                        'status' => $this->status,
                        'feedback' => $this->feedback,
                    ]);
    }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
