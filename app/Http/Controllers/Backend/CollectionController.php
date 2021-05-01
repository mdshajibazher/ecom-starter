<?php

namespace App\Http\Controllers\Backend;

use App\Models\Label;
use App\Models\Collection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Subcollection;
use App\Http\Controllers\Controller;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $groupLabels = Label::all(); 
        $subcollection = Subcollection::all(); 
        $collections =  Collection::with('Subcollections')->orderBy('id','DESC')->paginate(10);
        return view('backend.collections.index',compact('collections','groupLabels','subcollection'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:collections',
            'sub_collection' => 'required',
        ]);

        $collection = new Collection;
        $collection->title = $request->title;
        $collection->slug = Str::slug($request->title);
        $collection->save();

        $subcol_id = [];
        foreach($request->sub_collection as $sub){
         $subcol_id[] = ['collection_id'=> $collection->id, 'subcollection_id' =>$sub['id']];   
        }

        $collection->Subcollections()->attach($subcol_id);
        return $collection;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        $this->validate($request, [
            'title' => 'required|unique:collections,title,'.$collection->id,
            'sub_collection' => 'required',
        ]);

        $collection->title = $request->title;
        $collection->slug = Str::slug($request->title);
        $collection->save();

        $subcol_id = [];
        foreach($request->sub_collection as $sub){
         $subcol_id[] = ['collection_id'=> $collection->id, 'subcollection_id' =>$sub['id']];   
        }

        $collection->Subcollections()->sync($subcol_id);
        return $collection;
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        //
    }


    public function search($query_field,$query, Request $request){
        //if request has per_page then ok otherwise set static value 10;
        $paginate_perpage = $request->per_page ? $request->per_page : 10;
        $orderBy = $request->orderBy ? $request->orderBy : 'id';
        $orderByDir = $request->orderByDir ? $request->orderByDir : 'desc';
        return Collection::with('Subcollections')->where($query_field,'LIKE',"%$query%")->orderBy($orderBy,$orderByDir)->paginate($paginate_perpage);
    }

    public function getCollection(Request $request){
        $paginate_perpage = $request->per_page ? $request->per_page : 10;
        $orderBy = $request->orderBy ? $request->orderBy : 'id';
        $orderByDir = $request->orderByDir ? $request->orderByDir : 'desc';
        return Collection::with('Subcollections')->orderBy($orderBy,$orderByDir)->paginate($paginate_perpage);

    }
}
