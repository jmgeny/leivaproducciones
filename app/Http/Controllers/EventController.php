<?php

namespace leiman\Http\Controllers;

use leiman\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = Event::orderBy('fecha','ASC')
                  ->paginate(6);

        return view('eventos.index',compact('eventos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \leiman\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evento = Event::find($id);

        return view('eventos.show',compact('evento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \leiman\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evento = Event::find($id);

        return view('eventos.edit',compact('evento'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \leiman\Event  $event
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $evento = Event::find($id);
        $evento->delete();
        return back()->with('info','El evento fue eliminado');  
    }        

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \leiman\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $evento = Event::find($id);

        $evento->nombre = $request->nombre;
        $evento->fecha = $request->fecha;
        $evento->direccion = $request->direccion;
        $evento->city_id = $request->city_id;
        $evento->descripcion = $request->descripcion;
        $evento->championship_id = $request->championship_id;
        $evento->sport_id = $request->sport_id;
        $evento->specification_id = $request->specification_id;
        $evento->cronograma = $request->cronograma;
        $evento->llegar_dormir = $request->llegar_dormir;
        $evento->contacto = $request->contacto;
        $evento->inscripcion = $request->inscripcion;

        // Guardar archivo
        // Necesito el archivo en una variable esta vez
        $lista = $request->file("inscripto");// $evento->inscripto = $request->inscripto;
        $result = $request->file("resultado");//$evento->resultado = $request->resultado;

        // Armo un nombre único para este archivo
        $namelista = $request->fecha . "-lista" . "-" . $evento->id . "." . $lista->extension();
        $nameresult = $request->fecha . "-result" . "-" . $evento->id . "." . $result->extension();

        $folder = "archivos";
        
        $pathl = $lista->storePubliclyAs($folder, $namelista);
        $path2 = $result->storePubliclyAs($folder, $nameresult);

        // Puedo igual guardarlo en base de datos...
        $evento->inscripto = $pathl;
        $evento->resultado = $path2;

        
        $evento->save();

       return redirect()->route('event.index')
                        ->with('info','El evento fue modificado');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('eventos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $evento = new Event;

        $evento->nombre = $request->nombre;
        $evento->fecha = $request->fecha;
        $evento->direccion = $request->direccion;
        $evento->city_id = $request->city_id;
        $evento->descripcion = $request->descripcion;
        $evento->championship_id = $request->championship_id;
        $evento->sport_id = $request->sport_id;
        $evento->specification_id = $request->specification_id;
        $evento->cronograma = $request->cronograma;
        $evento->llegar_dormir = $request->llegar_dormir;
        $evento->contacto = $request->contacto;
        $evento->inscripcion = $request->inscripcion;

        // Guardar archivo
        // Necesito el archivo en una variable esta vez
        $lista = $request->file("inscripto");// $evento->inscripto = $request->inscripto;
        $result = $request->file("resultado");//$evento->resultado = $request->resultado;

        // Armo un nombre único para este archivo
        $namelista = $request->fecha . "-lista" . "-" . $evento->id . "." . $lista->extension();
        $nameresult = $request->fecha . "-result" . "-" . $evento->id . "." . $result->extension();

        $folder = "archivos";
        
        $pathl = $lista->storePubliclyAs($folder, $namelista);
        $path2 = $result->storePubliclyAs($folder, $nameresult);

        // Puedo igual guardarlo en base de datos...
        $evento->inscripto = $pathl;
        $evento->resultado = $path2;

        $evento->save();

       return redirect()->route('event.index')
                        ->with('info','El evento fue creado exitosamente');        
    }


}
