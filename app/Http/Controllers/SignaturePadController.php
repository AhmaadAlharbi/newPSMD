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
        $user_id = auth()->user()->id;

        $data_uri = $request->signed;
        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);
        $user_id = auth()->user()->id;
        $file = $folderPath . $user_id . '.png';
        file_put_contents($file, $decoded_image);
        $user = User::where('id', $user_id)->first();
        $user->signature = $user_id  . '.png';
        $user->update([
            'signature' => $user_id  . '.png',
        ]);

        if (auth()->user()->is_admin == 1) {
            return redirect('dashboard/admin/query_section_id=' . auth()->user()->section_id)->with('success', 'تم اضافة توقيعك بنجاح');
        } else {
            return redirect('dashboard/user/query_section_id=' . auth()->user()->section_id)->with('success', 'تم اضافة توقيعك بنجاح');
        }
    }
}
