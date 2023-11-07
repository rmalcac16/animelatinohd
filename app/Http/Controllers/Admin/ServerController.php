<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Http\Request;
use Exception;
use QueryException;

class ServerController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'servers' => Server::orderBy('title', 'asc')->get(),
            'category_name' => 'servers',
            'page_name' => 'list',
        ];

        return view('admin.servers.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'category_name' => 'servers',
            'page_name' => 'create',
        ];
        return view('admin.servers.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255|unique:servers',
            ]);

            $server = new Server();
            $server->title = $request->title;
            $server->embed = $request->embed;
            $server->type = $request->type;
            $server->status = $request->status;
            $server->save();
            
            return redirect()->route('admin.servers.index')->with('success', 'Servidor añadido correctamente');
        } catch (QueryException $e) {
            return redirect()->route('admin.servers.index')->with('error', 'Error al agregar el servidor: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('admin.servers.index')->with('error', 'Error al agregar el servidor: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Server $server)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Server $server)
    {
        $data = [
            'category_name' => 'servers',
            'page_name' => 'edit',
            'server' => $server
        ];
        return view('admin.servers.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Server $server)
    {
        try {

            $request->validate([
                'title' => 'required|string|max:255|unique:servers,title,' . $server->id,
            ]);

            $server->title = $request->title;
            $server->embed = $request->embed;
            $server->type = $request->type;
            $server->status = $request->status;
            $server->save();

            return redirect()->route('admin.servers.index')->with('success', 'Servidor actualizado correctamente');
        } catch (QueryException $e) {
            return redirect()->route('admin.servers.index')->with('error', 'Error al actualizar el servidor: El nombre ya está en uso.');
        } catch (Exception $e) {
            return redirect()->route('admin.servers.index')->with('error', 'Error al actualizar el servidor: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Server $server)
    {
        try {
            $server->delete();
            return redirect()->route('admin.servers.index')->with('success', 'Servidor eliminado correctamente');
        } catch (QueryException $e) {
            return redirect()->route('admin.servers.index')->with('error', 'Error al eliminar el servidor: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el servidor: ' . $e->getMessage());
        }
    }
}
