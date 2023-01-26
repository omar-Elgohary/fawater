<?php
namespace App\Models;
use App\Models\Sections;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function section()
    {
        return $this->belongsTo(Sections::class);
    }
}
