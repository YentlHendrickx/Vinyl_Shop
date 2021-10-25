<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Record;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    public function index(Request $request) {
        $genre_id = $request->input('genre_id') ?? '%';
        $artist_title = '%' . $request->input('artist') . '%';

        $records = Record::with('genre')
            ->where([
                ['artist', 'like', $artist_title],
                ['genre_id', 'like', $genre_id]
            ])
            ->orWhere([
                ['title', 'like', $artist_title],
                ['genre_id', 'like', $genre_id]
            ])
            ->paginate(12)
            ->appends(['artist'=> $request->input('artist'), 'genre_id' => $request->input('genre_id')]);


        foreach ($records as $record) {
            if(!$record->cover) {
                $record->cover = "https://coverartarchive.org/release/{$record->title_mbid}/front-250.jpg'";
            }
        }
        // short version of orderBy('name', 'asc')
        $genres = Genre::orderBy('name')->has('records')->withCount('records')->get()->transform(function ($item, $key) {
            // Set first letter of name to uppercase and add the counter
            $item->name = ucfirst($item->name) . ' (' . $item->records_count . ')';
            return $item;
        })  ->makeHidden(['created_at', 'updated_at', 'records_count']);
        $result = compact('genres', 'records');     // $result = ['genres' => $genres, 'records' => $records]
        Json::dump($result);
        return view('shop.index', $result);
    }

    public function show($id) {
        return view('shop.show', ['id' => $id]);
    }
}
