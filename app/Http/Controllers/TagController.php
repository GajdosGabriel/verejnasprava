<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveTagRequest;
use App\Models\Organization;
use App\Models\Tag;
use Illuminate\Http\Request;
use Str;

class TagController extends Controller
{
    public function update(Tag $tag, SaveTagRequest $saveTagRequest)
    {
        $tag->update($saveTagRequest->all());
        return $tag;
    }


    public function destroy($id)
    {
        $tag = Tag::whereId($id)->first();
        $tag->delete();
    }
}
