<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PosisiModel;
use App\Models\StaffModel;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = StaffModel::with('posisi')->orderBy('nama_staff', 'asc')->paginate(10);
        $data = [
            'title' => 'Staff',
            'staff' => $staff
        ];
        // return response()->json($data['staff']);
        return view('admin.staff.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Edit Staff',

            'positions' => PosisiModel::all()
        ];

        return view('admin.staff.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        StaffModel::create([
            'nama_posisi' => $request->nama_posisi,
            'posisi_id' => $request->posisi_id
        ]);
        return redirect()->route('staff.index')->with('toast_success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'title' => 'Lihat Detail Staff',
            'staff' => StaffModel::findOrFail($id),

        ];

        return view('admin.staff.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Staff',
            'staff' => StaffModel::findOrFail($id),
            'positions' => PosisiModel::all()
        ];

        return view('admin.staff.edit', $data);
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
        StaffModel::where('id', $id)->update([
            'nama_staff' => $request->nama_staff,
            'posisi_id' => $request->posisi_id
        ]);
        return redirect()->route('staff.index')->with('toast_success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StaffModel::destroy($id);
        return redirect()->route('staff.index')->with('toast_success', 'Data berhasil dihapus');
    }
}
