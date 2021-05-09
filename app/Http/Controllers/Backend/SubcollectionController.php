<?php

namespace App\Http\Controllers\Backend;

use App\Models\Label;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Subcollection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SubcollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupLabels = Label::all(); 
        $subcollections = Subcollection::with('Label')->orderBy('id','DESC')->paginate(10); 
        return view('backend.subcollections.index',compact('subcollections','groupLabels'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|unique:subcollections,title',
            'label' => 'required',
        ]);

        $subcollection = new Subcollection;

        if($request->image){
            $image = $request->image[0];
            $image_position = strpos($request->image[0], ';');
            $sub= substr($request->image[0], 0 ,$image_position);
            $image_extension =explode('/', $sub)[1];
            $image_name = Str::slug($request->title).time().".".$image_extension;
            $original_location = 'images/subcollections/original/'.$image_name;
            $resized_location = 'images/subcollections/resized/'.$image_name;
            Image::make($image)->save($original_location);
            Image::make($image)->fit(600,400)->save($resized_location);
            $subcollection->image = $image_name;
        }
        $subcollection->title = $request->title;
        $subcollection->slug = Str::slug($request->title);
        $subcollection->label_id = $request->label['id'];
        $subcollection->save();

        return Subcollection::with('Label')->get();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcollection  $subcollection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcollection $subcollection)
    {
        $this->validate($request,[
            'title' => 'required|unique:subcollections,title,'.$subcollection->id,
            'label' => 'required',
        ]);

        $subcollection->title = $request->title;
        $subcollection->slug = Str::slug($request->title);
        $subcollection->label_id = $request->label['id'];
        if($request->image){
            //Old Image Location
            $old_original_location = 'images/subcollections/original/'.$subcollection->image;
            $old_resized_location = 'images/subcollections/resized/'.$subcollection->image;
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
           $original_location = 'images/subcollections/original/'.$image_name;
           $resized_location = 'images/subcollections/resized/'.$image_name;
           Image::make($image)->save($original_location);
           Image::make($image)->fit(600,400)->save($resized_location);
           $subcollection->image = $image_name;
       }

        $subcollection->save();

        return Subcollection::with('Label')->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcollection  $subcollection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcollection $subcollection)
    {
        //
    }


    public function search($query_field,$query, Request $request){
        //if request has per_page then ok otherwise set static value 10;
        $paginate_perpage = $request->per_page ? $request->per_page : 10;
        $orderBy = $request->orderBy ? $request->orderBy : 'id';
        $orderByDir = $request->orderByDir ? $request->orderByDir : 'desc';
        return Subcollection::with('Label')->where($query_field,'LIKE',"%$query%")->orderBy($orderBy,$orderByDir)->paginate($paginate_perpage);
    }

    public function getSubcollections(Request $request){
        $paginate_perpage = $request->per_page ? $request->per_page : 10;
        $orderBy = $request->orderBy ? $request->orderBy : 'id';
        $orderByDir = $request->orderByDir ? $request->orderByDir : 'desc';
        return Subcollection::with('Label')->orderBy($orderBy,$orderByDir)->paginate($paginate_perpage);

    }
}
