<!-- resources/views/teacher/courses.blade.php -->
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-12">

    <div class="mb-10 border-b border-gray-200 pb-5">
        <h1 class="text-2xl lg:text-3xl font-semibold text-gray-800 tracking-tight">
            {{ $course->title }}
        </h1>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6 md:p-10 mb-12 border border-gray-100">

        {{-- Course Header --}}
        <div class="flex flex-col lg:flex-row items-start lg:items-center gap-6 mb-10 pb-6 border-b border-gray-200">

            <div class="rounded-2xl ring-2 ring-gray-100 shadow-sm">
                <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('assets/img/dashboard/edit/1.png') }}"
                    alt="Course Thumbnail" class="w-32 h-32 md:w-40 md:h-40 rounded-xl object-cover">
            </div>

            <div class="flex flex-col gap-2">
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Course Overview</p>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 tracking-tight">
                    {{ $course->title }}
                </h2>
                <div class="flex items-center space-x-6 mt-1 text-gray-500 text-sm">
                    <p>
                        <i class="fas fa-signal text-[#8b5cf6] mr-1"></i>
                        <span class="font-semibold">Level:</span> {{ $course->level }}
                    </p>
                    <p>
                        <i class="fas fa-volume-up text-[#8b5cf6] mr-1"></i>
                        <span class="font-semibold">Audio:</span> {{ $course->audio_language }}
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Left Sidebar --}}
            <div
                class="lg:col-span-1 rounded-xl bg-white shadow p-5 border border-gray-200 overflow-y-auto max-h-[85vh]">

                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-book-reader text-[#8b5cf6]"></i> Course Curriculum
                </h3>

                <div class="space-y-3">
                    @foreach ($course->sections as $section)
                        <div class="rounded-lg border border-gray-200 overflow-hidden shadow-sm transition-all duration-200 hover:shadow-md"
                            data-id="{{ $section->id }}">

                            <button
                                class="w-full flex justify-between items-center bg-gray-50 text-gray-800 px-4 py-2 font-medium hover:bg-gray-100 transition-colors section-toggle group">
                                <span class="flex items-center gap-2 text-left">
                                    <i class="far fa-folder text-[#8b5cf6]"></i>
                                    {{ $section->title }}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-gray-400 group-hover:text-[#8b5cf6] transition-transform duration-300 transform"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div class="hidden bg-gray-50 p-3 text-sm text-gray-700 border-t border-gray-100">
                                @if ($section->lessons->isNotEmpty())
                                    <ul class="space-y-2">
                                        @foreach ($section->lessons as $lesson)
                                            <li class="lesson-item flex items-center pl-3 pr-2 py-2 bg-gray-100 rounded-lg border border-gray-200 cursor-pointer hover:bg-gray-200 transition-all duration-200"
                                                data-id="{{ $lesson->id }}">
                                                <a href="javascript:void(0);"
                                                    class="font-medium text-gray-700 text-sm flex items-center gap-2 hover:text-[#8b5cf6]">
                                                    <i class="fas fa-play-circle text-[#8b5cf6]"></i>
                                                    {{ $lesson->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-gray-400 italic px-2">No lessons in this section.</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 pt-4 border-t border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <i class="fas fa-trophy text-[#8b5cf6]"></i> Assessments
                    </h3>

                    @if ($course->quizzes->isNotEmpty())
                        <ul class="space-y-2">
                            @foreach ($course->quizzes as $quiz)
                                <li class="get-quiz flex items-center px-4 py-3 bg-white border border-gray-200 rounded-lg shadow-sm cursor-pointer hover:bg-gray-50 transition-all duration-200"
                                    data-url="{{ route('student.view.quiz', $quiz->id) }}">
                                    <a href="javascript:void(0);"
                                        class="text-gray-700 font-medium text-sm flex items-center gap-2 hover:text-[#8b5cf6]">
                                        <i class="fas fa-clipboard-check text-[#8b5cf6]"></i>
                                        {{ $quiz->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-400 italic">No quizzes added yet.</p>
                    @endif
                </div>
            </div>

            {{-- Lesson Display --}}
            <div id="lessonContent"
                class="lg:col-span-2 bg-gray-50 border border-gray-200 rounded-xl shadow-inner p-8 flex flex-col items-center justify-center text-gray-500 w-full min-h-[500px] max-h-[85vh] overflow-y-auto text-center">

                <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('assets/img/dashboard/edit/1.png') }}"
                    alt="Course Placeholder" class="max-w-xs opacity-40 mb-4 rounded-xl">
                <p class="text-lg font-semibold text-gray-600">
                    Select a content item to begin.
                </p>
                <p class="text-sm text-gray-500 mt-1">
                    Choose a lesson or assessment from the sidebar.
                </p>
            </div>
        </div>

        {{-- Course Description --}}
        <div class="mt-16 space-y-8 text-gray-800 leading-relaxed border-t border-gray-200 pt-10">

            <h3 class="text-xl font-bold text-gray-800 mb-4">Course Description</h3>

            <div class="space-y-6">
                @if ($course->short_description)
                    <div class="p-5 bg-white rounded-xl border border-gray-200 shadow-sm">
                        <h4 class="font-semibold text-lg text-gray-700 mb-2 flex items-center gap-2">
                            <i class="fas fa-feather-alt text-[#8b5cf6]"></i> Short Summary
                        </h4>
                        <p class="text-gray-700">{{ $course->short_description }}</p>
                    </div>
                @endif

                @if ($course->description)
                    <div class="p-5 bg-white rounded-xl border border-gray-200 shadow-sm">
                        <h4 class="font-semibold text-lg text-gray-700 mb-2 flex items-center gap-2">
                            <i class="fas fa-scroll text-[#8b5cf6]"></i> Comprehensive Description
                        </h4>
                        <div class="text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $course->description }}</div>
                    </div>
                @endif
            </div>

            {{-- Learning Outcomes & Requirements --}}
            <h3 class="text-xl font-bold text-gray-800 pt-4 mb-4">Goals & Prerequisites</h3>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @if ($course->learning_outcomes)
                    <div class="p-5 bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition">
                        <h4 class="font-semibold text-lg text-gray-800 mb-3 flex items-center gap-2">
                            <i class="fas fa-bullseye text-[#8b5cf6]"></i> What You Will Learn
                        </h4>
                        <ul class="list-disc pl-6 text-gray-700 space-y-2 marker:text-[#8b5cf6]">
                            <li>{{ $course->learning_outcomes }}</li>
                        </ul>
                    </div>
                @endif

                @if ($course->requirements)
                    <div class="p-5 bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition">
                        <h4 class="font-semibold text-lg text-gray-800 mb-3 flex items-center gap-2">
                            <i class="fas fa-tools text-[#8b5cf6]"></i> Requirements / Prerequisites
                        </h4>
                        <ul class="list-disc pl-6 text-gray-700 space-y-2 marker:text-[#8b5cf6]">
                            <li>{{ $course->requirements }}</li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>



<!-- Simple dropdown toggle -->
<script>
    $(document).on('click', '.section-toggle', function() {
        const next = $(this).next();
        next.toggleClass('hidden');

        const icon = $(this).find('svg');
        icon.toggleClass('rotate-180');
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
            url: `/student/lesson/view/${lessonId}`,
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
    $(document).on('click', '.get-quiz', function() {
        const url = $(this).data('url');
        const lessonContent = $('#lessonContent');

        // Loader (same style as lesson loader)
        lessonContent.html(`
        <div class="flex flex-col items-center justify-center text-gray-500 py-20">
            <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-purple-600 mb-3"></div>
            <p>Loading quiz...</p>
        </div>
    `);

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                if (response.success && response.quiz) {
                    const quiz = response.quiz;
                    let html = `
                    <div class="w-full text-left" id="quiz-container" data-quiz-id="${quiz.id}">
                        <h2 class="text-2xl font-bold text-purple-700 mb-4">${quiz.title}</h2>
                        <p class="text-gray-600 mb-6">${quiz.description ?? ''}</p>
                        <form id="quizForm">
                `;

                    if (quiz.questions.length > 0) {
                        quiz.questions.forEach((question, index) => {
                            html += `
                            <div class="border rounded-lg p-4 mb-4 bg-gray-50">
                                <h3 class="font-semibold text-gray-800 mb-2">
                                    Q${index + 1}: ${question.question}
                                </h3>
                                <ul class="space-y-2 pl-4">
                        `;
                            question.options.forEach(option => {
                                html += `
                                <li class="flex items-center gap-2">
                                    <input type="radio" name="q${question.id}" value="${option.id}" class="text-purple-600 focus:ring-purple-500">
                                    <span>${option.option_text}</span>
                                </li>
                            `;
                            });
                            html += `</ul></div>`;
                        });

                        html += `
                        <button type="submit" class="mt-4 px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                            Submit Quiz
                        </button>
                    `;
                    } else {
                        html += `<p class="text-gray-500 italic">No questions available.</p>`;
                    }

                    html += `</form></div>`;
                    lessonContent.hide().html(html).fadeIn(300);
                } else {
                    lessonContent.html(`<p class="text-red-600 p-4">Quiz not found.</p>`);
                }
            },
            error: function() {
                lessonContent.html(`<p class="text-red-600 p-4">Error loading quiz.</p>`);
            }
        });
    });

    // ✅ Handle quiz submission (same page)
    $(document).on('submit', '#quizForm', function(e) {
        e.preventDefault();

        const quizContainer = $('#quiz-container');
        const quizId = quizContainer.data('quiz-id');
        const formData = {};

        $('#quizForm input[type="radio"]:checked').each(function() {
            const qid = $(this).attr('name').replace('q', '');
            formData[qid] = $(this).val();
        });

        $.ajax({
            url: `/student/quiz/${quizId}/submit`,
            type: 'POST',
            data: {
                answers: formData,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#lessonContent').html(`
                <div class="text-center py-10">
                    <h2 class="text-2xl font-bold text-purple-700 mb-4">Quiz Submitted!</h2>
                    <p class="text-gray-700">You scored <strong>${response.score}</strong> out of <strong>${response.total}</strong>.</p>
                    <p class="text-lg mt-2 font-semibold text-purple-600">${response.percentage}%</p>
                </div>
            `);
            },
            error: function() {
                alert('Something went wrong while submitting your quiz.');
            }
        });
    });
</script>
