<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class gc_AddTask extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id, array $pic, $ssname)
    {


        $this->id = $id;
        $this->pic = $pic;
        $this->ssname = strtolower($ssname);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = "http://www.psmdkw.com/dashboard/user/query_section_id=/Engineer-report-form" . '/' . $this->id;

        $mailMessage = (new MailMessage)
            ->subject($this->ssname . " مهمة جديدة لاستلام محطه")
            ->from('psmdkwco@psmdkw.com', 'Protection Maintenance')
            ->line('اضافة مهمة جديدة')
            ->action('عرض المهمة', $url)
            ->line('قسم الوقاية - ادارة صيانة محطات التحويل الرئيسية  ');
        if (!is_null($this->pic)) {
            foreach ($this->pic as $file) {
                $mailMessage->attach(public_path('Attachments/general-check/' . $this->id . '/' . $file));
            }
        }

        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}