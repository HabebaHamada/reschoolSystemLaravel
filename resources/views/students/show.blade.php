<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Student Details: {{ $student->name }}</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">student ID: {{ $student->id }}</h5>
                <p class="card-text"><strong>Name:</strong> {{ $student->name }}</p>
                <p class="card-text"><strong>Date of Birth:</strong> {{ $student->date_of_birth }}</p>
                <p class="card-text">
                    <strong>Class:</strong>
                    @if ($student->schoolClass)
                        {{ $student->schoolClass->name }} (ID: {{ $student->schoolClass->id }})
                    @else
                        N/A
                    @endif
                </p>
                @if ($student->photo)
                <div class="mb-4">
                    <label class="form-label">Student Photo:</label>
                    <!-- Use Storage::url() to get the public URL for the stored file -->
                    <img src="{{ Storage::url($student->photo) }}" alt="Student Photo"
                        style="max-width: 150px; height: auto;">
                </div>
            @endif
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Enrolled Subjects</h5>
                        @forelse ($student->subjects as $subject)
                            <span class="badge bg-secondary me-1">{{ $subject->name }}</span>
                        @empty
                            <p class="card-text">No subjects enrolled.</p>
                        @endforelse
                    </div>
                </div>
                <a href="{{ route('students.index') }}" class="btn btn-primary">Back to Students</a>
            </div>
    </div>
</body>

</html>
