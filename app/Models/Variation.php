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
        'id_entrepot'
    ];

   
    public function entrepot()
    {
        return $this->belongsTo(Entrepot::class, 'id_entrepot');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function motif()
    {
        return $this->belongsTo(Motif::class, 'id_motif');
    }
}
