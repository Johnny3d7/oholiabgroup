<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
/**
 * @property varchar $uuid uuid
 * @property varchar $reference reference
 * @property varchar $name name
 * @property varchar $reference_achat reference achat
 * @property text $description description
 * @property text $image image
 * @property varchar $type type
 * @property varchar $nature nature
 * @property varchar $unite unite
 * @property int $id_categories id categories
 * @property IdCategory $category belongsTo
 * @property \Illuminate\Database\Eloquent\Collection $entrepotshass belongsToMany
 * @property \Illuminate\Database\Eloquent\Collection $ligneinventaire belongsToMany
 * @property \Illuminate\Database\Eloquent\Collection $lignemouvement belongsToMany
 *
 */
class Product extends BaseModel
{

    /**
    * Database table name
    */
    protected $table = 'products';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['uuid', 'reference', 'name', 'reference_achat', 'description', 'image', 'type', 'nature', 'unite', 'id_categories', 'id_entreprises'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    protected static $prefix = "PROD";
    public static function boot(){
        parent::boot();

        static::creating(function($item){
            $last = self::all()->last()->id ?? 0; // To add all deleted records
            $num = $last<9 ? "000".($last+1) :
                    ($last<99 ? "00".($last+1) :
                        ($last<999 ? "0".($last+1) :
                            ($last+1)));
            $item->reference = static::$prefix.$num;
        });

        static::created(function($item) {
            foreach (Entreprise::find(1)->entrepots as $entrepot) {
                EntrepotsHasProduct::create([
                    'quantite' => 0,
                    'id_products' => $item->id,
                    'id_entrepots' => $entrepot->id,
                ]);
            }
            if($item->id_entreprises != 1){
                foreach (Entreprise::find($item->id_entreprises)->entrepots as $entrepot) {
                    EntrepotsHasProduct::create([
                        'quantite' => 0,
                        'id_products' => $item->id,
                        'id_entrepots' => $entrepot->id,
                    ]);
                }
            }
        });
    }

    public function image(){
        return $this->image ?? 'images/product_picture.jpg';
    }

    /**
    * category
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function category()
    {
        return $this->belongsTo(Category::class,'id_categories');
    }

    /**
    * parametre
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function parametre($string)
    {
        return $this->belongsTo(Parametre::class,$string)->first();
    }
    
    public function natureName()
    {
        return $this->parametre('nature')->name;
    }

    public function typeName()
    {
        return $this->parametre('type')->name;
    }


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
    * entrepots
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function entrepots()
    {
        $entr = EntrepotsHasProduct::whereIdProducts($this->id)->get()->pluck('id_entrepots');
        $entrepots = new Collection();
        foreach ($entr as $value) {
            if(Entrepot::find($value)) $entrepots->add(Entrepot::find($value));
        }
        return $entrepots;
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

    public function stock_physique_entrepot(Entrepot $entrepot){
        $object = EntrepotsHasProduct::whereIdProducts($this->id)->whereIdEntrepots($entrepot->id)->first();
        return $object ? $object->quantite : 0;
    }

    public function stock_virtuel_entrepot(Entrepot $entrepot){
        return $this->stock_physique_entrepot($entrepot);
    }

    public function variation_entrepot(Entrepot $entrepot){
        $ids = Mouvement::whereIdEntrepots($entrepot->id)->get()->pluck('id');
        $object = LigneMouvement::whereIdProducts($this->id)
                                ->whereIn('id_mouvements', $ids)
                                ->get();
        return $object;
    }


}
