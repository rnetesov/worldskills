<?php

namespace App\Http\Controllers;

use App\Entities\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return view('reviews.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required|string|max:1000',
        ]);

        Review::create([
            'comment' => $request['comment'],
            'user_id' => \Auth::id()
        ]);

        return redirect()->route('reviews.index')->with('success', 'Ваш отзыв был успешно отправлен');
    }


}
