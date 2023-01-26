<?php
namespace App\Models;
use App\Models\Sections;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoices extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function section()
    {
    return $this->belongsTo(Sections::class);
    }
}
