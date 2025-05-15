<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\CurrentUserScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;

#[ScopedBy(CurrentUserScope::class)]
final class Invoice extends Model {}
