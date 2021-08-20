<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
class TypeFournisseur extends Model
{
    use HasFactory;
    use HasSlug;
    
    protected $table = 'type_fournisseurs';

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

    public function fournisseurs()
    {
        return $this->hasMany(Fournisseur::class, 'id_type_fournisseur');
    }
}
