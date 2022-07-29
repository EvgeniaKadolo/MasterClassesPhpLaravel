<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Master_class;
use App\Models\Time;
use Illuminate\Validation\Rule;
use Auth;

class IndexController extends Controller
{
    public function main() {
        $types = Type::get();
        return view('main')->with(['types'=>$types]);
    }

    public function type(Type $type) {
        $types = Type::get();
        if (Auth::check() && Auth::user()->is_master) {
            $master_classes = $type->master_classes()->where('user_id', Auth::id())->get();
        }
        else {
            $master_classes = $type->master_classes()->get();
        }
        return view('type')->with(['type'=>$type, 'master_classes'=>$master_classes,'types'=>$types]);
    }

    public function home() {
        $types = Type::get();
        if (Auth::user()->is_master) {
            $master_classes = Auth::user()->master_classes;
        }
        else {
            $master_classes = Auth::user()->timetables;
        }
        return view('home')->with(['types'=>$types, 'master_classes'=>$master_classes]);
    }

    public function unsubscribe(Timetable $timetable) {
        $info = '';
        if ($timetable->date > date(('Y-m-d'), strtotime(date('Y-m-d'). ' + 1 day')) && Auth::user()->timetables->contains($timetable->id)) {
            Auth::user()->timetables()->detach($timetable->id);
            $timetable->update([
                'number'    => $timetable->number + 1
            ]);
        }
        else {
            $info = 'Нельзя отписаться, мастер-класс уже начался';
        }
        return redirect()->back()->with('success', $info);
    }

    public function delete(Timetable $timetable) {
        $this->authorize('master');
        $info = '';
        if ($timetable->users->count() == 0) {
            $timetable->delete();
        }
        else $info = 'Нельзя удалить, на мастер-класс есть записи';
        return redirect()->back()->with('success', $info);
    }

    public function delete_master_class(Master_class $master_class) {
        $this->authorize('master');
        $info = '';
        $flag = true;
        foreach ($master_class->timetables as $timetable) {
            if($timetable->users->count() != 0) $flag = false;
        }
        if ($flag) {
            foreach ($master_class->timetables as $timetable) {
                $timetable->delete();
            }
            $master_class->delete();
        }
        else $info = 'Нельзя удалить, на мастер-класс есть записи';
        return redirect()->back()->with('success', $info);
    }

    public function confirm(Timetable $timetable)
    {
        return view('confirm')->with(['timetable'=>$timetable, 'master_class'=>$timetable->master_class()->first()]);
    }

    public function subscribe(Timetable $timetable, Master_class $master_class) {
        if ($timetable->number > 0 && !Auth::user()->timetables->contains($timetable->id) && $timetable->date > date('Y-m-d')) {
            Auth::user()->timetables()->attach($timetable->id);
            $timetable->update([
                'number'    => $timetable->number - 1
            ]);
            $info = 'Вы успешно записались на мастер-класс';
        }
        else if (Auth::user()->timetables->contains($timetable->id)) {
            $info = 'Вы уже записаны на данный мастер-класс';
        }
        else if ($timetable->date <= date('Y-m-d')) {
            $info = 'Дата начала мастер-класса уже прошла';
        }
        else {
            $info = 'Места на данный мастер-класс закончились';
        }
        return redirect('/type/'.$master_class->type()->first()->id)->with('success', $info);
    }

    public function add() {
        $this->authorize('master');
        $master_classes = Auth::user()->master_classes;
        $types = Type::get();
        $times = Time::get();
        return view('add')->with(['types'=>$types, 'times'=>$times, 'master_classes'=>$master_classes]);
    }

    public function store(Request $request)
    {
        $this->authorize('master');

         if($request->input('master_class_id') == '-1') {
            $validated = $request->validate([
                'name'     => ['required'],
                'description' => ['required'],
                'type_id' => ['required'],
                'number' => ['required', 'numeric', 'min:0'],
                'price' => ['required', 'numeric', 'min:0'],
                'date'    => ['required', 'date', 'after:'.date('d.m.Y')],
                'time_id' => Rule::unique('timetables')->where('date', $request->input('date'))
            ]);
            $master_class = new Master_class();
            $master_class->name = $request->input('name');
            $master_class->description = $request->input('description');
            $master_class->price = $request->input('price');
            $master_class->type_id = $request->input('type_id');
            $master_class->user_id = Auth::id();
            $master_class->save();

            $timetable = new Timetable();
            $timetable->date = $request->input('date');
            $timetable->number = $request->input('number');
            $timetable->master_class_id = $master_class->id;
            $timetable->time_id = $request->input('time_id');
            $timetable->save();
        }
        else {
            $validated = $request->validate([
                'date'    => ['required', 'date', 'after:'.date('d.m.Y')],
                'number' => ['required', 'numeric', 'min:0'],
                'time_id' => Rule::unique('timetables')->where('date', $request->input('date'))
            ]);
            $timetable = new Timetable();
            $timetable->date = $request->input('date');
            $timetable->number = $request->input('number');
            $timetable->master_class_id = $request->input('master_class_id');
            $timetable->time_id = $request->input('time_id');
            $timetable->save();
        }
        return redirect('/home');
    }

    public function change(Timetable $timetable)
    {
        $this->authorize('master');
        $types = Type::get();
        $times = Time::get();
        return view('edit')->with(['types'=>$types, 'times'=>$times, 'timetable'=>$timetable, 'master_class'=>$timetable->master_class()->first()]);
    }

    public function edit(Timetable $timetable, Request $request)
    {
        $this->authorize('master');
        $validated = $request->validate([
            'name'     => ['required'],
            'description' => ['required'],
            'type_id' => ['required'],
            'number' => ['required', 'numeric', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'date'    => ['required', 'date', 'after:'.date('d.m.Y')],
            'time_id' => Rule::unique('timetables')->where('date', $request->input('date'))->ignore($timetable)
        ]);

        $timetable->master_class()->first()->update([
            'name'     => $request->get('name'),
            'description' => $request->get('description'),
            'date'    => $request->get('date'),
            'price'    => $request->get('price'),
            'type_id'   => $request->get('type_id')
        ]);

        $timetable->update([
            'date'    => $request->get('date'),
            'number'    => $request->get('number'),
            'time_id'    => $request->get('time_id')
        ]);
        return redirect('/home');
    }
}
