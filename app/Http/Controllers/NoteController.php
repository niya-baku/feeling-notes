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

    /**
     * 写真一覧
     */
    public function index()
    {
        $notes = Note::with(['user'])->orderBy(Note::CREATED_AT, 'desc')->paginate();
        return $notes;
    }

    public function show($id)
    {
        $note = Note::where('id', $id)->with(['user'])->first();

        return $note ?? abort(404);
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
        
        return response($note, 201);
    }

    public function update(Request $request, $id){
        $note = Note::find($id);
    
        $note->wake_uptime = $request->wake_uptime; //起床時間の取得
        $note->bedtime = $request->bedtime; //就寝時間の取得
        $note->am_image = $request->am_image; //午前の調子値 
        $note->pm_image = $request->pm_image; //午後の調子値
        $note->night_image = $request->night_image; //夜の調子値
        $note->body = $request->body; //テキスト取得
            //$note->bedtime = $request->bedtime; 画像データ取得 
            
        $note->save();
        return $note ?? abort(404);
    }

    public function delete(Request $request, $id)
    {
        Note::find($id)->delete();

        return response(200);
    }
}
