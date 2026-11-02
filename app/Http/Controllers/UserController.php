<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showUser(Request $request)
    {
        $query=Application::where('user_id',auth()->id());

        //поиск
        if ($request->filled('search')){
            $query->where('title','LIKE','%' . $request->search . '%');
        
        }

        //фильтрация по поиску
        if($request->filled('status')){
            $query->where('status',$request->status);

        }

        //withQueryStrig() необходим,чтобы при переходе на 2 страницу
    $applications=$query->paginate(5)->withQueryString();

    return view('user', compact('applications'));
    }

    public function showCreateApp(){
        return view('createApp');
    }

    public function storeCreateApp(Request $request){
        $path = $request->file('image')->store('images', 'public');
        Application::create([
            'user_id' => Auth()->id(),
            'image' => $path,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'На модерации',
        ]);
        return redirect()->back()->with('success', 'Заявка успешно создана');
    }
}
