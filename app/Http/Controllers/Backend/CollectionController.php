<?php

namespace App\Http\Controllers\Backend;

use App\Models\Label;
use App\Models\Collection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Subcollection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

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
        if($request->image){
            $image = $request->image[0];
            $image_position = strpos($request->image[0], ';');
            $sub= substr($request->image[0], 0 ,$image_position);
            $image_extension =explode('/', $sub)[1];
            $image_name = Str::slug($request->title).time().".".$image_extension;
            $original_location = 'images/collections/original/'.$image_name;
            $resized_location = 'images/collections/resized/'.$image_name;
            Image::make($image)->save($original_location);
            Image::make($image)->fit(600,400)->save($resized_location);
            $collection->image = $image_name;
        }
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
        
        if($request->image){
             //Old Image Location
             $old_original_location = 'images/collections/original/'.$collection->image;
             $old_resized_location = 'images/collections/resized/'.$collection->image;
             //Delete Old Image
             if (File::exists($old_original_location)) {
                 File::delete($old_original_location);
             }
             if (File::exists($old_resized_location)) {
                 File::delete($old_resized_location);
             }
            $image = $request->image[0];
            $image_position = strpos($request->image[0], ';');
            $sub= substr($request->image[0], 0 ,$image_position);
            $image_extension =explode('/', $sub)[1];
            $image_name = Str::slug($request->title).time().".".$image_extension;
            $original_location = 'images/collections/original/'.$image_name;
            $resized_location = 'images/collections/resized/'.$image_name;
            Image::make($image)->save($original_location);
            Image::make($image)->fit(600,400)->save($resized_location);
            $collection->image = $image_name;
        }

        $collection->title = $request->title;
        $collection->slug = Str::slug($request->title);
        $collection->save();

        $subcol_id = [];
        foreach($request->sub_collection as $sub){
         $subcol_id[] = ['collection_id'=> $collection->id, 'subcollection_id' =>$sub['id']];   
        }
        DB::beginTransaction();
        try {
            $collection->Subcollections()->detach();
            $collection->Subcollections()->attach($subcol_id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    
        return $collection;
  
    }

    public function show($id){
        return Collection::with('Subcollections')->findOrFail($id);
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
