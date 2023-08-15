<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Student;
use Illuminate\Mail\Mailables\Address;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    //public function __construct(public Student $student)
    public function __construct(public array $target_item_array)
    {
        //$student->name
        //$this->target_item = $content;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        //print_r($this->target_item_array);
        /*
        $type_msg='退室';
        if($this->target_item_array['type']=='in'){
            $type_msg='入室';
        }
        */
        $from    = new Address($this->target_item_array['email'], $this->target_item_array['protector']);
        $subject = $this->target_item_array['name_sei'].' '.$this->target_item_array['name_mei'].'さんが'.$this->target_item_array['type'].'入室されました。';
        //$from    = new Address($target_item_array['email'], $target_item_array['protector']);
        //$subject = $target_item_array['name_sei'].' '.$target_item_array['name_mei'].'さんが'.$$target_item_array['type'].'入室されました。';
        return new Envelope(
            subject: $subject,
            from: 'inf@szemi-gp.com',
            to: $this->target_item_array['email'],
            replyTo:'inf@szemi-gp.com',
        );

    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.contact',
            text: 'emails.contact',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
