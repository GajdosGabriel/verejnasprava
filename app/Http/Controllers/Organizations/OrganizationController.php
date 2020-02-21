<?php

namespace App\Http\Controllers\Organizations;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationFormRequest;
use App\Organization;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index() {
        return view('organizations.index');
    }

    public function edit(Organization $organization, $slug) {
        return view('organizations.edit', compact('organization'));
    }

    public function orders(Organization $organization, $slug) {
        $orders = $organization->orders;
        return view('order.index', compact('orders'));
    }

    public function posts(Organization $organization, $slug) {
        $posts = $organization->posts;
        return view('post.index', compact('posts'));
    }

    public function companies(Organization $organization, $slug) {
        $companies = $organization->companies;
        return view('companies.index', compact('organization', 'companies'));
    }

    public function workers(Organization $organization, $slug) {
        $workers = $organization->workers;
        return view('workers.index', compact('organization', 'workers'));
    }

    public function postsCreate(Organization $organization, $slug) {
        return view('post.create', ['post' => new Post])->with('organization', $organization);
    }

    public function store(User $user, $name, Request $request) {
        $user->organizations()->create($request->all());
        return back();
    }

    public function update(Organization $organization, $slug, Request $request) {
        $organization->update($request->all());
        return back();
    }
}
