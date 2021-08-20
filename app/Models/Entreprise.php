<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
class Entreprise extends Model
{
    use HasFactory;
    use HasSlug;

    protected $table = 'entreprises';

    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'nom',
        'slug',
        'adresse',
        'email',
        'contact',
        'status'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nom')
            ->saveSlugsTo('slug');
    }

    public function variations()
    {
        return $this->hasMany(Variation::class, 'id_entreprise');
    }
}
