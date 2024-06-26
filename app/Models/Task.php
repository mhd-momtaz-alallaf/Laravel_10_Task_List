<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // here we have to use all of the fields that will changh by mass assinment for security resones.
    protected $fillable = ['title', 'description','long_description'];


    // it's a good practice to add methods into the model.
    public function toggleComplete()
    {
        $this->completed = !$this->completed;
        $this->save();
    }
}
