<?php

namespace App\Http\Controllers;
use App\Repositories\SubjectRepository;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;

class SubjectController extends Controller
{

    protected $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function index()
    {
        $subjects = $this->subjectRepository->getAll();
        return view('subjects.index', compact('subjects'));
    }

    public function show(int $id)
    {
        $subject = $this->subjectRepository->find($id);
        return view('subjects.show', compact('subject'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(StoreSubjectRequest $request)
    {
        $data = $request->validated();

        $this->subjectRepository->create($data);

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    public function edit(int $id)
    {
        $subject = $this->subjectRepository->find($id);
        if (!$subject) {
            return redirect()->route('subjects.index')->with('error', 'Subject not found.');
        }
        return view('subjects.edit', compact('subject'));
    }

    public function update(UpdateSubjectRequest $request,int $id)
    {
        $data = $request->validated();

        $updated=$this->subjectRepository->update($id, $data);

        if (!$updated) {
            return redirect()->route('subjects.index')->with('error', 'Subject not found.');
        }

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }
    
    public function destroy(int $id)
    {
        $deleted=$this->subjectRepository->delete($id);

        if (!$deleted) {
            return redirect()->route('subjects.index')->with('error', 'Subject not found.');
        }

        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
