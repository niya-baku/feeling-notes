<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNote;
use App\Note;


class NoteController extends Controller
{
    public function __construct()
    {
        // 認証が必要
        $this->middleware('auth');
    }

    public function create(StoreNote $request){

        $note = new Note();
        
        $note->record = $request->record; //日付取得
        $note->wake_uptime = $request->wake_uptime; //起床時間の取得
        $note->bedtime = $request->bedtime; //就寝時間の取得
        $note->am_image = $request->iconId_1; //午前の調子値 
        $note->pm_image = $request->iconId_2; //午後の調子値
        $note->night_image = $request->iconId_3; //夜の調子値
        $note->body = $request->body; //テキスト取得
        //$note->bedtime = $request->bedtime; 画像データ取得 
        $note->user_id = $request->user()->id;
        
        $note->save();
        //dd($note);
        
        return response($note, 201);
    }
}
