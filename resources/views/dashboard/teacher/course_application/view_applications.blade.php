<div class="container mx-auto px-6 py-8">
    <div class="mb-8 border-b pb-4">
        <h1 class="text-3xl font-bold text-gray-800">My Instructor Applications</h1>
        <p class="text-gray-500 mt-2">View the status of your instructor applications.</p>
    </div>

    <!-- Application Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse ($applications as $application)
            @php
                $course = $application->course;
            @endphp

            <div
                class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-all p-6 flex flex-col items-center text-center">

                <!-- Course Thumbnail -->
                <div
                    class="w-36 h-36 rounded-full overflow-hidden bg-gray-100 shadow-sm flex items-center justify-center mb-4">
                    <img src="{{ $course && $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('assets/img/dashboard/edit/1.png') }}"
                        alt="{{ $course->title ?? 'Course' }} image"
                        class="w-full h-full object-cover rounded-full transition-transform duration-300 hover:scale-105">
                </div>

                <!-- Course Info -->
                <h3 class="text-lg font-semibold text-gray-800 mb-1">
                    {{ $course->title ?? 'Untitled Course' }}
                </h3>

                <p class="text-sm text-gray-500 mb-2">
                    {{ $course && $course->category ? $course->category->name : 'Uncategorized' }}
                </p>

                <!-- Status Badge -->
                <div class="mb-4">
                    @if ($application->status === 'pending')
                        <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-800 font-medium">
                            Pending
                        </span>
                    @elseif ($application->status === 'rejected')
                        <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-700 font-medium">
                            Rejected
                        </span>
                    @elseif ($application->status === 'approved')
                        <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700 font-medium">
                            Approved
                        </span>
                    @endif
                </div>

                <!-- Buttons -->
                <div class="w-full">
                    @if ($application->status === 'pending')
                        <a href="{{ route('teacher.withdraw.course', $course->id) }} "
                            class="w-full bg-red-100 text-red-600 border px-3 border-red-300 font-semibold py-2 rounded-lg hover:bg-red-600 hover:text-white transition withdraw-request">
                            Withdraw Request
                        </a>
                    @elseif ($application->status === 'rejected')
                        <a href="{{ route('teacher.apply.course', $course->id) }} "
                            class="request-course button -sm -outline-purple-1 text-purple-1 hover:bg-purple-1 hover:text-white transition-all w-100 mb-10">
                            ReApply
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-10">
                <p class="text-gray-500 text-lg">You haven’t applied for any courses yet.</p>
            </div>
        @endforelse
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.request-course').on('click', function(e) {
            e.preventDefault(); // ✅ Stop the default anchor action

            let button = $(this);
            let url = button.attr('href');
            let card = button.closest(
                '.card, .col-xl-3, .col-lg-4, .col-md-6, .col-sm-12'); // ✅ parent card div

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    button.text('Processing...').prop('disabled', true);
                },
                success: function(response) {
                    // Fade out and remove the card
                    card.fadeOut(600, function() {
                        $(this).remove();
                    });

                    // Optional success alert
                    $('body').append(`
                    <div id="successMessage" class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow">
                        ${response.message ?? 'Request sent successfully!'}
                    </div>
                `);

                    // Redirect after short delay
                    setTimeout(() => {
                        $('#successMessage').fadeOut(400, function() {
                            $(this).remove();
                            window.location =
                                "{{ route('teacher.dashboard') }}";
                        });
                    }, 1500);
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                },
                complete: function() {
                    button.text('Apply').prop('disabled', false);
                }
            });
        });
    });
    $(document).ready(function() {
        $('.withdraw-request').on('click', function(e) {
            e.preventDefault();

            if (!confirm('Are you sure you want to withdraw this course request?')) return;

            let url = $(this).attr('href');
            let card = $(this).closest('.course-card');

            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Smooth fade-out and removal
                        card.fadeOut(500, function() {
                            $(this).remove();
                        });

                        // Show success alert
                        alert(response.message);

                        // Redirect after short delay
                        setTimeout(function() {
                            window.location.href =
                                "{{ route('teacher.dashboard') }}";
                        }, 1000);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('Something went wrong.');
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
