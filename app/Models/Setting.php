<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use Notifiable, HasRoles;
}
