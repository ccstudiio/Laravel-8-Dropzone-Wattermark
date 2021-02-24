<?php

namespace App\Http\Controllers;

use App\Models\WaterMark;
use Illuminate\Http\Request;
use App\Models\ImageUpload;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class ImageUploadController extends Controller
{

    protected $photos_path;

    /**
     * ImageUploadController constructor.
     */
    public function __construct()
    {
        $this->photos_path = public_path('images');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function fileCreate()
    {
        $watermark = WaterMark::all();
        $photos = ImageUpload::all();
        return view('imageupload')->with('photos', $photos)->with('watermark',$watermark);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fileStore(Request $request)
    {
        $image = $request->file('file');
        // Get the image, and make it using Image Intervention
        $waterMarkUrl = $this->photos_path  . '/' . 'watermark.png';
        $image_Name = $image->getClientOriginalName();
        Image::make($image)->resize(1200, null,
            function ($constraints)
            {$constraints->aspectRatio();
            })->insert($waterMarkUrl, 'center')
            ->save($this->photos_path . '/' . $image_Name);
        //$image->move($this->photos_path,$image_Name);
        // Insert in to database
        $imageUP = new ImageUpload();
        $imageUP->filename = $image_Name;
        $imageUP->save();
        return response()->json(['success'=>$image_Name]);

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function imagesShow(){
        $photos = ImageUpload::all();
        return view('show')->with('photos', $photos);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function imageUploadWatermark(Request $request){

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = 'watermark'.'.'.$request->image->extension();
        $request->image->move($this->photos_path, $imageName);
        $watermark = new WaterMark();
        $watermark->truncate();
        $watermark->watermark = $imageName;
        $watermark->active = 1;
        $watermark->save();
        /* Store $imageName name in DATABASE from HERE */
        return back()
            ->with('success','Você enviou com sucesso a Marca D´agua.')
            ->with('image',$imageName);
    }

    /**
     * @param Request $request
     * @param $filename
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function fileDestroy(Request $request, $filename)
    {
        //$filename =  $request->get('filename');
        ImageUpload::where('filename', $filename)->delete();
        $path= public_path().'/images/'. $filename;

        if (file_exists($path)) {
            unlink($path);
        }
        $photos = ImageUpload::all();
        return view('show')->with('photos', $photos);
    }
}
