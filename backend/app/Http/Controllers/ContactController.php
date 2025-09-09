<?php

namespace App\Http\Controllers;

use App\Repositories\JsonContactRepository;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $repo;

    public function __construct()
    {
        $this->repo = new \App\Repositories\JsonContactRepository();
    }
    

    public function index() {
        return response()->json($this->repo->all());
    }

    public function show($id) {
        $c = $this->repo->find($id);
        return $c ? response()->json($c) : response()->json(['message'=>'Not found'],404);
    }

    public function store(Request $r) {
        $data = $r->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:190',
        ]);
        $c = $this->repo->create($data);
        return response()->json($c,201);
    }

    public function update(Request $r, $id) {
        $data = $r->validate([
            'first_name' => 'sometimes|string|max:100',
            'last_name'  => 'sometimes|string|max:100',
            'email'      => 'sometimes|email|max:190',
        ]);
        $c = $this->repo->update($id, $data);
        return $c ? response()->json($c) : response()->json(['message'=>'Not found'],404);
    }

    public function destroy($id) {
        return $this->repo->delete($id)
            ? response()->noContent()
            : response()->json(['message'=>'Not found'],404);
    }
}
