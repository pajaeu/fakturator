<?php

declare(strict_types=1);

namespace App\Support;

use Livewire\Wireable;

final class Notification implements Wireable
{
    public const string SUCCESS = 'success';

    public const string ERROR = 'danger';

    public const string WARNING = 'warning';

    public const string INFO = 'info';

    public function __construct(
        public string $id,
        public string $message,
        public string $type = self::SUCCESS
    ) {}

    public static function fromLivewire(mixed $value): self
    {
        if (! is_array($value)) {
            return new self(uniqid(), '', self::SUCCESS);
        }

        return new self(
            is_string($value['id']) ? $value['id'] : '',
            is_string($value['message']) ? $value['message'] : '',
            is_string($value['type']) ? $value['type'] : self::SUCCESS,
        );
    }

    public function icon(): ?string
    {
        return match ($this->type) {
            self::SUCCESS => 'icons.check',
            default => null
        };
    }

    public function color(): ?string
    {
        return match ($this->type) {
            self::SUCCESS => 'text-green-600',
            default => null
        };
    }

    /** @return array<string, string> */
    public function toLivewire(): array
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'type' => $this->type,
        ];
    }
}
