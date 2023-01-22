<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HackerNewsItem;

class HackerNewsItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $item = new HackerNewsItem;
        return $item->orderBy('post_id', 'ASC')
                    ->where('post_id', '>=', $request->data['start'])
                    ->where('is_deleted', '!=', 1)
                    ->limit($request->data['limit'])
                    ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newItem = new HackerNewsItem;

        $isExisting = $newItem->where('title', '=', $request->item['title'])->get();

        if (!count($isExisting)) {
            $newItem->post_id = $request->item["rank"];
            $newItem->title = $request->item["title"];
            $newItem->link = $request->item["link"];
            $newItem->points = $request->item["points"];
            $newItem->post_created_at = $request->item["post_created_at"];
            $newItem->save();
        }
    }

    /**
     * Delete all items
     * @return void
     */
    public function deleteAll()
    {
        $itemCollection = new HackerNewsItem;
        $itemCollection->where('is_deleted', '!=', '1')->each(function ($item, $key) {
            $item->delete();
        });
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hackerNewsItem = new HackerNewsItem;
        $existingItem = $hackerNewsItem->where('post_id', '=', $id)->first();

        if ($existingItem) {
            $existingItem->is_deleted = 1;
            $existingItem->save();

            return $existingItem;
        }

        return "Item not found!";
    }
}
