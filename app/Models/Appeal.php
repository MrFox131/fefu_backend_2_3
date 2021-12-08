<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
  * @props
  * @property string name
  * @property string surname
  * @property string|null patronymic
  * @property int age
  * @property string|null phone
  * @property string|null email
  * @property string message
  * @property int gender
 */
class Appeal extends Model
{
    use HasFactory;
}
