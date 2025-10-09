<div class="row pb-50 mb-10">
    <div class="col-12 border-bottom-light pb-20">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h1 class="text-30 lh-12 fw-700 mb-5">Edit Course</h1>
                <p class="text-muted mb-0">Update the details of the course.</p>
            </div>

            <form action="{{ route('admin.delete.course', $course->id) }}" method="POST" class="delete-course mb-0">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="btn btn-outline-danger fw-semibold px-4 py-2 d-flex align-items-center gap-2 rounded-2">
                    <i class="bi bi-trash3"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>


<div class="row y-gap-60">
    <div class="col-12">
        <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
            <div class="d-flex items-center py-20 px-30 border-bottom-light">
                <h2 class="text-17 lh-1 fw-500">Basic Information</h2>
            </div>

            <div class="py-30 px-30">
                {{-- Edit Form --}}
                <form id="editCourseForm" class="contact-form row y-gap-30" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- we'll send POST via AJAX manually --}}
                    <input type="hidden" name="course_id" value="{{ $course->id }}">

                    {{-- Title --}}
                    <div class="col-12">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Course Title*</label>
                        <input type="text" name="title" value="{{ $course->title }}" class="form-control" required>
                    </div>

                    {{-- Short Description --}}
                    <div class="col-12">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Short Description*</label>
                        <textarea name="short_description" rows="4" required>{{ $course->short_description }}</textarea>
                    </div>

                    {{-- Full Description --}}
                    <div class="col-12">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Full Description*</label>
                        <textarea name="description" rows="6">{{ $course->description }}</textarea>
                    </div>

                    {{-- Learning Outcomes --}}
                    <div class="col-md-6">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Learning Outcomes*</label>
                        <textarea name="learning_outcomes" rows="5">{{ $course->learning_outcomes }}</textarea>
                    </div>

                    {{-- Requirements --}}
                    <div class="col-md-6">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Requirements*</label>
                        <textarea name="requirements" rows="5">{{ $course->requirements }}</textarea>
                    </div>

                    {{-- Level --}}
                    <div class="col-md-6">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Course Level*</label>
                        <input type="text" name="level" value="{{ $course->level }}" class="form-control">
                    </div>

                    {{-- Audio Language --}}
                    <div class="col-md-6">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Audio Language*</label>
                        <input type="text" name="audio_language" value="{{ $course->audio_language }}"
                            class="form-control">
                    </div>

                    {{-- Category --}}
                    <div class="col-md-6">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Course Category*</label>
                        <select name="category_id" class="form-select" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $course->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Thumbnail --}}
                    <div class="col-md-6">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Thumbnail*</label>
                        <input type="file" name="thumbnail" class="form-control mb-2">
                        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('assets/img/dashboard/edit/1.png') }}"
                            alt="Course Thumbnail" width="120" class="rounded-2">
                    </div>
                </form>

                {{-- Buttons --}}
                <div class="row y-gap-20 justify-between pt-15">
                    <div class="col-auto">
                        <button type="button" class="button -md -outline-purple-1 text-purple-1"
                            onclick="window.location='{{ route('admin.dashboard') }}'">Cancel</button>
                    </div>

                    <div class="col-auto">
                        <button type="submit" form="editCourseForm" class="button -md -purple-1 text-white">Update
                            Course</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ✅ AJAX Update --}}
<script>
    $(document).ready(function() {
        $('#editCourseForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('admin.update.course', $course->id) }}", // ✅ correct variable
                type: "POST", // ✅ still POST (we’ll spoof PUT)
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('.button.-purple-1').text('Updating...');
                    $('#successMessage').remove();
                },
                success: function(response) {
                    if (response.success) {
                        let alertHtml = `
                            <div id="successMessage" class="alert alert-success mt-3" role="alert">
                                ${response.message}
                            </div>`;
                        $('#editCourseForm').after(alertHtml);

                        setTimeout(() => {
                            window.location = "{{ route('admin.dashboard') }}";
                        }, 2000);
                    } else {
                        alert('Something went wrong.');
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        let messages = Object.values(errors).map(err => err[0]).join(
                            '<br>');
                        let alertHtml = `
                            <div id="successMessage" class="alert alert-danger mt-3" role="alert">
                                ${messages}
                            </div>`;
                        $('#editCourseForm').after(alertHtml);
                    } else {
                        alert('An error occurred. Please try again.');
                    }
                },
                complete: function() {
                    $('.button.-purple-1').text('Update Course');
                }
            });
        });
    });
    //delete
    $(document).ready(function() {
        $('.delete-course').on('submit', function(e) {
            e.preventDefault();



            let form = $(this);
            let url = "{{ route('admin.delete.course', ':id') }}";
            url = url.replace(':id', "{{ $course->id }}"); // dynamically insert course ID

            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                beforeSend: function() {
                    form.find('button').prop('disabled', true).text('Deleting...');
                    $('#successMessage').remove();
                },
                success: function(response) {
                    if (response.success) {
                        let alertHtml = `
                        <div id="successMessage" class="alert alert-success mt-3" role="alert">
                            ${response.message}
                        </div>`;
                        form.after(alertHtml);

                        setTimeout(() => {
                            window.location = "{{ route('admin.dashboard') }}";
                        }, 2000);
                    } else {
                        alert('Something went wrong.');
                    }
                },
                error: function(xhr) {
                    alert('Failed to delete the course. Please try again.');
                },
                complete: function() {
                    form.find('button').prop('disabled', false).text('Delete');
                }
            });
        });
    });
</script>
