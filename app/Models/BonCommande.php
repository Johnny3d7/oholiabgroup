<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BonCommande extends Model
{
    use HasFactory;
   

    protected $table = 'bon_commandes';

    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'accord_envoie',
        'proforma',
        'proforma_path',
        'date_livraison',
        'lieu_livraison',
        'id_fournisseur',
        'status'
    ];

    

    public function products()
    {
        return $this->belongsToMany(Product::class, 'ligne_bon_commandes', 'bon_commande_id', 'product_id')->withPivot('qte','prix', 'status')->withTimestamps();
    }

    public function commande_fournisseur()
    {
        return $this->hasMany(CommandeFournisseur::class, 'id_boncommande');
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'id_fournisseur');
    }
}
