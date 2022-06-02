<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Helper\Helper;
use App\Models\KasMasuk;
use App\Models\Supplier;
use App\Models\Oppenent;
use App\Models\Customer;
use App\Models\Kasmsk1;
use App\Models\Cekmsk;
use App\Models\TemporaryEditKasMasuk;
use App\Models\TemporaryStorageKasMasuk;
use App\Models\TemporaryStorageCekMasuk;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Kasmsk;
use App\Models\TemporaryEditCekMasuk;
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
        $kasmskUnique = Helper::generateKasMsk();

        $uniqueCode = Helper::generateId();

        try {
            Kasmsk::create([
                'tgl'       => $request->dateToday,
                'kasmsk'    => $kasmskUnique,
                'nobukti'   => $uniqueCode,
                'subket'    => $request->accepted,
                'ket'       => $request->description,
                'lastusr'   => 0,
                'status'    => 0,
            ]);

            return redirect()->back();
        } catch (\Throwable $th) {

            return $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KasMasuk  $kasMasuk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $descryptID = Crypt::decryptString($id);

        $kasmskTable = Kasmsk::where('kasmsk', $descryptID)->first();

        $oppenents = Oppenent::all();

        return view('kasmasuk.edit', compact('kasmskTable', 'oppenents'));
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

    public function addCashIn()
    {
        $uniqueCode = Helper::generateId();

        $oppenents = Oppenent::all();

        $cash = Kas::all();

        return view('kasmasuk.add', compact('uniqueCode', 'oppenents', 'cash'));
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
                $btn = "<a href='" . URL('users/cash_list/' . Crypt::encryptString($row->kasmsk)) . "' class='btn btn-primary btn-sm'><i class='fas fa-edit'></i></a>";
                $btn = $btn . "<a href='" . URL('/users/info/cash_in/' . Crypt::encryptString($row->kasmsk)) . "' class='btn btn-secondary btn-sm ml-1'><i class='fas fa-eye'></i></a>";
                $btn = $btn . "<a class='delete btn btn-danger btn-sm ml-1' name='" . $row->kasmsk . "' data-id='" . $row->kasmsk . "' data-toggle='modal' data-target='#exampleModal'><i class='fas fa-trash'></i></a>";

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
                'id_opponent'   => $request->push_opponent,
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

                $btn = "<a href='" . URL('users/cash_list/' . $row->kasmsk) . "' class='btn btn-danger btn-sm' title='Hapus'><i class='fas fa-trash-alt fa-sm text-white-20'></i></a>";

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Save data to temporary_storage_cek_masuks
     *
     * @param  \App\Models\TemporaryStorageCekMasuk
     * @return \Illuminate\Http\Response
     */
    public function postCekMasuk(Request $request)
    {
        try {
            TemporaryStorageCekMasuk::create([
                'id_users'      => Auth::user()->id,
                'cash_bank'     => $request->cash_bank,
                'giro_number'   => $request->giro_number,
                'liquid_date'   => $request->liquid_date,
                'currency'      => $request->currency,
                'value'         => $request->value,
                'description'   => $request->description,
            ]);

            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;

            return $th->getMessage();
        }
    }

    /**
     * Get and push data to view  add
     *
     * @param  \App\Models\TemporaryStorageCekMasuk
     * @return \Illuminate\Http\Response
     */
    public function getCekMasuk()
    {
        return Datatables::of(TemporaryStorageCekMasuk::all())
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = "<a href='" . URL('users/cash_list/' . $row->kasmsk) . "' class='btn btn-danger btn-sm' title='Hapus'><i class='fas fa-trash-alt fa-sm text-white-20'></i></a>";

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Get and push data to view  add
     *
     * @param  \App\Models\TemporaryStorageCekMasuk
     * @return \Illuminate\Http\Response
     */
    public function postAllRequest(Request $request)
    {

        // Generate unique code 
        $items = Kasmsk::latest('id')->first();

        $yearsMonth = date('Y');

        if (!$items) {
            $numberEvidence = "KM/" . substr($yearsMonth, -2) . date('m') . "/0001";

            // kasmsk unique code
            $kasmskUnique = "KM000001";
        } else {
            // get last record

            $characters = substr($items->nobukti, -4) + 1;
            $path_characters = sprintf("%04d", $characters);
            $numberEvidence = "KM/" . substr($yearsMonth, -2) . date('m') . "/" . $path_characters;

            // kasmsk unique code
            $item_kasMasuk = substr($items->kasmsk, -4) + 1;
            $path_kas = sprintf("%06d", $item_kasMasuk);
            $kasmskUnique = "KM" . $path_kas;
        }

        try {
            // save data to table kasmsk
            Kasmsk::create([
                'kasmsk'        => $kasmskUnique,
                'tgl'           => $request->dateToday,
                'nobukti'       => $numberEvidence,
                'status'        => 0,
                'subket'        => $request->accepted,
                'ket'           => $request->description,
            ]);

            $temporaryKasMasuk = TemporaryStorageKasMasuk::where('id_users', Auth::user()->id)->get();

            foreach ($temporaryKasMasuk as $item) {
                // save data to table kasmsk1 one by one item from temporary storage kas masuk
                $oppenents = Oppenent::where('oppenent_name', $item->table_name)
                    // ->select('table_name')
                    ->get();

                $itemTableOppenent = Db::table($oppenents[0]->table_name)
                    ->where('id', $item->id_opponent)
                    ->select($oppenents[0]->table_name, 'nama')
                    ->get();

                $itemPlace = $oppenents[0]->table_name;

                Kasmsk1::create([
                    'kasmsk'        => $kasmskUnique,
                    'baris'         => '0',
                    'gollawan'      => $oppenents[0]->oppenent_name,
                    'lawan'         => $itemTableOppenent[0]->$itemPlace,
                    'ref'           => '',
                    'cur'           => $item->currency,
                    'nil'           => $item->value,
                    'ket'           => $item->description,
                ]);
            }

            $temporaryCekMasuk = TemporaryStorageCekMasuk::where('id_users', Auth::user()->id)->get();

            foreach ($temporaryCekMasuk as $key => $item) {
                Cekmsk::create([
                    'kasmsk'        => $kasmskUnique,
                    'baris'         => 0,
                    'kas'           => $temporaryCekMasuk[$key]->cash_bank,
                    'giro'          => $temporaryCekMasuk[$key]->giro_number,
                    'tglcair'       => $temporaryCekMasuk[$key]->liquid_date,
                    'cur'           => $temporaryCekMasuk[$key]->currency,
                    'nil'           => $temporaryCekMasuk[$key]->value,
                    'ket'           => $temporaryCekMasuk[$key]->description,
                ]);
            }

            TemporaryStorageKasMasuk::where('id_users', Auth::user()->id)->delete();
            TemporaryStorageCekMasuk::where('id_users', Auth::user()->id)->delete();

            return redirect('/users/add_cash_in');
        } catch (\Throwable $th) {
            //throw $th;

            return $th->getMessage();
        }
    }

    /**
     * Push data from kasmasukcontroller to view.blade.php
     *
     * @param  \App\Models\Kasmsk
     * @parm    \App\Models\Kasmsk1
     * @param   \App\Models\Cekmsk
     * @return \Illuminate\Http\Response
     */
    public function getDetail(Request $request, $id)
    {
        $kasmskID = Crypt::decryptString($id);

        $kasMsk = Kasmsk::where('kasmsk', $kasmskID)->get();

        return view('kasmasuk.detail', compact('kasMsk'));
    }

    public function getFirstDetail($id)
    {
        $kasmskID = Crypt::decryptString($id);

        return Datatables::of(Kasmsk1::where('kasmsk', $kasmskID))
            ->make(true);
    }

    public function getSecondDetail($id)
    {
        $kasmskID = Crypt::decryptString($id);

        return Datatables::of(Cekmsk::where('kasmsk', $kasmskID))
            ->make(true);
    }

    /**
     * Delete kasmsk with id
     *
     * @param  \App\Models\Kasmsk
     * @return \Illuminate\Http\Response
     */
    public function deleteKasMsk($id)
    {
        try {
            Kasmsk::where('kasmsk', $id)->delete();
            Kasmsk1::where('kasmsk', $id)->delete();
            Cekmsk::where('kasmsk', $id)->delete();

            return response()->json(['status' => true, "redirect_url" => url('/users/cash_list')]);
        } catch (\Throwable $th) {
            //throw $th;

            return $th->getMessage();
        }
    }

    /**
     * Push data to view edit (detail)
     *
     * @param  \App\Models\Kasmsk1
     * @return \Illuminate\Http\Response
     */
    public function getEditFirstDetail($id)
    {
        $kasmskID = Crypt::decryptString($id);

        return Datatables::of(Kasmsk1::where('kasmsk', $kasmskID))
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = "<a class='delete_first btn btn-danger btn-sm ml-1' name='" . $row->id . "' data-id='" . $row->id . "' data-toggle='modal' data-target='#exampleModal'><i class='fas fa-trash'></i></a>";

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Push data to view edit (detail)
     *
     * @param  \App\Models\Cekmsk
     * @return \Illuminate\Http\Response
     */
    public function getEditSecondDetail($id)
    {
        $kasmskID = Crypt::decryptString($id);

        return Datatables::of(Cekmsk::where('kasmsk', $kasmskID))
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = "<a class='delete btn btn-danger btn-sm ml-1' name='" . $row->id . "' data-id='" . $row->id . "' data-toggle='modal' data-target='#exampleModal'><i class='fas fa-trash'></i></a>";

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * delete field from table kasmsk1 from page edit cash in
     *
     * @param  \App\Models\Kasmsk
     * @return \Illuminate\Http\Response
     */
    public function delKasMsk1(Request $request, $id)
    {
        try {
            Kasmsk1::where('id', $id)->delete();

            return response()->json(['status' => true, "redirect_url" => url('/users/cash_list/' . $request->urlPath)]);
        } catch (\Throwable $th) {
            //throw $th;

            return $th->getMessage();
        }
    }

    /**
     * delete field from table kasmsk1 from page edit cash in
     *
     * @param  \App\Models\Kasmsk
     * @return \Illuminate\Http\Response
     */
    public function push_temp_kasmsk_edit(Request $request)
    {
        try {
            TemporaryEditKasMasuk::create([
                'id_users'      => Auth::user()->id,
                'id_opponent'   => $request->push_opponent,
                'no_ref'        => $request->no_ref,
                'name_opponent' => $request->push_opponent_hidden,
                // Perbedaan table name dan value dari select option 
                'table_name'    => $request->opponent,
                'currency'      => $request->currency,
                'value'         => $request->value,
                'description'   => $request->description,
            ]);

            return redirect('/users/cash_list/');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    /**
     * get data from temp table edit kas masuk
     *
     * @param  \App\Models\TemporaryEditKasMasuk
     * @return \Illuminate\Http\Response
     */
    public function get_temp_edit_kasmsk()
    {
        return Datatables::of(TemporaryEditKasMasuk::where('id_users', Auth::user()->id))
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = "<a class='delete btn btn-danger btn-sm ml-1' name='" . $row->id . "' data-id='" . $row->id . "' data-toggle='modal' data-target='#exampleModal'><i class='fas fa-trash'></i></a>";

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * get data from temp table edit cek masuk
     *
     * @param  \App\Models\TemporaryEditKasMasuk
     * @return \Illuminate\Http\Response
     */
    public function get_temp_edit_cekmsk()
    {
        return Datatables::of(TemporaryEditCekMasuk::where('id_users', Auth::user()->id))
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = "<a class='delete btn btn-danger btn-sm ml-1' name='" . $row->id . "' data-id='" . $row->id . "' data-toggle='modal' data-target='#exampleModal'><i class='fas fa-trash'></i></a>";

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * push to temp edit cekmsk from edit view
     *
     * @param  \App\Models\Kasmsk
     * @return \Illuminate\Http\Response
     */
    public function push_temp_cekmsk_edit(Request $request)
    {
        try {
            TemporaryEditCekMasuk::create([
                'id_users'      => Auth::user()->id,
                'cash_bank'     => $request->cash_bank,
                'giro_number'   => $request->giro_number,
                'liquid_date'   => $request->liquid_date,
                'currency'      => $request->currency,
                'value'         => $request->value,
                'description'   => $request->description,
            ]);

            return redirect('/users/cash_list/');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    /**
     * general save function for save all edit page
     *
     * @param  \App\Models\Kasmsk
     * @return \Illuminate\Http\Response
     */
    public function general_edit_cash_in(Request $request, $id, $kasmsk)
    {
        try {
            Kasmsk::where('id', $id)->update([
                ''
            ]);

            // return redirect('/users/cash_list/');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
}
