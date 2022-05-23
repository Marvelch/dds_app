<?php

namespace App\Http\Controllers;

use App\Models\KasMasuk;
use App\Models\Supplier;
use App\Models\Oppenent;
use App\Models\Customer;
use App\Models\TemporaryStorageKasMasuk;
use Illuminate\Http\Request;
use App\Models\Kasmsk;
use Yajra\DataTables\DataTables;
use Auth;
use DB;

class KasMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Kasmsk::all();

        return view('kasmasuk.index', compact('items'));
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
        // validate form submit 

        // Create Unique Code
        $items = Kasmsk::all();

        $yearsMonth = date('Y');

        if (!$items) {
            $uniqueCode = "KM/" . substr($yearsMonth, -2) . date('m') . "/0001";

            // kasmsk unique code
            $kasmskUnique = "KM000001";
        } else {
            // get last record
            $items = $items->last();

            $characters = substr($items->nobukti, -4) + 1;
            $path_characters = sprintf("%04d", $characters);
            $uniqueCode = "KM/" . substr($yearsMonth, -2) . date('m') . "/" . $path_characters;

            // kasmsk unique code
            $item_kasMasuk = substr($items->kasmsk, -4) + 1;
            $path_kas = sprintf("%06d", $item_kasMasuk);
            $kasmskUnique = "KM" . $path_kas;
        }

        Kasmsk::create([
            'tgl'       => $request->dateToday,
            'kasmsk'    => $kasmskUnique,
            'nobukti'   => $uniqueCode,
            'subket'    => $request->accepted,
            'ket'       => $request->description,
            'lastusr'   => 0,
            'status'    => 0,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KasMasuk  $kasMasuk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = Kasmsk::where('kasmsk', $id)->first();

        return view('kasmasuk.edit', compact('items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KasMasuk  $kasMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(KasMasuk $kasMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KasMasuk  $kasMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KasMasuk $kasMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KasMasuk  $kasMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(KasMasuk $kasMasuk)
    {
        //
    }

    public function addNew()
    {
        $items = Kasmsk::all();

        $yearsMonth = date('Y');

        if (!$items) {
            $uniqueCode = "KM/" . substr($yearsMonth, -2) . date('m') . "/0001";
        } else {
            $items = $items->last();
            $items = substr($items->nobukti, -4) + 1;
            $items = sprintf("%04d", $items);
            $uniqueCode = "KM/" . substr($yearsMonth, -2) . date('m') . "/" . $items;
        }

        $oppenents = Oppenent::all();

        return view('kasmasuk.add', compact('uniqueCode', 'oppenents'));
    }


    /**
     * Call data for table kasmsk
     *
     * @param  \App\Models\KasMasuk  $kasMasuk
     * @return \Illuminate\Http\Response
     */
    public function getCashIn(Request $request)
    {
        return Datatables::of(Kasmsk::all())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = "<a href='" . URL('users/cash_list/' . $row->kasmsk) . "' class='edit btn btn-primary btn-sm m-1'><span class='material-symbols-outlined' title='Ubah'>edit_note</span></a>";
                $btn = $btn . "<a href='javascript:void(0)' class='edit btn btn-danger btn-sm m-1'><span class='material-symbols-outlined' title='Hapus'>delete_sweep</span></a>";

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getOpponent($id)
    {
        $oppenents = Oppenent::all();

        foreach ($oppenents as $item) {
            if ($item->oppenent_name == $id) {
                $items = DB::table($item->table_name)->select('nama', $item->table_name, 'id')->get();
            }
        }

        return response()->json($items);
    }

    /**
     * Post data for table kasmsk
     *
     * @param  \App\Models\KasMasuk  $kasMasuk
     * @return \Illuminate\Http\Response
     */
    public function postKasMasuk(Request $request)
    {
        try {
            TemporaryStorageKasMasuk::create([
                'id_users'      => Auth::user()->id,
                'id_kasmsk'     => $request->push_opponent,
                'no_ref'        => $request->no_ref,
                'name_opponent' => $request->push_opponent_hidden,
                // Perbedaan table name dan value dari select option 
                'table_name'    => $request->opponent,
                'currency'      => $request->currency,
                'value'         => $request->value,
                'description'   => $request->description,
            ]);

            return redirect('/users/add_cash_in');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    /**
     * Call data for table temporary_storage_kas_masuks
     *
     * @param  \App\Models\KasMasuk  $kasMasuk
     * @return \Illuminate\Http\Response
     */
    public function getKasMasuk()
    {

        return Datatables::of(TemporaryStorageKasMasuk::all())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = "<a href='" . URL('users/cash_list/' . $row->kasmsk) . "' class='btn btn-danger btn-sm'><span class='material-symbols-outlined' title='Hapus'>delete</span></a>";

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
