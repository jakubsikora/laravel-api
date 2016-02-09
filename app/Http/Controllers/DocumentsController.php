<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Document;

class DocumentsController extends Controller
{
    public function index()
    {
      return Document::all();
    }
}
