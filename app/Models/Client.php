<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Client extends Model
{
    use HasFactory;
    use HasSlug;
    
    protected $table = 'clients';
    
    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'codeclient',
        'nom',
        'slug',
        'email',
        'adresse',
        'contact',
        'id_type_client',
        'statut',
        'category',
        'status'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('codeclient','nom','pnom')
            ->saveSlugsTo('slug');
    }

    public function variations()
    {
        return $this->hasMany(Variation::class, 'id_client');
    }

    public function typeClient()
    {
        return $this->belongsTo(TypeClient::class, 'id_type_client');
    }
}
