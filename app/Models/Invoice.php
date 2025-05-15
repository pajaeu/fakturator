<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\UsesCurrentUser;
use Illuminate\Database\Eloquent\Model;

final class Invoice extends Model
{
    use UsesCurrentUser;
}
