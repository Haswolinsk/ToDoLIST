<?php

namespace App\Http\Controllers;

use App\Models\todoLIST;
use Illuminate\Http\Request;

class TodoLISTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $tasks = todolist::all();
            return response()->json($tasks, 200);}
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()],
             500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $todolist = new Todolist();
            $todolist->task = $request->task;
            $todolist->description = $request->description;
            $todolist->deadline = $request->deadline;
            $todolist->save();
            
            //todolist::create($request->all());
            return response()->json(['message' => 'Salvando os dados!'], 200);}
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\todoLIST  $todoLIST
     * @return \Illuminate\Http\Response
     */
    public function show(todoLIST $todoLIST)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\todoLIST  $todoLIST
     * @return \Illuminate\Http\Response
     */
    public function edit(todoLIST $todoLIST)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\todoLIST  $todoLIST
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        try {
            $todolist = todolist::findOrFail($id);
            $todolist->save();
            $todolist->task = $request->task;
            $todolist->description = $request->description;
            $todolist->deadline = $request->deadline;
            

            return response()->json(['message'=>'Tarefa editada com sucesso'], 200);
        }catch (\Exception $e) {
            return response()->json(['error'=> $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\todoLIST  $todoLIST
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        try{
            $todolist = todolist::findOrFail($id);
            $todolist->delete();
            return response()->json(['message'=>'Tarefa excluída com sucesso'], 200);}
        catch(\Exception $e){
            return response()->json(['error'=> $e->getMessage()], 500);
        } 
    }
}
