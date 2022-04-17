<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class AddTaskWithAttachments extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id,array $pic,$ssname,$fromSection)
    {
     
      
        $this->id = $id;
        $this->pic = $pic;
        $this->ssname = strtolower($ssname);
        $this->fromSection = $fromSection;
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
        $user = Auth::user();
        $section = "";
        $is_admin = Auth::user()->is_admin ? 'admin':'user';
        switch($user->section_id){
            case '2':
                $section = 'protection';
                break;
            case '3':
                $section = 'battery';
                break;
                case '5':
                $section = 'transformers';
                break;
                case '6':
                    $section = 'switch';
                break;    
            default:
            $section = 'section';

        }
        $url ="http://127.0.0.1:8000/dashboard/user/query_section_id=".$this->fromSection."/Engineer-report-form".'/'.$this->id;

       if(count($this->pic)== 1){
        return (new MailMessage)
            ->subject($this->ssname." مهمة جديدة لمحطة")
            ->from('psmdkwco@psmdkw.com', 'Protection Maintenance')
            ->line('اضافة مهمة جديدة')
            ->action('عرض المهمة', $url)
            ->line('قسم الوقاية - ادارة صيانة محطات التحويل الرئيسية  ')
            ->attach(public_path('Attachments/'.$section.'/'.$this->id.'/'.$this->pic[0]));
       }elseif(count($this->pic)==2){
        return (new MailMessage)
            ->subject($this->ssname." مهمة جديدة لمحطة")
            ->from('psmdkwco@psmdkw.com', 'Protection Maintenance')
            ->line('اضافة مهمة جديدة')
            ->action('عرض المهمة', $url)
            ->line('قسم الوقاية - ادارة صيانة محطات التحويل الرئيسية  ')
            ->attach(public_path('Attachments/'.$section.'/'.$this->id.'/'.$this->pic[0]))
            ->attach(public_path('Attachments/'.$section.'/'.$this->id.'/'.$this->pic[1]));
       }elseif(count($this->pic)==3){
        return (new MailMessage)
            ->subject($this->ssname." مهمة جديدة لمحطة")
            ->from('psmdkwco@psmdkw.com', 'Protection Maintenance')
            ->line('اضافة مهمة جديدة')
            ->action('عرض المهمة', $url)
            ->line('قسم الوقاية - ادارة صيانة محطات التحويل الرئيسية  ')
            ->attach(public_path('Attachments/'.$section.'/'.$this->id.'/'.$this->pic[0]))
            ->attach(public_path('Attachments/'.$section.'/'.$this->id.'/'.$this->pic[1]))
            ->attach(public_path('Attachments/'.$section.'/'.$this->id.'/'.$this->pic[2]));
       }elseif(count($this->pic)==4){
        return (new MailMessage)
            ->subject($this->ssname." مهمة جديدة لمحطة")
            ->from('psmdkwco@psmdkw.com', 'Protection Maintenance')
            ->line('اضافة مهمة جديدة')
            ->action('عرض المهمة', $url)
            ->line('قسم الوقاية - ادارة صيانة محطات التحويل الرئيسية  ')
            ->attach(public_path('Attachments/'.$section.'/'.$this->id.'/'.$this->pic[0]))
            ->attach(public_path('Attachments/'.$section.'/'.$this->id.'/'.$this->pic[1]))
            ->attach(public_path('Attachments/'.$section.'/'.$this->id.'/'.$this->pic[2]))
            ->attach(public_path('Attachments/'.$section.'/'.$this->id.'/'.$this->pic[3]));
       }else{
            return (new MailMessage)
                ->subject($this->ssname." مهمة جديدة لمحطة")
                ->from('psmdkwco@psmdkw.com', 'Protection Maintenance')
                ->line('اضافة مهمة جديدة')
                ->action('عرض المهمة', $url)
                ->line('قسم الوقاية - ادارة صيانة محطات التحويل الرئيسية  ')
                ->attach(public_path('Attachments/'.$section.'/'.$this->id.'/'.$this->pic[0]))
                ->attach(public_path('Attachments/'.$section.'/'.$this->id.'/'.$this->pic[1]))
                ->attach(public_path('Attachments/'.$section.'/'.$this->id.'/'.$this->pic[2]))
                ->attach(public_path('Attachments/'.$section.'/'.$this->id.'/'.$this->pic[3]))
                ->attach(public_path('Attachments/'.$section.'/'.$this->id.'/'.$this->pic[4]));   
           }
    

        
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