<?php

namespace App\Http\Controllers;
use App\Repositories\StudentRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\SchoolClassRepository;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\StoreStudentRequest;

class StudentController extends Controller
{
    protected $studentRepository;
    protected $schoolClassRepository;
    protected $subjectRepository;

    public function __construct(StudentRepository $studentRepository, SchoolClassRepository $schoolClassRepository, SubjectRepository $subjectRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->schoolClassRepository = $schoolClassRepository;
        $this->subjectRepository = $subjectRepository;
    }

    public function index()
    {
        $students = $this->studentRepository->getAll();
        return view('students.index', compact('students'));
    }

    public function show(int $id)
    {
        $student = $this->studentRepository->find($id);
        return view('students.show', compact('student'));
    }

    public function create()
    {
        $classes = $this->schoolClassRepository->getAll();
        $subjects = $this->subjectRepository->getAll();
        return view('students.create',compact('classes','subjects'));
    }

    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();

        $this->studentRepository->create($data);
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function edit(int $id)
    {
        $student = $this->studentRepository->find($id);
        $classes = $this->schoolClassRepository->getAll();
        $subjects = $this->subjectRepository->getAll();

        if (!$student) {
            return redirect()->route('students.index')->withErrors('Student not found.');
        }
        return view('students.edit', compact('student', 'classes', 'subjects'));
    }
    public function update(UpdateStudentRequest $request, int $id)
    {
        $data = $request->validated();

        $updated=$this->studentRepository->update($id, $data);

        if (!$updated) {
            return redirect()->route('students.index')->withErrors('Student not found.');
        }
        return redirect()->route('students.show', $id)->with('success', 'Student updated successfully.');
    }
    public function destroy(int $id)
    {
        $deleted=$this->studentRepository->delete($id);

        if (!$deleted) {
            return redirect()->route('students.index')->withErrors('Student not found.');
        }
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }

}
