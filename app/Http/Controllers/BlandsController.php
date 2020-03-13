<?php

namespace App\Http\Controllers;

use App\Models\Bland;
use Illuminate\Http\Request;

class BlandsController extends Controller
{
    /**
     * 銘柄の削除
     */
    public function delete($id)
    {
        Bland::find($id)->delete(); //softDelete

        return redirect()->to('/login');
    }
}
