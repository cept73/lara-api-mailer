<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $from
 * @property string $to
 * @property string $subject
 * @property string $body
 * @property int $created_at
 * @property int $updated_at
 */
class Mail extends Model
{
    use HasFactory;
}
