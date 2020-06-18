<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Column;

class ColumnController extends Controller
{
    public function __construct()
    {
        // 認証が必要
        $this->middleware('auth');
    }
    /**
     * ノート一覧
     */
    public function index()
    {
        $user_id = Auth::id();
        //$notes = Note::with(['user'])->orderBy(Note::CREATED_AT, 'desc')->paginate();
        $notes = Column::where('user_id',$user_id)->orderBy('id', 'desc')->paginate();
        return $notes;
    }

    public function create(Request $request){

        $column = new Column();

        $column->situation = $request->situation; //日付取得
        $column->feeling = $request->feeling; //起床時間の取得
        $column->think = $request->think; //就寝時間の取得
        $column->another_think = $request->another_think; //午前の調子値 
        $column->another_feeling = $request->another_feeling; //午後の調子値
        $column->user_id = $request->user()->id;
        
        $column->save();
        
        return response($note, 201);
    }
}
