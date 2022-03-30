<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

use \Auth;
class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $tabs = [
            'browse' => 'Lister',
            'read' => 'Consulter',
            'edit' => 'Modifier',
            'add' => 'Ajouter',
            'delete' => 'Supprimer',
        ];

        $tables = DB::select('SHOW TABLES');
        $tables_to_ignore = [
            'migrations', 
        ];
        
        $name = 'Tables_in_'.env('DB_DATABASE');
        foreach($tables as $table)
        {
            foreach ($tabs as $key=>$value) {
                if(!Permission::whereName($table->{$name}.'_'.$key)->first()){
                    Permission::create([
                        'name' => $table->{$name}.'_'.$key,
                        'display_name' => $value.' '.$table->{$name},
                        'table' => $table->{$name},
                    ]);
                }
            }
        }

        $user = Auth::user();
        if($user->hasRole('geststock')) return redirect()->route('stock.index');

        return view('main.modules.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
