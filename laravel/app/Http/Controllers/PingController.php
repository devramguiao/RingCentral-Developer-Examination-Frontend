<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PingCollection;
use App\Ping;

class PingController extends Controller
{
    public function store(Request $request)
    {
      $ping = new Ping([
        'currentDateTime' => $request->get('currentDateTime'),
        'httpResponse' => $request->get('httpResponse')
      ]);

      $ping->save();

      return response()->json('success');
    }

    public function index()
    {
      return new PingCollection(Ping::all());
    }
}
