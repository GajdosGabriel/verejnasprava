<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveTagRequest;
use App\Models\Organization;
use App\Models\Tag;
use Illuminate\Http\Request;
use Str;

class TagController extends Controller
{
    public function index()
    {
        return Tag::whereOrganizationId(auth()->user()->id)->get();
    }

    public function update(Tag $tag, SaveTagRequest $saveTagRequest)
    {
        $tag->update($saveTagRequest->all());
        return $tag;
    }

    public function store(SaveTagRequest $saveTagRequest)
    {
        $tag = Tag::create([
            'organization_id' => auth()->user()->active_organization,
            'name' => $saveTagRequest->input('name'),
            'slug' => Str::slug($saveTagRequest->input('name'), '-')
        ]);
        return $tag;
    }

    public function destroy($id)
    {
        $tag = Tag::whereId($id)->first();
        $tag->delete();
    }
}
