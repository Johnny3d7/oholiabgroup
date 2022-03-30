<?php

namespace App\Models;

class Entrepot extends BaseModel
{
    /**
    * Database table name
    */
    protected $table = 'entrepots';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['uuid', 'name', 'id_entreprises'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * entreprise
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class,'id_entreprises');
    }

    /**
    * employes
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function employes()
    {
        return $this->belongsToMany(Employe::class,'entrepots_has_employes');
    }
    /**
    * ehp
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function ehp()
    {
        return $this->hasMany(EntrepotsHasProduct::class, 'id_entrepots');
    }
    
    /**
    * products
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function products()
    {
        $ids = $this->ehp->pluck('id_products');
        return Product::whereIn('id', $ids)->get();
    }
   
    /**
    * voisins
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function voisins()
    {
        $ids = [$this->entreprise->id];
        array_push($ids, 1); // Add Oholiab entrepots
        return parent::whereIn('id_entreprises', $ids)->where('id', '!=', $this->id)->get();
    }

    /**
    * ligneinventaires
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function ligneinventaires()
    {
        return $this->belongsToMany(Ligneinventaire::class,'ligne_inventaires');
    }
    /**
    * lignemouvements
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function lignemouvements()
    {
        return $this->belongsToMany(Lignemouvement::class,'ligne_mouvement');
    }

}
