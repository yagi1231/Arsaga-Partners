<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Reservation;

class ReservationController extends Controller
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
        $reservations = Reservation::where('status',1)->orderByRaw("time, backtime ASC")->where(function ($query) {
            if ($search = request('date-search')) {
                $query->where('time', 'LIKE', "%{$search}%")
                ;
               }
        })->where(function ($quer) {
            if ($search = request('search')) {
            $quer-> Where('name','LIKE',"%{$search}%")->orWhere('address','LIKE',"%{$search}%")
                ;
            }
        })->paginate(5);
        return view('/reservations/index',compact('reservations'));
    }

    public function create(Request $request)
    {
        $reservation_name = $request->input('name');
        $reservation_address = $request->input('address');
        $reservation_telnum = $request->input('telnum'); 
        $reservation_remarks = $request->input('remarks');//バリデーションエラー解決のため al()ではcreateでエラーが発生
        return view('reservations/create',compact('reservation_name', 'reservation_address', 'reservation_telnum' ,'reservation_remarks'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $image = $request->file('image');
        // 画像がアップロードされていれば、storageに保存
        if($request->hasFile('image')){
            $path = \Storage::put('/public', $image);
            $path = explode('/', $path);
        }else{
            $path = null;
        }
        $this->validate($request, [
            'name' => ['required', 'string'],
            'address' => ['required'],
            'telnum' => 'required| numeric | digits_between:10,11',
            'order' => ['required', 'string'],
            'sumprice' => ['required', 'string'],
            'time' => ['required', 'string'],
            'backtime' => ['required', 'string'],
            'category' => ['required', 'string'],
            'categoryname' => ['required', 'string'],
        ], [
            'name.required' => '名前は必須です。',
            'address.required' =>  '住所は必須です。',
            'telnum.required' => '電話番号は必須です。',
            'time.required' =>  '日付は必須です。',
            'backtime.required' => '時間は必須です。',
            'category.required' =>  'カテゴリーは必須です。',
            'categoryname.required' => '企業or民家は必須です。',
            'order.required' =>  '注文は必須です。',
            'sumprice.required' =>  '合計金額は必須です。',
        ]);

        $reservations = Reservation::insertGetId([
             'name' => $data['name'],
             'address' => $data['address'], 
             'telnum' => $data['telnum'],
             'remarks' => $data['remarks'], 
             'time' => $data['time'],
             'backtime' => $data['backtime'], 
             'category' => $data['category'],
             'categoryname' => $data['categoryname'], 
             'order' => $data['order'], 
             'image' => $path[1],
             'price' => $data['price'],
             'task' => $data['task'],
             'sumprice' => $data['sumprice'],
             'status' => 1
        ]);
        
        return redirect('/reservations/index')->with('success', '作成完了');
    }

    public function show($id){
        
        $reservation = Reservation::where('status', 1)->where('id', $id)->first();
        if ($reservation === null) {
            abort(404);
        }
        return view('reservations/show',compact('reservation'));
    }

    public function edit($id){
        $reservation = Reservation::where('status', 1)->where('id', $id)->first();
        return view('reservations/edit',compact('reservation'));
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        $image = $request->file('image');
        if($request->hasFile('image')){
            $path = \Storage::put('/public', $image);
            $path = explode('/', $path);
        }else{
            $path = null;
        }
       $this->validate($request, [
            'name' => ['required', 'string'],
            'address' => ['required'],
            'telnum' => 'required|regex:/\A0[5789]0[-]?\d{4}[-]?\d{4}\z/',
            'order' => ['required', 'string'],
            'sumprice' => ['required', 'string'],
            'time' => ['required', 'string'],
            'backtime' => ['required', 'string'],
            'category' => ['required', 'string'],
            'categoryname' => ['required', 'string'],
        ], [
            'name.required' => '名前は必須です。',
            'address.required' =>  '住所は必須です。',
            'telnum.required' => '電話番号は必須です。',
            'time.required' =>  '日付は必須です。',
            'backtime.required' => '時間は必須です。',
            'category.required' =>  'カテゴリーは必須です。',
            'categoryname.required' => '企業or民家は必須です。',
            'order.required' =>  '注文は必須です。',
            'sumprice.required' =>  '合計金額は必須です。',
        ]);

        Reservation::where('id', $id)->update([
            'name' => $inputs['name'],
            'address' => $inputs['address'], 
            'telnum' => $inputs['telnum'],
            'remarks' => $inputs['remarks'], 
            'time' => $inputs['time'],
            'backtime' => $inputs['backtime'], 
            'category' => $inputs['category'],
            'categoryname' => $inputs['categoryname'], 
            'delivery' => $inputs['delivery'],
            'task' => $inputs['task'],
            'price' => $inputs['price'],
            'image' => $path[1],
            'sumprice' => $inputs['sumprice'],
            'status' => 1
       ]);
        return redirect('/reservations/index')->with('success', '更新完了');
    }

    public function delete(Request $request, $id)
    {
        $inputs = $request->all();
        // 論理削除なので、status=2
        Reservation::where('id', $id)->update([ 'status' => 2 ]);
        // ↓は物理削除
        // Info::where('id', $id)->delete();

        return redirect('/reservations/index')->with('success', '削除完了');
    }

    public function sum_sale()
    {
        $reservation = new Reservation();
        $results = $reservation->daySumAmount();//モデルから関数よびだし
        return view('reservations/sales/sum_sale', compact('results'));
    }

    public function ave_sale()
    {
        $this->reservations = new Reservation();
        $results = $this->reservations->dayAveAmount();
        return view('reservations/sales/ave_sale', compact('results'));
    }

    public function month_ave_sale()
    {
        $this->reservations = new Reservation();
        $results = $this->reservations->monthAveAmount();
        return view('reservations/sales/month_ave_sale', compact('results'));
    }

    public function month_sum_sale()
    {
        $this->reservations = new Reservation();
        $results = $this->reservations->monthSumAmount();
        return view('reservations/sales/month_sum_sale', compact('results'));
    }
}
