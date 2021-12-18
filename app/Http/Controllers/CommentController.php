<?php

namespace App\Http\Controllers;

use App\Interfaces\CommentRepo;
use App\Models\Comment;
use App\Models\Company;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show(CommentRepo $commentRepo)
    {
        try {
            $list = $commentRepo->show();
            return response()->json(['comments' => $list]);
        } catch
        (\Throwable $e) {
            return $e->getMessage();
        }

    }
}

