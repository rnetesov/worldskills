<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProposalController extends Controller
{
    public function index()
    {
        $all = Proposal::all();

        $new = $all->filter(function ($item) {
            return $item->status == Proposal::STATUS_NEW;
        });
        $solved = $all->filter(function ($item) {
            return $item->status == Proposal::STATUS_SOLVED;
        });
        $work = $all->filter(function ($item) {
            return $item->status == Proposal::STATUS_WORK;
        });

        $proposals = compact('new', 'solved', 'work');

        return view('admin.proposal.index', compact('proposals', 'all'));
    }

    public function create()
    {}

    public function store(Request $request)
    {}

    public function show(Proposal $proposal)
    {
        return view('admin.proposal.show', compact('proposal'));
    }

    public function edit(Proposal $proposal)
    {
        return view('admin.proposal.edit', compact('proposal'));
    }

    public function update(Request $request, Proposal $proposal)
    {
        $data = $this->validate($request, [
            'title' => 'required|string|max:255',
            'category_id' => 'required|numeric|exists:categories,id,id,'.$request['category_id'],
            'description' => 'required|string|max:1000',
            'photo_before' => 'mimes:jpeg,png,jpg,gif,svg|max:2000',
            'photo' => 'mimes:jpeg,png,jpg,gif,svg|max:2000',
        ]);

        if ($request->hasFile('photo')) {
            if ($proposal->photo_after) {
                unlink(public_path('/photos/after/'.$proposal->photo_after));
                $file = $request->file('photo');
                $filename = uniqid().'.'.$file->extension();
                $file->move(public_path('/photos/after'), $filename);
                $data['photo_after'] = $filename;
            }
        }

        $proposal->update($data);
        return redirect()->route('admin.proposal.index', $proposal)->with('success', 'Ваша заявка была успешно обновлена');
    }

    public function destroy(Proposal $proposal)
    {
        $proposal->delete();
        return redirect()->route('admin.proposal.index')
            ->with('success', 'Заявка была успешно удалена');
    }

    public function solvedShow(Proposal $proposal)
    {
        if ($proposal->isNew() || $proposal->isWork()) {
            return view('admin.proposal.solved', compact('proposal'));
        }
        return abort(404);
    }

    public function solved(Request $request, Proposal $proposal)
    {
        if ($proposal->isNew() || $proposal->isWork()) {
            $this->validate($request, [
                'photo_after' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:1000',
            ]);

            $file = $request->file('photo_after');
            $filename = uniqid().'.'.$file->extension();
            $file->move(public_path('/photos/after'), $filename);

            $proposal->update([
                'photo_after' => $filename,
                'status' => Proposal::STATUS_SOLVED,
            ]);

            return redirect()->route('admin.proposal.show', $proposal)
                ->with('success', 'Статус был успешно изменен');
        }
        return abort(404);
    }

    public function inWorkShow(Proposal $proposal)
    {
        return view('admin.proposal.work', compact('proposal'));
    }

    public function inWork(Request $request, Proposal $proposal)
    {
        if ($proposal->isNew()) {
            $this->validate($request, [
                'comment' => 'required|string|max:1000'
            ]);

            $proposal->update([
                'comment' => $request['comment'],
                'status' => Proposal::STATUS_WORK
            ]);

            return redirect()->route('admin.proposal.show', $proposal)
                ->with('success', 'Статус заявки был успешно изменен');
        }
        return abort(404);
    }
}
