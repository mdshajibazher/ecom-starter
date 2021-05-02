<?php

namespace App\Http\Controllers\Backend;

use App\Models\Label;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LabelController extends Controller
{
    public function index(){
        $groupLabels = Label::orderBy('id','DESC')->paginate(10);
        return view('backend.labels.index',compact('groupLabels'));
    }

    public function store(Request $requst){
        $this->validate($requst,[
            'title' => 'required'
        ]);
        $label = new Label;
        $label->title = $requst->title;
        $label->save();
        return Label::all();
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'title' => 'required'
        ]);
        $label = Label::findOrFail($id);
        $label->title = $request->title;
        $label->save();
        return $label;
    }

    public function search($query_field,$query, Request $request){
        //if request has per_page then ok otherwise set static value 10;
        $paginate_perpage = $request->per_page ? $request->per_page : 10;
        $orderBy = $request->orderBy ? $request->orderBy : 'id';
        $orderByDir = $request->orderByDir ? $request->orderByDir : 'desc';
        return Label::where($query_field,'LIKE',"%$query%")->orderBy($orderBy,$orderByDir)->paginate($paginate_perpage);
    }

    public function getLabels(Request $request){
        $paginate_perpage = $request->per_page ? $request->per_page : 10;
        $orderBy = $request->orderBy ? $request->orderBy : 'id';
        $orderByDir = $request->orderByDir ? $request->orderByDir : 'desc';
        return Label::orderBy($orderBy,$orderByDir)->paginate($paginate_perpage);

    }

}
