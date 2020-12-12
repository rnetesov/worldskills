<?php

namespace App\Http\Controllers\User;

use App\Entities\Proposal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProposalController extends Controller
{
    public function index(Request $request)
    {
        $query = Auth::user()->proposals();

        if ($request->filled('sort')) {
            switch ($request->get('sort')) {
                case 'new':
                    $query->whereStatus(Proposal::STATUS_NEW);
                    break;
                case 'work':
                    $query->whereStatus(Proposal::STATUS_WORK);
                    break;
                case 'done':
                    $query->whereStatus(Proposal::STATUS_SOLVED);
                    break;
            }
        }

        $proposals = $query->orderByDesc('created_at')->get();
        return view('proposal.index', compact('proposals'));
    }

    public function create()
    {
        return view('proposal.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'title' => 'required|string|max:255',
            'category_id' => 'required|numeric|exists:categories,id,id,'.$request['category_id'],
            'description' => 'required|string|max:1000',
            'photo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2000',
        ], [
            'required' => 'Поле :attribute должно быть заполнено',
            'string' => 'Поле :attribute должно содержать строку',
            'max' => 'Поле :attribute может иметь максимум :max символов',
            'mimes' => 'Загружаемый файл должет быть допустимым изображением'
        ]);

        $file = $request->file('photo');
        $filename = uniqid().'.'.$file->extension();
        $file->move(public_path('/photos/before'), $filename);

        $data['photo_before'] = $filename;
        $data['user_id'] = Auth::user()->id;

        $proposal = Proposal::create($data);

        return redirect()
            ->route('user.proposal.show', $proposal)
            ->with('success', 'Ваша заявка была успешно создана, в ближайшее время наши специалисты ее рассмотрят');
    }

    public function show(Proposal $proposal)
    {
        if ($proposal->user_id == Auth::user()->id) {
            return view('proposal.show', compact('proposal'));
        }

        return abort(404);
    }

    public function edit(Proposal $proposal)
    {
        if (Auth::user()->id == $proposal->user_id) {
            if ($proposal->isNew()) {
                return view('proposal.edit', compact('proposal'));
            }
        }
        return abort(404);
    }

    public function update(Request $request, Proposal $proposal)
    {
        if (Auth::user()->id == $proposal->user_id) {
            if ($proposal->isNew()) {
                $data = $this->validate($request, [
                    'title' => 'required|string|max:255',
                    'category_id' => 'required|numeric|exists:categories,id,id,'.$request['category_id'],
                    'description' => 'required|string|max:1000',
                    'photo' => 'mimes:jpeg,png,jpg,gif,svg|max:2000',
                ], [
                    'required' => 'Поле :attribute должно быть заполнено',
                    'string' => 'Поле :attribute должно содержать строку',
                    'max' => 'Поле :attribute может иметь максимум :max символов',
                ]);

                if ($request->hasFile('photo')) {
                    unlink(public_path('/photos/before/'.$proposal->photo_before));
                    $file = $request->file('photo');
                    $filename = uniqid().'.'.$file->extension();
                    $file->move(public_path('/photos/before'), $filename);
                    $data['photo_before'] = $filename;
                }

                $proposal->update($data);
                return redirect()->route('user.proposal.show', $proposal)->with('success', 'Ваша заявка была успешно обновлена');
            }
        }
        return abort(404);
    }

    public function destroy(Proposal $proposal)
    {
        if (Auth::user()->id == $proposal->user_id) {
            unlink(public_path('/photos/before/'.$proposal->photo_before));
            $proposal->delete();
            return redirect()->route('user.proposal.index')->with('success', 'Ваша заявка была успешно удалена');
        }
        return redirect()->route('user.proposal.index')->with('error', 'Ошибка');
    }
}
