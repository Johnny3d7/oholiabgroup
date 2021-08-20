<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
class Variation extends Model
{
    use HasFactory;
    
    protected $table = 'variations';

    public $timestamps = true;

    protected $guarded = ['id'];

    protected $fillable = [
        'datemouv',
        'typemouv',
        'production',
        'qte_sortie',
        'qte_entree',
        'observation',
        'status',
        'id_product',
        'id_fournisseur',
        'id_client',
        'id_entreprise'
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'id_fournisseur');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'id_entreprise');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
