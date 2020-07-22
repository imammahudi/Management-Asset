<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use App\pic;
use App\Proyek;
use App\Asset;
use App\detil_proyek;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Requests\ImageUploadRequest;
use Doctrine\Common\Annotations\Annotation\Required;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Carbon;

class ProyekController extends Controller
{


    public function index()
    {
        $data_proyek = Proyek::all();
        return view('proyek.index', ['data_proyek' => $data_proyek]);
    }
    // public function edit()
    // {
    //     //   $data_proyek = \App\Proyek::all();
    //     return view('proyek/edit');
    // }

    public function create()
    {
        $data_pic = pic::all();

        // $data_proyek = \App\Proyek::all();
        //dd($data_asset);
        // dd($data_pic);
        return view('proyek.create', ['data_pic' => $data_pic]);
        // ['data_asset' => $data_asset]

    }

    // public function create()
    // {
    //     $data_proyek = \App\Proyek::all();
    //     return view('proyek.create', ['data_proyek' => $data_proyek]);
    //     DB::table('proyek')
    //         ->join('companies', 'companies.company_id', '=', 'id.company_id')
    //         ->get();
    // }

    // public function insert(Request $request)
    // {
    //     \App\Proyek::insert($request->all());
    //     return redirect('/proyek');
    // }

    // public function create(Request $request)
    // {
    //     $this->authorize('create', Proyek::class);
    //     $category_type = 'proyeks';
    //     return view('proyek/create')->with('category_type', $category_type)
    //         ->with('item', new Proyek);
    // }

    public function insert(Request $request)
    {

        DB::table('proyek')
            ->insert([
                'nama_proyek' => $request->nama_proyek,
                'nama_dept' => $request->nama_dept,
                'nama_pic' => $request->nama_pic,
                'nama_teknisi' => $request->nama_teknisi,
                'status' => $request->status,
                'nominal' => $request->nominal,
                'catatan' => $request->catatan,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
            ]);

        return redirect('/proyek');
    }


    public function edit($id)
    {
        $proyek = Proyek::find($id);
        return view('proyek/edit', ['proyek' => $proyek]);
    }


    public function idbaru($id)
    {
        return view('/proyek/coba');
    }

    public function update(Request $request, $id)
    {
        $proyek = Proyek::find($id);
        $proyek->update($request->all());
        return redirect('/proyek');
    }

    public function delete(Request $request)
    {
        $proyek = Proyek::find($request->id);
        $proyek->delete();

        $detail_asset = detil_proyek::where('id_proyek', $request->id)->get();

        foreach ($detail_asset as $key) {
            Asset::where('id', $key->id_asset)->update([
                'status_terpakai' => 'T'
            ]);
        }

        detil_proyek::where('id_proyek', $request->id)->delete();

        return redirect('/proyek');
    }

    public function detail(Request $request)
    {
        $data_proyek = Proyek::find($request->id);

        if ($data_proyek) {
            $data_asset = Asset::where('status_terpakai', '=', 'T')->whereNull('deleted_at')->get();

            $detail_asset = detil_proyek::select('detil_proyek.id as id', 'assets.name as name')->where('detil_proyek.id_proyek', $request->id)->join('assets', 'detil_proyek.id_asset', '=', 'assets.id')->get();
            return view('proyek.detail', ['data_asset' => $data_asset, 'data_proyek' => $data_proyek, 'detail_asset' => $detail_asset]);
        } else {
            abort(404);
        }
    }

    public function lihat_asset(Request $request)
    {
        $detil_asset = detil_proyek::find($request->id);
        if ($detil_asset) {
            $id_asset = $detil_asset->id_asset;
            $data_assets = detil_proyek::select('assets.name as nama', 'assets.asset_tag as tag', 'assets.serial as serial', 'assets.notes as note', 'assets.purchase_date as purchase_date', 'assets.purchase_cost as purchase_cost', 'assets.order_number as number')->join('assets', 'detil_proyek.id_asset', '=', 'assets.id')->where('detil_proyek.id_asset', '=', $id_asset)->get();
            return view('proyek/detil_asset', ['detil_asset' => $detil_asset, 'data_assets' => $data_assets]);
        } else {
            abort(404);
        }
    }

    public function insert_asset(Request $request)
    {
        for ($i = 0; $i < count($request->id_asset); $i++) {

            detil_proyek::create([
                'id_proyek' => $request->id,
                'id_asset' => $request->id_asset[$i]
            ]);

            Asset::where('id', $request->id_asset[$i])->update([
                'status_terpakai' => 'A'
            ]);
        }

        return redirect('/proyek/' . $request->id . '/detail');
    }
    public function hapus(Request $request)
    {
        $detail_asset = detil_proyek::find($request->id);

        $id_proyek = $detail_asset->id_proyek;
        $id_asset = $detail_asset->id_asset;

        Asset::where('id', $id_asset)->update([
            'status_terpakai' => 'T'
        ]);

        $detail_asset->delete();
        return redirect('/proyek/' . $id_proyek . '/detail');
    }

    // function report
    public function indexreport()
    {
        $data_proyek = Proyek::all();
        return view('reports.proyek', ['data_proyek' => $data_proyek]);
    }


    public function exportPdf(Request $request)
    {


        $detil_assetpdf = detil_proyek::find($request->id);
        $detil_assetpdf1 = proyek::find($request->id);
        $tes = $detil_assetpdf1->id;
        if ($detil_assetpdf) {
            $detail_asset = detil_proyek::select('detil_proyek.id as id', 'assets.name as name', 'assets.asset_tag as tag', 'assets.serial as serial', 'assets.notes as note', 'assets.purchase_date as purchase_date', 'assets.purchase_cost as purchase_cost', 'assets.order_number as number', 'proyek.nama_proyek as nama_proyek', 'proyek.nama_dept as nama_dept', 'proyek.nama_pic as nama_pic', 'proyek.nama_teknisi as nama_teknisi')->where('detil_proyek.id_proyek', '=', $tes)->join('assets', 'detil_proyek.id_asset', '=', 'assets.id')->join('proyek', 'detil_proyek.id_proyek', '=', 'proyek.id')->get();
            $pdf = PDF::loadView('print', ['detil_asset' => $detil_assetpdf, 'detail_asset' => $detail_asset, 'data_proyek' => $detail_asset])->setPaper('a4', 'portrait');
            // $filename = $data_proyek->nama_proyek;
            return $pdf->stream('print.pdf');
            // return view('proyek/detil_asset', ['detil_asset' => $detil_assetpdf, 'data_assets' => $data_assets]);
        } else {
            abort(404);
        }
    }
}
