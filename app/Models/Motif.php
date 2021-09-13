<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Motif extends Model
{
    use HasFactory;
    use HasSlug;
    
    protected $table = 'motifs';

    public $timestamps = true;

    protected $fillable = [
        'lib',
        'slug',
        'status'
    ];

    protected $guarded = ['id'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('lib')
            ->saveSlugsTo('slug');
    }

    public function variations()
    {
        return $this->hasMany(Variation::class, 'id_motif');
    }
}
