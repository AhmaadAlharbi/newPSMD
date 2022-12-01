<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SignaturePadController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('signaturePad');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function upload(Request $request)
    {
        $folderPath = public_path('signatures/');

        $image_parts = explode(";base64,", $request->signed);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $user_id = auth()->user()->id;
        $file = $folderPath . $user_id . '.' . $image_type;
        file_put_contents($file, $image_base64);
        $user = User::where('id', $user_id)->first();
        $user->signature = $user_id . '.' . $image_type;
        $user->update([
            'signature' => $user_id . '.' . $image_type,
        ]);
        return back()->with('success', 'success Full upload signature');
    }
}
