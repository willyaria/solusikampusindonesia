<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instansi_m;

class Instansi extends Controller
{
    function index()
    {
        return view('home');
    }

    function datenow()
	{
		return date('Y-m-d H:i:s');
	}

    function indexInstansi()
    {
        $get_datatables = Instansi_m::select('*')
                                            ->where('active', 1)
                                            ->where('trash', 0)
                                            ->get();

        if(request()->ajax()) {
            return datatables()->of($get_datatables)
            ->addColumn('action', function($field){
                $button = '<button type="button" title="Edit" name="edit" id="'.$field->id.'" onclick="show_edit('.$field->id.','."'".$field->nama."'".','."'".$field->deskripsi."'".')" class="edit btn btn-primary btn-sm">Edit</button>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" title="Delete" name="delete" id="'.$field->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                $button .= '&nbsp;&nbsp;';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('home');
    }

    function simpanInstansi(Request $request)
    {
        $data1 = array(
            'nama'              => $request->get('ins'),
            'deskripsi'         => $request->get('des'),
            'created'           => $this->datenow()
        );
        Instansi_m::insert($data1);
    }

    function deleteInstansi($id)
    {
        $data3=array(
			'active' => 0,
			'trash' => 1
		);
		Instansi_m::where('id', $id)->update($data3);
    }
}
