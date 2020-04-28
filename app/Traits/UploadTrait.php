<?php

namespace App\Traits;



use Illuminate\Http\Request;

trait UploadTrait
{
    /**
     * @param Request $request
     * @param string $folder
     * @return false|string
     */
    public function uploadOne(Request $request, $folder = 'storage/uploads/images')
    {
        // Get image file
        $image = $request->file('image');
        // Create file name
        $fileName = Auth()->user()->name . '_' . time() . '.' . $image->getClientOriginalExtension();
        // Upload image
        return $image->storeAs($folder, $fileName, 'public');
    }
}
