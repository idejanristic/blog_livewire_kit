<?php

namespace App\Traits;


trait Toastable
{
    private function sendToast($withSession, $type, $event, $message, $duration): void
    {
        if ($withSession) {
            session()->flash(
                key: $event,
                value: [
                    'title' => ucfirst(string: $type),
                    'message' => $message,
                    'type' => $type,
                    'duration' => $duration,
                ]
            );
        } else {
            $this->dispatch(
                event: $event,
                title: ucfirst(string: $type),
                message: $message,
                type: $type,
                duration: $duration,
            );
        }
    }

    public function toastSuccess(bool $withSession, $message, int $duration = 6000): void
    {
        $this->sendToast($withSession, 'success', 'toast', $message, $duration);
    }

    public function toastError(bool $withSession, string $message, int $duration = 6000): void
    {
        $this->sendToast($withSession, 'error', 'toast', $message, $duration);
    }

    public function toastInfo(bool $withSession, string $message, int $duration = 6000): void
    {
        $this->sendToast($withSession, 'info', 'toast', $message, $duration);
    }

    public function toastWarning(bool $withSession, string $message, int $duration = 6000): void
    {
        $this->sendToast($withSession, 'warning', 'toast', $message, $duration);
    }
}
