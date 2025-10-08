<div class="row pb-50 mb-10">
    <div class="col-auto">
        <h1 class="text-30 lh-12 fw-700">Create New Course</h1>
        <div class="mt-10">Fill in the details to create a new course.</div>
    </div>
</div>

<div class="row y-gap-60">
    <div class="col-12">
        <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
            <div class="d-flex items-center py-20 px-30 border-bottom-light">
                <h2 class="text-17 lh-1 fw-500">Basic Information</h2>
            </div>

            <div class="py-30 px-30">
                {{-- Course Form --}}
                <form id="createCourseForm" class="contact-form row y-gap-30" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- Title --}}
                    <div class="col-12">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Course Title*</label>
                        <input type="text" name="title" class="form-control"
                            placeholder="Learn Figma - UI/UX Design Essential Training" required>
                    </div>

                    {{-- Short Description --}}
                    <div class="col-12">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Short Description*</label>
                        <textarea name="short_description" placeholder="Write a brief overview..." rows="4" required></textarea>
                    </div>

                    {{-- Course Description --}}
                    <div class="col-12">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Full Description*</label>
                        <textarea name="description" placeholder="Detailed course description..." rows="6"></textarea>
                    </div>

                    {{-- Learning Outcomes --}}
                    <div class="col-md-6">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Learning Outcomes*</label>
                        <textarea name="learning_outcomes" placeholder="What will students learn?" rows="5"></textarea>
                    </div>

                    {{-- Requirements --}}
                    <div class="col-md-6">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Requirements*</label>
                        <textarea name="requirements" placeholder="What are the prerequisites?" rows="5"></textarea>
                    </div>

                    {{-- Level --}}
                    <div class="col-md-6">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Course Level*</label>
                        <input type="text" name="level" placeholder="Beginner / Intermediate / Advanced">
                    </div>

                    {{-- Audio Language --}}
                    <div class="col-md-6">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Audio Language*</label>
                        <input type="text" name="audio_language" placeholder="e.g. English, Urdu">
                    </div>

                    {{-- Course Category --}}
                    <div class="col-md-6">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Course Category*</label>
                        <select name="category_id" class="form-select" required>
                            <option value="" disabled selected>Select a Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Thumbnail --}}
                    <div class="col-md-6">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Thumbnail*</label>
                        <input type="file" name="thumbnail" class="form-control">
                    </div>

                </form>

                {{-- Navigation Buttons --}}
                <div class="row y-gap-20 justify-between pt-15">
                    <div class="col-auto">
                        <button type="button" class="button -md -outline-purple-1 text-purple-1"
                            onclick="window.location='{{ route('admin.dashboard') }}'">Prev</button>
                    </div>

                    <div class="col-auto">
                        <button type="submit" form="createCourseForm" class="button -md -purple-1 text-white">Create
                            Course</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#createCourseForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('admin.store.course') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {


                    $('.button.-purple-1').text('Creating...');
                    $('#successMessage').remove(); // remove previous alerts
                },
                success: function(response) {
                    if (response.success) {
                        // Show success message dynamically
                        let alertHtml = `
                        <div id="successMessage" class="alert alert-success mt-3" role="alert">
                            ${response.message}
                        </div>
                    `;
                        $('#createCourseForm').after(alertHtml);

                        // Reset form
                        $('#createCourseForm')[0].reset();

                        // Redirect after short delay
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
                        </div>
                    `;
                        $('#createCourseForm').after(alertHtml);
                    } else {
                        alert('An error occurred. Please try again.');
                    }
                },
                complete: function() {
                    $('.button.-purple-1').text('Create Course');
                }
            });
        });
    });
</script>
