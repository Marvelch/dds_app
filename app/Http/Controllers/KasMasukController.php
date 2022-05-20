<?php

namespace App\Http\Controllers;

use App\Models\KasMasuk;
use Illuminate\Http\Request;
use App\Models\Kasmsk;
use Yajra\DataTables\DataTables;

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

        return view('kasmasuk.add', compact('uniqueCode'));
    }


    /**
     * Call data for cash receipts table view
     *
     * @param  \App\Models\KasMasuk  $kasMasuk
     * @return \Illuminate\Http\Response
     */
    public function getCashIn(Request $request)
    {
        // if ($request->ajax()) {
        //     $data = Kasmsk::select('*');
        //     return datatables()->of($data)
        //         ->addIndexColumn()
        //         ->addColumn('action', function ($row) {

        //             $btn = "<a href='" . URL('users/cash_list/' . $row->kasmsk) . "' class='edit btn btn-primary btn-sm m-1'><span class='material-symbols-outlined' title='Ubah'>edit_note</span></a>";
        //             $btn = $btn . "<a href='javascript:void(0)' class='edit btn btn-danger btn-sm m-1'><span class='material-symbols-outlined' title='Hapus'>delete_sweep</span></a>";

        //             return $btn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }

        // return $data;

        // return datatables()->of(\DB::table('Kasmsk')
        //     ->select('*'))
        //     ->addColumn('action', function ($row) {

        //         $btn =  '<a href="javascript:void(0)" class="btn btn-primary btn-sm m-1">Edit</a>';
        //         $btn = $btn . '<a href="javascript:void(0)" class="btn btn-danger btn-sm m-1">Delete</a>';

        //         return $btn;
        //     })
        //     ->rawColumns(['action'])
        //     ->make(true);

        return Datatables::of(Kasmsk::all())->make(true);
    }
}
