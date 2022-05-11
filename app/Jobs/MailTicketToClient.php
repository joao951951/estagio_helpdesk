<?php

namespace App\Jobs;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PDF;

class MailTicketToClient implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $ticket;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail = new PHPMailer(true);
        $id = $this->ticket->id;
        $client = Client::find($this->ticket->client_id);

        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.kinghost.net'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = env('HOST_EMAIL'); // SMTP username
        $mail->Password = env('HOST_EMAIL_PASS'); // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
        $mail->Port = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Recipients
        /* $mail->setFrom(env('HOST_EMAIL'), env('HOST_EMAIL_NAME')); */
        $mail->setFrom('suporte@connsecurity.com', 'Suporte Helpdesk');
        $mail->addAddress($client->email, $client->name); // Add a recipient
        /* $mail->addAddress('ellen@example.com');  */              // Name is optional
        /* $mail->addReplyTo('info@example.com', 'Information'); */
        /* $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com'); */

        $pdf = PDF::loadView('pdf', ['ticket' => $this->ticket]);
        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/arquivo.pdf', $content);
        $mail->addAttachment(public_path() . '\storage\arquivo.pdf', "ordem-servico-$id.pdf");

        // Attachments
        /* $mail->addAttachment('/var/tmp/file.tar.gz'); */ // Add attachments
        /* $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); */ // Optional name

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Fechamento de Suporte Avantech/Connection';
        $mail->Body = "Fechamento de suporte número $id";
        $mail->AltBody = "Fechamento de suporte número $id";

        $mail->send();
        /* dd('E-mail enviado'); */
    }
}
