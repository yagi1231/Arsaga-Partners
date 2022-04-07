<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Info;

class InfoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos = Info::where('status',1)->orderBy('name','ASC')->where(function ($query) {
            if ($search = request('search')) {
                $query->where('name', 'LIKE', "%{$search}%")->orWhere('address','LIKE',"%{$search}%")->orWhere('telnum','LIKE',"%{$search}%")
                ;
            }
            
        })->paginate(5);
        return view('infos/index',compact('infos'));
    }

    public function create()
    {
        return view('infos/create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $this->validate($request, [
            'name' => ['required', 'string'],
            'address' => ['required'],
            'telnum' => 'required|regex:/\A0[5789]0[-]?\d{4}[-]?\d{4}\z/',
        ], [
            'name.required' => '名前は必須です。',
            'address.required' =>  '住所は必須です。',
            'telnum.required' => '電話番号は必須です。',
        ]);
    
        $infos = Info::insertGetId([
             'name' => $data['name'],
             'address' => $data['address'], 
             'telnum' => $data['telnum'],
             'remarks' => $data['remarks'], 
             'status' => 1
        ]);
        
      
        return redirect()->route('infos/show', ['id' => $infos])->with('success', '作成完了');
    }

    public function show($id){

        $info = Info::where('status', 1)->where('id', $id)->first();
        if ($info === null) {
            abort(404);
        }

        return view('infos/show',compact('info'));
    }

    public function edit($id){

        $info = Info::where('status', 1)->where('id', $id)->first();

        return view('infos/edit',compact('info'));
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->all();


        $this->validate($request, [
            'name' => ['required', 'string'],
            'address' => ['required'],
            'telnum' => 'required|regex:/\A0[5789]0[-]?\d{4}[-]?\d{4}\z/',
        ], [
            'name.required' => '名前は必須です。',
            'address.required' =>  '住所は必須です。',
            'telnum.required' => '電話番号は必須です。',
        ]);
     
        Info::where('id', $id)->update([
            'name' => $inputs['name'],
            'address' => $inputs['address'], 
            'telnum' => $inputs['telnum'],
            'remarks' => $inputs['remarks'], 

            'status' => 1
       ]);
        return redirect('/infos/index')->with('success', '更新完了');
    }

    public function delete(Request $request, $id)
    {
        $inputs = $request->all();
        
        Info::where('id', $id)->update([ 'status' => 2 ]);

        return redirect('/infos/index')->with('success', '削除完了');
    }
}
