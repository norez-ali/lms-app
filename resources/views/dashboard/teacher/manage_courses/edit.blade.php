<!-- resources/views/teacher/courses.blade.php -->
<div class="container mx-auto px-6 py-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row items-center justify-between mb-10">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manage your course, sections, and lessons.</h1>

        </div>

        <div class="flex gap-3 mt-4 md:mt-0">

            <a class="bg-purple-100 hover:bg-purple-200 text-purple-700 px-4 py-2 rounded-lg shadow transition">
                Add Section
            </a>
            <a class="bg-purple-100 hover:bg-purple-200 text-purple-700 px-4 py-2 rounded-lg shadow transition">
                Add Quiz
            </a>
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

        <!-- Sections and Lessons -->
        <div class="mt-10 border-t border-gray-200 pt-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Course Sections</h3>

            <div class="space-y-4">
                <!-- Section 1 -->
                @foreach ($course->sections as $section)
                    <div class="border rounded-xl overflow-hidden section-item" data-id="{{ $section->id }}">
                        <button
                            class="w-full flex justify-between items-center bg-purple-50 text-purple-700 px-5 py-3 font-medium hover:bg-purple-100 transition section-toggle">

                            <span class="flex items-center gap-2">
                                <i class="far fa-folder text-purple-600 text-lg"></i>
                                {{ $section->title }}
                            </span>

                            <div class="flex items-center gap-4">
                                <!-- Delete icon -->
                                <i class="fas fa-trash text-red-500 hover:text-red-700 cursor-pointer delete-section"
                                    data-id="{{ $section->id }}" title="Delete Section"></i>

                                <!-- Dropdown arrow -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>

                        <div class="hidden bg-gray-50 p-5 text-sm text-gray-700">
                            <ul class="list-disc pl-5 space-y-1">
                                <li>Lesson 1: Introduction to HTML</li>
                                <li>Lesson 2: Tags & Attributes</li>
                                <li>Quiz: Basic HTML Elements</li>
                            </ul>
                        </div>
                    </div>
                @endforeach


                <!-- Section 2 -->
                <div class="border rounded-xl overflow-hidden">
                    <button
                        class="w-full flex justify-between items-center bg-purple-50 text-purple-700 px-5 py-3 font-medium hover:bg-purple-100 transition section-toggle">
                        Section 2: CSS Essentials
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div class="hidden bg-gray-50 p-5 text-sm text-gray-700">
                        <ul class="list-disc pl-5 space-y-1">
                            <li>Lesson 1: Styling Basics</li>
                            <li>Lesson 2: Flexbox Layout</li>
                            <li>Quiz: CSS Selectors</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Simple dropdown toggle -->
<script>
    document.querySelectorAll('.section-toggle').forEach(button => {
        button.addEventListener('click', () => {
            const next = button.nextElementSibling;
            next.classList.toggle('hidden');
            const icon = button.querySelector('svg');
            icon.classList.toggle('rotate-180');
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
</script>
