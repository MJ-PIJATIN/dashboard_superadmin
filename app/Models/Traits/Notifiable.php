<?php

namespace App\Models\Traits;

use App\Models\Notification;
use Illuminate\Support\Str;

trait Notifiable
{
    /**
     * Boot the trait.
     *
     * @return void
     */
    protected static function bootNotifiable()
    {
        static::created(function ($model) {
            $model->createNotification('created');
        });

        static::updated(function ($model) {
            $model->createNotification('updated');
        });

        static::deleted(function ($model) {
            $model->createNotification('deleted');
        });
    }

    /**
     * Create a notification for the model event.
     *
     * @param string $action
     * @return void
     */
    protected function createNotification(string $action)
    {
        // Jangan buat notifikasi jika tidak ada yang berubah saat update
        if ($action === 'updated' && !$this->wasChanged()) {
            return;
        }

        $user = auth()->user();
        $message = $this->getNotificationMessage($action);

        Notification::create([
            'message' => $message,
            'action' => $action,
            'target_type' => $user ? class_basename($user) : null, // Use basename for ENUM, or null
            'target_id' => $user ? $user->id : null,
        ]);
    }

    /**
     * Get the notification message for the given action.
     *
     * @param string $action
     * @return string
     */
    protected function getNotificationMessage(string $action)
    {
        $user = auth()->user();
        $role = $user ? class_basename($user) : 'System';

        $modelName = class_basename($this);
        $identifier = $this->getIdentifier();
        
        $actionVerb = [
            'created' => 'Menambahkan',
            'updated' => 'Memperbarui',
            'deleted' => 'Menghapus',
        ];

        return "{$role} {$actionVerb[$action]} {$modelName} {$identifier}";
    }

    /**
     * Get a descriptive identifier for the model.
     *
     * @return string
     */
    protected function getIdentifier()
    {
        // Urutan prioritas untuk nama identifier
        $attributes = ['name', 'nama', 'title', 'city', 'email', 'username'];
        $modelAttributes = $this->getAttributes();

        foreach ($attributes as $attribute) {
            // Cek apakah atribut ada di model sebelum mengaksesnya
            if (array_key_exists($attribute, $modelAttributes) && !empty($modelAttributes[$attribute])) {
                return $modelAttributes[$attribute];
            }
        }

        // Fallback ke ID jika tidak ada atribut yang cocok
        return $this->getKey();
    }
}
