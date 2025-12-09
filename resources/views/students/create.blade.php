<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Add New Student</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <div class="mb-3">
                    <label for="photo" class="form-label">choose Photo:</label>
                    <!-- The 'name' attribute must match the 'photo' key in your validation/model -->
                    <input type="file" class="form-control" id="photo" name="photo">
                    @error('photo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Student Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="school_class_id" class="form-label">Class Name:</label>
                    <select class="form-select" class="form-control" id="school_class_id" name="school_class_id"
                        required>
                        <option value="">Select a Class</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}"
                                {{ old('school_class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('school_class_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth:</label>
                    <input type="text" class="form-control" id="date_of_birth" name="date_of_birth"
                        value="{{ old('date_of_birth') }}" optional>
                </div>
                <div class="mb-3">
                    <label for="subjects" class="form-label">Subjects:</label>
                    <!-- Use 'subjects[]' for the name to send an array of values -->
                    <select multiple class="form-select" id="subjects" name="subjects[]">
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}"
                                {{ in_array($subject->id, old('subjects', [])) ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subjects')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
        </form>

    </div>
</body>

</html>
