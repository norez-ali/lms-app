<!-- resources/views/teacher/courses.blade.php -->
<div class="container mx-auto px-6 py-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row items-center justify-between mb-10">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manage your course, sections, and lessons.</h1>

        </div>

        <div class="flex gap-3 mt-4 md:mt-0">

            {{-- for adding course quizzes  --}}
            <button command="show-modal" commandfor="add-quiz"
                class="bg-purple-100 hover:bg-purple-200 text-purple-700 px-4 py-2 rounded-lg shadow transition">Add
                Quiz</button>
            <el-dialog>
                <dialog id="add-quiz"
                    class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">

                    <div class="fixed inset-0 bg-white/70 backdrop-blur-sm transition-opacity"></div>

                    <!-- Modal container -->
                    <div tabindex="0"
                        class="flex min-h-screen items-center justify-center p-4 text-center focus:outline-none sm:p-0">
                        <div
                            class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-3xl">

                            <!-- Header -->
                            <div class="bg-purple-600 px-6 py-4">
                                <h3 id="dialog-title" class="text-lg font-semibold text-white text-center">
                                    Add New Quiz to the Course
                                </h3>
                            </div>

                            <!-- Body -->
                            <form id="addQuizForm" class="bg-white px-6 py-6" method="POST"
                                action="{{ route('teacher.add.quiz', $course->id) }}">
                                @csrf

                                <div class="space-y-5">
                                    <!-- Quiz Title -->
                                    <div>
                                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                            Quiz Title
                                        </label>
                                        <input type="text" id="title" name="title"
                                            placeholder="Enter quiz title"
                                            class="block w-full rounded-md border border-gray-300 focus:border-purple-500 focus:ring-purple-500 focus:ring-1 transition">
                                    </div>

                                    <!-- Quiz Description -->
                                    <div>
                                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                            Quiz Description (optional)
                                        </label>
                                        <textarea id="description" name="description" rows="3" placeholder="Write something about this quiz..."
                                            class="block w-full rounded-md border border-gray-300 focus:border-purple-500 focus:ring-purple-500 focus:ring-1 transition"></textarea>
                                    </div>

                                    <!-- Repeater for Questions -->
                                    <div id="questionsRepeater" class="space-y-6">
                                        <div class="question-block border p-4 rounded-lg bg-gray-50 relative">
                                            <label class="block text-sm font-semibold mb-2">Question</label>
                                            <input type="text" name="questions[0][question]"
                                                class="w-full rounded-md border border-gray-300 focus:border-purple-500 focus:ring-purple-500 focus:ring-1 transition"
                                                placeholder="Enter question text">

                                            <!-- Options -->
                                            <div class="options space-y-2 mt-3">
                                                <div class="flex items-center space-x-2">
                                                    <input type="text" name="questions[0][options][0][option_text]"
                                                        placeholder="Option text"
                                                        class="flex-1 rounded-md border border-gray-300 focus:border-purple-500 focus:ring-purple-500 focus:ring-1 transition">
                                                    <label class="flex items-center space-x-1 text-sm text-gray-700">
                                                        <input type="checkbox"
                                                            name="questions[0][options][0][is_correct]">
                                                        <span>Correct</span>
                                                    </label>
                                                    <button type="button"
                                                        class="remove-option bg-red-100 text-red-600 px-2 py-1 rounded hover:bg-red-200 text-xs">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Add Option Button -->
                                            <button type="button"
                                                class="add-option bg-purple-100 text-purple-700 px-2 py-1 rounded mt-3 hover:bg-purple-200 text-sm">
                                                + Add Option
                                            </button>

                                            <!-- Remove Question Button -->
                                            <button type="button"
                                                class="remove-question absolute top-2 right-2 text-red-600 hover:text-red-800 text-sm">
                                                ✕
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Add New Question Button -->
                                    <button type="button" id="addQuestion"
                                        class="bg-green-100 text-green-700 px-3 py-2 rounded-lg hover:bg-green-200 transition text-sm">
                                        + Add New Question
                                    </button>
                                </div>
                            </form>

                            <!-- Footer -->
                            <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse">
                                <button type="submit" form="addQuizForm"
                                    class="inline-flex w-full justify-center rounded-md bg-purple-600 px-4 py-2 text-sm font-semibold text-white shadow-md hover:bg-purple-700 sm:ml-3 sm:w-auto transition">
                                    Add Quiz
                                </button>

                                <button type="button" command="close" commandfor="dialog"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm border border-gray-300 hover:bg-gray-100 sm:mt-0 sm:w-auto transition">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </dialog>
            </el-dialog>


            {{-- for adding course lessons  --}}
            <button command="show-modal" commandfor="add-lesson"
                class="bg-purple-100 hover:bg-purple-200 text-purple-700 px-4 py-2 rounded-lg shadow transition">Add
                Lesson</button>
            <el-dialog>
                <dialog id="add-lesson"
                    class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">

                    <div class="fixed inset-0 bg-white/70 backdrop-blur-sm transition-opacity"></div>

                    <!-- Modal container -->
                    <div tabindex="0"
                        class="flex min-h-screen items-center justify-center p-4 text-center focus:outline-none sm:p-0">
                        <div
                            class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                            <!-- Header -->
                            <div class="bg-purple-600 px-6 py-4">
                                <h3 id="dialog-title" class="text-lg font-semibold text-white text-center">
                                    Add New Lesson to the Course
                                </h3>
                            </div>

                            <!-- Body -->
                            <!-- Form -->
                            <form id="addLessonForm" class="bg-white px-6 py-6" method="POST"
                                action="{{ route('teacher.add.lesson', $course->id) }}" enctype="multipart/form-data">
                                @csrf

                                <div class="space-y-5">
                                    <!-- Section Dropdown -->
                                    <div>
                                        <label for="section_id" class="block text-sm font-medium text-gray-700 mb-1">
                                            Select Section
                                        </label>
                                        <select id="section_id" name="section_id"
                                            class="block w-full rounded-md border border-gray-300 focus:border-green-500 focus:ring-green-500 focus:ring-1 transition">
                                            <option value="">-- Select Section --</option>
                                            @foreach ($course->sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Lesson Title -->
                                    <div>
                                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                            Lesson Title
                                        </label>
                                        <input type="text" id="title" name="title"
                                            placeholder="Enter lesson title"
                                            class="block w-full rounded-md border border-gray-300 focus:border-green-500 focus:ring-green-500 focus:ring-1 transition">
                                    </div>

                                    <!-- Lesson Description -->
                                    <div>
                                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">
                                            Lesson Description (optional)
                                        </label>
                                        <textarea id="content" name="content" rows="4" placeholder="Add some details about this lesson..."
                                            class="block w-full rounded-md border border-gray-300 focus:border-green-500 focus:ring-green-500 focus:ring-1 transition"></textarea>
                                    </div>

                                    <!-- File Upload -->
                                    <div>
                                        <label for="lesson_file" class="block text-sm font-medium text-gray-700 mb-1">
                                            Upload Lesson File (PDF or Video)
                                        </label>
                                        <input type="file" id="lesson_file" name="lesson_file"
                                            accept="application/pdf,video/mp4,video/quicktime,video/x-matroska"
                                            class="block w-full rounded-md border border-gray-300 focus:border-green-500 focus:ring-green-500 focus:ring-1 transition">
                                    </div>
                                </div>
                            </form>
                            <div id="filePreview"></div>




                            <!-- Footer -->
                            <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse">
                                <button type="submit" form="addLessonForm" id="addLessonForm"
                                    class="inline-flex w-full justify-center rounded-md bg-purple-600 px-4 py-2 text-sm font-semibold text-white shadow-md hover:bg-purple-700 sm:ml-3 sm:w-auto transition">
                                    Add Lesson
                                </button>


                                <button type="button" command="close" commandfor="dialog"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm border border-gray-300 hover:bg-gray-100 sm:mt-0 sm:w-auto transition">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </dialog>


            </el-dialog>
            {{-- for adding section --}}
            <button command="show-modal" commandfor="add-section"
                class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg shadow transition">Add
                Section</button>
            <el-dialog>
                <dialog id="add-section"
                    class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">

                    <div class="fixed inset-0 bg-white/70 backdrop-blur-sm transition-opacity"></div>

                    <!-- Modal container -->
                    <div tabindex="0"
                        class="flex min-h-screen items-center justify-center p-4 text-center focus:outline-none sm:p-0">
                        <div
                            class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                            <!-- Header -->
                            <div class="bg-purple-600 px-6 py-4">
                                <h3 id="dialog-title" class="text-lg font-semibold text-white text-center">
                                    Add New Section
                                </h3>
                            </div>

                            <!-- Body -->
                            <form id="addSectionForm" class="bg-white px-6 py-6" method="POST"
                                action="{{ route('teacher.add.section', $course->id) }}">
                                @csrf
                                <div class="space-y-5">
                                    <!-- Section Title -->
                                    <div>
                                        <label for="title"
                                            class="block text-sm font-medium text-gray-700 mb-1">Section Title</label>
                                        <input type="text" id="title" name="title"
                                            placeholder="Enter section title"
                                            class="block w-full rounded-md border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                                    </div>

                                </div>
                            </form>

                            <!-- Footer -->
                            <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse">
                                <button type="submit" form="addSectionForm"
                                    class="inline-flex w-full justify-center rounded-md bg-purple-600 px-4 py-2 text-sm font-semibold text-white shadow-md hover:bg-purple-700 sm:ml-3 sm:w-auto transition">
                                    Add Section
                                </button>


                                <button type="button" command="close" commandfor="dialog"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm border border-gray-300 hover:bg-gray-100 sm:mt-0 sm:w-auto transition">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </dialog>


            </el-dialog>
        </div>
    </div>

    <!-- Full Width Course Display -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-10">
        <!-- Course Header -->
        <div class="flex flex-col lg:flex-row items-start lg:items-center gap-6 mb-8">
            <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('assets/img/dashboard/edit/1.png') }}"
                alt="Course Thumbnail" class="w-40 h-40 rounded-xl object-cover shadow-md">

            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $course->title }}</h2>
                <p class="text-sm text-gray-500">Level: <span
                        class="font-semibold text-purple-700">{{ $course->level }}</span>
                </p>
                <p class="text-sm text-gray-500">Audio Language: <span
                        class="font-semibold text-purple-700">{{ $course->audio_language }}</span></p>
            </div>
        </div>

        <!-- Course Details -->
        <div class="space-y-6 text-gray-800">
            <div>
                <h3 class="font-semibold text-lg text-purple-700 mb-1">Short Description:</h3>
                <p class="text-gray-600">{{ $course->short_description }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-lg text-purple-700 mb-1">Full Description:</h3>
                <p class="text-gray-600 leading-relaxed">{{ $course->description }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-lg text-purple-700 mb-1">Learning Outcomes:</h3>
                <ul class="list-disc pl-6 text-gray-600 space-y-1">
                    <li>{{ $course->learning_outcomes }}</li>

                </ul>
            </div>

            <div>
                <h3 class="font-semibold text-lg text-purple-700 mb-1">Requirements:</h3>
                <ul class="list-disc pl-6 text-gray-600 space-y-1">
                    <li>{{ $course->requirements }}</li>

                </ul>
            </div>
        </div>

        <div class="container mx-auto px-6 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- 📚 LEFT: Course Sections + Quizzes -->
                <div class="lg:col-span-1 border rounded-xl bg-white shadow-sm p-4 overflow-y-auto max-h-[80vh]">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Course Sections</h3>

                    <div class="space-y-4">
                        @foreach ($course->sections as $section)
                            <div class="border rounded-xl overflow-hidden section-item"
                                data-id="{{ $section->id }}">
                                <button
                                    class="w-full flex justify-between items-center bg-purple-50 text-purple-700 px-5 py-3 font-medium hover:bg-purple-100 transition section-toggle">
                                    <span class="flex items-center gap-2">
                                        <i class="far fa-folder text-purple-600 text-lg"></i>
                                        {{ $section->title }}
                                    </span>
                                    <div class="flex items-center gap-4">
                                        <i class="fas fa-trash text-red-500 hover:text-red-700 cursor-pointer delete-section"
                                            data-id="{{ $section->id }}" title="Delete Section"></i>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </button>

                                <!-- ✅ Lessons -->
                                <div class="hidden bg-gray-50 p-5 text-sm text-gray-700">
                                    @if ($section->lessons->isNotEmpty())
                                        <ul class="pl-6 space-y-2">
                                            @foreach ($section->lessons as $lesson)
                                                <li
                                                    class="relative flex items-center justify-between pl-4 pr-2 py-2 bg-white rounded-md border border-gray-200 hover:shadow-sm transition">
                                                    <div class="flex items-center gap-2">
                                                        <span class="w-2 h-2 rounded-full bg-purple-600"></span>
                                                        <a href="javascript:void(0);" class="lesson-item"
                                                            data-id="{{ $lesson->id }}">
                                                            <span class="font-semibold text-gray-800 text-sm">
                                                                {{ $lesson->title }}
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <i class="fas fa-trash text-red-500 hover:text-red-700 cursor-pointer delete-lesson"
                                                        data-id="{{ $lesson->id }}" title="Delete Lesson"></i>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-gray-500 italic">No lessons added yet.</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- 🧠 Quizzes (same sidebar) -->
                    <div class="mt-8 border-t pt-4">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Course Quizzes</h3>

                        @if ($course->quizzes->isNotEmpty())
                            <ul class="space-y-2">
                                @foreach ($course->quizzes as $quiz)
                                    <li
                                        class="flex items-center justify-between px-4 py-2 bg-purple-50 border border-purple-200 rounded-md hover:bg-purple-100 transition">
                                        <a href="javascript:void(0);" class="quiz-item text-purple-700 font-medium"
                                            data-id="{{ $quiz->id }}">
                                            <i class="fas fa-question-circle mr-2 text-purple-600"></i>
                                            <a href="{{ route('teacher.view.quiz', $quiz->id) }}" class="get-quiz">
                                                {{ $quiz->title }}
                                            </a>
                                        </a>
                                        <i class="fas fa-trash text-red-500 hover:text-red-700 cursor-pointer delete-quiz"
                                            data-id="{{ $quiz->id }}" title="Delete Quiz"></i>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 italic">No quizzes added yet.</p>
                        @endif
                    </div>
                </div>

                <!-- 🧾 RIGHT: Lesson or Quiz Viewer -->
                <div id="lessonContent"
                    class="lg:col-span-2 bg-white border rounded-xl shadow-sm p-6 flex flex-col items-center justify-center text-gray-500 w-full min-h-[500px] max-h-[700px] overflow-y-auto transition-all duration-300">
                    <p class="text-lg">Select a lesson or quiz from the left to view its content.</p>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- Simple dropdown toggle -->
<script>
    $(document).ready(function() {
        document.querySelectorAll('.section-toggle').forEach(button => {
            button.addEventListener('click', () => {
                const next = button.nextElementSibling;
                next.classList.toggle('hidden');
                const icon = button.querySelector('svg');
                icon.classList.toggle('rotate-180');
            });
        });
    });
    $(document).ready(function() {

        // Open dialog
        $(document).on('click', '[command="show-modal"]', function() {
            const targetId = $(this).attr('commandfor');
            const $dialog = $('#' + targetId);
            if ($dialog.length) {
                $dialog[0].showModal();
            }
        });

        // Close dialog
        $(document).on('click', '[command="close"]', function() {
            const $dialog = $(this).closest('dialog');
            if ($dialog.length) {
                $dialog[0].close();
            }
        });

        // Optional: Close when clicking outside dialog box
        $('dialog').on('click', function(e) {
            const dialogBox = $(this).find('.relative')[0];
            const rect = dialogBox.getBoundingClientRect();
            const inDialog = (
                e.clientX >= rect.left &&
                e.clientX <= rect.right &&
                e.clientY >= rect.top &&
                e.clientY <= rect.bottom
            );
            if (!inDialog) {
                this.close();
            }
        });

    });
    //for adding section
    $(document).ready(function() {

        // 🔹 Handle Add Section form submission via AJAX
        $('#addSectionForm').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let actionUrl = form.attr('action');
            let formData = form.serialize(); // Includes CSRF and title

            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: formData,
                success: function(response) {
                    // ✅ Show success message on page
                    showSuccessMessage(response.message || 'Section added successfully!');

                    // ✅ Reset form
                    form.trigger('reset');

                    // ✅ Close the dialog
                    form.closest('dialog')[0].close();

                    // ✅ Optionally update the course section list dynamically
                    // $('.sections-list').append(`<div class="border p-3 rounded-md">${response.section.title}</div>`);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    showErrorMessage('Something went wrong while adding the section.');
                }
            });
        });

        // 🔹 Helper function — show success message
        function showSuccessMessage(message) {
            const alertBox = $(`
            <div class="alert-message bg-purple-100 border border-purple-300 text-purple-800 px-4 py-3 rounded-lg shadow-md mb-4">
                ${message}
            </div>
        `);
            $('.container').prepend(alertBox);
            setTimeout(() => alertBox.fadeOut(500, () => alertBox.remove()), 4000);
        }

        // 🔹 Helper function — show error message
        function showErrorMessage(message) {
            const alertBox = $(`
            <div class="alert-message bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg shadow-md mb-4">
                ${message}
            </div>
        `);
            $('.container').prepend(alertBox);
            setTimeout(() => alertBox.fadeOut(500, () => alertBox.remove()), 4000);
        }

    });
    //delete the section
    $(document).ready(function() {

        // Delete section
        $(document).on('click', '.delete-section', function(e) {
            e.stopPropagation(); // prevent toggle collapse

            const sectionId = $(this).data('id');
            const $sectionItem = $(this).closest('.section-item');

            $.ajax({
                url: `/teacher/delete/section/${sectionId}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Remove section from UI smoothly
                        $sectionItem.fadeOut(300, function() {
                            $(this).remove();
                        });

                        // Show success message
                        $('body').append(`
                        <div id="successMsg" class="fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded shadow-lg z-50">
                            ${response.message}
                        </div>
                    `);

                        setTimeout(() => {
                            $('#successMsg').fadeOut(500, function() {
                                $(this).remove();
                            });
                        }, 2000);
                    }
                },
                error: function() {
                    $('body').append(`
                    <div id="errorMsg" class="fixed top-5 right-5 bg-red-600 text-white px-4 py-2 rounded shadow-lg z-50">
                        Error deleting section. Please try again.
                    </div>
                `);
                    setTimeout(() => {
                        $('#errorMsg').fadeOut(500, function() {
                            $(this).remove();
                        });
                    }, 2000);
                }
            });
        });
    });
    //for adding the lesson

    $(document).ready(function() {

        // Handle file preview + remove
        $('#lesson_file').on('change', function() {
            const file = this.files[0];
            const previewContainer = $('#filePreview');
            previewContainer.empty();

            if (!file) return;

            const fileType = file.type;
            let previewElement = '';

            if (fileType === 'application/pdf') {
                previewElement = `
                <div class="flex items-center justify-between bg-gray-100 p-3 rounded-md">
                    <span class="text-sm font-medium text-gray-700">📄 ${file.name}</span>
                    <button type="button" id="removeFile" class="text-red-600 hover:text-red-800">Remove</button>
                </div>
            `;
            } else if (fileType.startsWith('video/')) {
                const videoURL = URL.createObjectURL(file);
                previewElement = `
                <div class="relative bg-gray-100 p-3 rounded-md">
                    <video controls src="${videoURL}" class="w-full rounded-md mb-2"></video>
                    <button type="button" id="removeFile" class="text-red-600 hover:text-red-800">Remove</button>
                </div>
            `;
            } else {
                previewElement =
                    `<p class="text-red-600">Invalid file type. Please upload a PDF or video.</p>`;
                this.value = ''; // reset invalid file
            }

            previewContainer.html(previewElement);
        });

        // Remove selected file
        $(document).on('click', '#removeFile', function() {
            $('#lesson_file').val('');
            $('#filePreview').empty();
        });

        // Handle form submission via AJAX
        $('#addLessonForm').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const formData = new FormData(this);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    showSuccessMessage(response.message || 'Lesson added successfully!');

                    // Reset form & preview
                    form.trigger('reset');
                    $('#filePreview').empty();

                    // Close modal/dialog
                    form.closest('dialog')[0].close();

                    // Optionally append lesson dynamically (uncomment if needed)
                    // $('.lessons-list').append(`<div class="border p-3 rounded-md">${response.lesson.title}</div>`);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    showErrorMessage('Something went wrong while adding the lesson.');
                }
            });
        });

        // 🔹 Helper — show success message
        function showSuccessMessage(message) {
            const alertBox = $(`
            <div class="alert-message bg-purple-100 border border-purple-300 text-purple-800 px-4 py-3 rounded-lg shadow-md mb-4">
                ${message}
            </div>
        `);
            $('.container').prepend(alertBox);
            setTimeout(() => alertBox.fadeOut(500, () => alertBox.remove()), 4000);
        }

        // 🔹 Helper — show error message
        function showErrorMessage(message) {
            const alertBox = $(`
            <div class="alert-message bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg shadow-md mb-4">
                ${message}
            </div>
        `);
            $('.container').prepend(alertBox);
            setTimeout(() => alertBox.fadeOut(500, () => alertBox.remove()), 4000);
        }

    });
    //deleting course
    $(document).on('click', '.delete-lesson', function() {
        const lessonId = $(this).data('id');
        const lessonItem = $(this).closest('li');

        $.ajax({
            url: `/teacher/delete/lesson/${lessonId}`,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    showSuccessMessage(response.message || 'Lesson deleted successfully!');
                    lessonItem.fadeOut(400, function() {
                        $(this).remove();
                    });
                } else {
                    showErrorMessage(response.message || 'Failed to delete lesson.');
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                showErrorMessage('Something went wrong while deleting the lesson.');
            }
        });

        // ✅ Helper functions for messages (same as your section delete)
        function showSuccessMessage(message) {
            const alertBox = $(`
            <div class="alert-message bg-purple-100 border border-purple-300 text-purple-800 px-4 py-3 rounded-lg shadow-md mb-4">
                ${message}
            </div>
        `);
            $('.container').prepend(alertBox);
            setTimeout(() => alertBox.fadeOut(500, () => alertBox.remove()), 4000);
        }

        function showErrorMessage(message) {
            const alertBox = $(`
            <div class="alert-message bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg shadow-md mb-4">
                ${message}
            </div>
        `);
            $('.container').prepend(alertBox);
            setTimeout(() => alertBox.fadeOut(500, () => alertBox.remove()), 4000);
        }
    });
    //    view lesson
    $(document).on('click', '.lesson-item', function() {
        const lessonId = $(this).data('id');
        const lessonBox = $('#lessonContent');

        // Loader
        lessonBox.html(`
        <div class="flex flex-col items-center justify-center text-gray-500 py-20">
            <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-purple-600 mb-3"></div>
            <p>Loading lesson content...</p>
        </div>
    `);

        $.ajax({
            url: `/teacher/view/lesson/${lessonId}`,
            type: 'GET',
            success: function(response) {
                if (response.type === 'video') {
                    lessonBox.html(`
                    <video controls class="w-full h-[70vh] rounded-lg shadow-md">
                        <source src="${response.video_url}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <h2 class="mt-4 text-xl font-semibold text-gray-800">${response.title}</h2>
                    <p class="mt-2 text-gray-600">${response.content || ''}</p>
                `);
                } else if (response.type === 'file') {
                    lessonBox.html(`
                    <embed src="${response.file_path}" type="application/pdf" class="w-full h-[70vh] rounded-lg border" />
                    <h2 class="mt-4 text-xl font-semibold text-gray-800">${response.title}</h2>
                    <p class="mt-2 text-gray-600">${response.content || ''}</p>
                `);
                } else {
                    lessonBox.html(`
                    <h2 class="text-2xl font-semibold text-gray-800">${response.title}</h2>
                    <p class="mt-4 text-gray-700 leading-relaxed">${response.content || 'No content available.'}</p>
                `);
                }
            },
            error: function() {
                lessonBox.html(`
                <div class="text-red-500 text-center py-10">
                    <p>⚠️ Failed to load lesson content. Please try again.</p>
                </div>
            `);
            }
        });
    });
    //to manage the quiz modal
    let questionIndex = 1;

    document.getElementById('addQuestion').addEventListener('click', function() {
        const container = document.getElementById('questionsRepeater');
        const newQuestion = container.firstElementChild.cloneNode(true);

        // Update indices
        newQuestion.querySelectorAll('input, textarea').forEach((input) => {
            input.value = '';
            input.name = input.name.replace(/\d+/, questionIndex);
        });

        container.appendChild(newQuestion);
        questionIndex++;
    });

    // Delegate remove question and add/remove option
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-question')) {
            e.target.closest('.question-block').remove();
        }

        if (e.target.classList.contains('add-option')) {
            const optionsContainer = e.target.closest('.question-block').querySelector('.options');
            const optionCount = optionsContainer.children.length;
            const qIndex = Array.from(document.querySelectorAll('.question-block')).indexOf(e.target.closest(
                '.question-block'));

            const optionHTML = `
                <div class="flex items-center space-x-2 mt-2">
                    <input type="text" name="questions[${qIndex}][options][${optionCount}][option_text]"
                        placeholder="Option text"
                        class="flex-1 rounded-md border border-gray-300 focus:border-purple-500 focus:ring-purple-500 focus:ring-1 transition">
                    <label class="flex items-center space-x-1 text-sm text-gray-700">
                        <input type="checkbox" name="questions[${qIndex}][options][${optionCount}][is_correct]">
                        <span>Correct</span>
                    </label>
                    <button type="button"
                        class="remove-option bg-red-100 text-red-600 px-2 py-1 rounded hover:bg-red-200 text-xs">
                        Remove
                    </button>
                </div>`;
            optionsContainer.insertAdjacentHTML('beforeend', optionHTML);
        }

        if (e.target.classList.contains('remove-option')) {
            e.target.closest('div.flex').remove();
        }
    });
    //here ends the managing quiz modal
    $('#addQuizForm').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const formData = form.serialize();
        const actionUrl = form.attr('action');

        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    showSuccessMessage(response.message || 'Quiz added successfully!');

                    // ✅ Reset the form
                    form.trigger('reset');
                    // ✅ Close the dialog
                    form.closest('dialog')[0].close();


                } else {
                    showErrorMessage(response.message || 'Failed to add quiz.');
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                showErrorMessage('Something went wrong while adding the quiz.');
            }
        });
    });

    // ✅ Helper functions for messages (reuse your existing design)
    function showSuccessMessage(message) {
        const alertBox = $(`
        <div class="alert-message bg-purple-100 border border-purple-300 text-purple-800 px-4 py-3 rounded-lg shadow-md mb-4">
            ${message}
        </div>
    `);
        $('.container').prepend(alertBox);
        setTimeout(() => alertBox.fadeOut(500, () => alertBox.remove()), 4000);
    }

    function showErrorMessage(message) {
        const alertBox = $(`
        <div class="alert-message bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg shadow-md mb-4">
            ${message}
        </div>
    `);
        $('.container').prepend(alertBox);
        setTimeout(() => alertBox.fadeOut(500, () => alertBox.remove()), 4000);
    }
    //to show the quizzes
    $(document).ready(function() {

        $(document).on('click', '.get-quiz', function(e) {
            e.preventDefault();

            let url = $(this).attr('href');
            let contentDiv = $('#lessonContent');

            // Loader animation
            contentDiv.html(`
            <div class="flex flex-col items-center justify-center text-gray-500 py-10">
                <div class="loader border-4 border-purple-200 border-t-purple-600 rounded-full w-10 h-10 animate-spin mb-3"></div>
                <p>Loading quiz...</p>
            </div>
        `);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.success && response.quiz) {
                        let quiz = response.quiz;

                        let html = `
                        <div class="w-full text-left">
                            <h2 class="text-2xl font-bold text-purple-700 mb-4">${quiz.title}</h2>
                            <p class="text-gray-600 mb-6">${quiz.description ?? ''}</p>
                    `;

                        if (quiz.questions.length > 0) {
                            html += `<ul class="space-y-6">`;
                            quiz.questions.forEach((question, index) => {
                                html += `
                                <li class="border rounded-lg p-4 bg-gray-50">
                                    <h3 class="font-semibold text-gray-800 mb-2">
                                        Q${index + 1}: ${question.question}
                                    </h3>
                                    <ul class="space-y-2 pl-4">`;

                                question.options.forEach(option => {
                                    html += `
                                    <li class="flex items-center gap-2">
                                        <input type="radio" name="q${question.id}" value="${option.id}" class="text-purple-600 focus:ring-purple-500">
                                        <span>${option.option_text}</span>
                                    </li>
                                `;
                                });

                                html += `</ul></li>`;
                            });
                            html += `</ul>`;
                        } else {
                            html +=
                                `<p class="text-gray-500 italic">No questions added yet.</p>`;
                        }

                        html += `</div>`;
                        contentDiv.hide().html(html).fadeIn(300);

                    } else {
                        contentDiv.html(
                            `<p class="text-red-600 p-4">Failed to load quiz data.</p>`);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    $('#lessonContent').html(`
                    <div class="text-red-600 p-4">
                        Something went wrong while loading the quiz.
                    </div>
                `);
                }
            });
        });

    });
    //delete the quiz

    $(document).on('click', '.delete-quiz', function() {


        let quizId = $(this).data('id');
        let quizItem = $(this).closest('li');

        $.ajax({
            url: '/teacher/delete/quiz/' + quizId,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    quizItem.fadeOut(300, function() {
                        $(this).remove();
                    });

                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Something went wrong!');
            }
        });
    });
</script>
