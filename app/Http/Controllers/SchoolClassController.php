<?php

namespace App\Http\Controllers;

use App\Repositories\SchoolClassRepository;
use App\Http\Requests\StoreClassRequest;
use App\Http\Requests\UpdateClassRequest;

class SchoolClassController extends Controller
{
    protected $schoolClassRepository;

    public function __construct(SchoolClassRepository $schoolClassRepository)
    {
        $this->schoolClassRepository = $schoolClassRepository;
    }

    public function index()
    {
        $classes = $this->schoolClassRepository->getAll(); 
        return view('school_classes.index', compact('classes'));
    }

    public function show(int $id)
    {
        $schoolClass = $this->schoolClassRepository->find($id);
        if (!$schoolClass) {
            return redirect()->route('school-classes.index')->with('error', 'Class not found.');
        }
        return view('school_classes.show', compact('schoolClass'));
    }

    public function create()
    {
        return view('school_classes.create');
    }
    public function store(StoreClassRequest $request)
    {
        $data = $request->validated();             
        $this->schoolClassRepository->create($data);
        return redirect()->route('school-classes.index')->with('success', 'Class created successfully.');
    }   
    public function edit(int $id)
    {
        $schoolClass = $this->schoolClassRepository->find($id);
        if (!$schoolClass) {
            return redirect()->route('school-classes.index')->with('error', 'Class not found.');
        }
        return view('school_classes.edit', compact('schoolClass'));
    }
    public function update(UpdateClassRequest $request,int $id)
    {
        $data = $request->validated();             
        $updated = $this->schoolClassRepository->update($id, $data);
        if (!$updated) {
            return redirect()->route('school-classes.index')->with('error', 'Class not found.');
        }
        return redirect()->route('school-classes.index')->with('success', 'Class updated successfully.');
    }
    public function destroy(int $id)
    {
        $deleted = $this->schoolClassRepository->delete($id);
        if (!$deleted) {
            return redirect()->route('school-classes.index')->with('error', 'Class not found.');
        }
        return redirect()->route('school-classes.index')->with('success', 'Class deleted successfully.');
    }

}
