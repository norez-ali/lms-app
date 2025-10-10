<div class="container-fluid">
    <div class="row pb-50 mb-10">
        <div class="col-auto">
            <h1 class="text-30 lh-12 fw-700">Manage Instructor Applications</h1>
            <div class="mt-10">Review, Accept or Reject instructor applications.</div>
        </div>
    </div>

    <!-- Applications Grid -->
    <div class="row y-gap-30">
        <!-- Alert Placeholder -->
        <div id="alertBox" class="hidden w-full mb-6"></div>
        @forelse ($requests as $request)
            @php
                $teacher = $request->teacher;
                $course = $request->course;
            @endphp

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                <div class="bg-white rounded-16 text-center p-6 shadow-sm flex flex-col items-center justify-between transition-all hover:shadow-md border border-gray-100"
                    style="min-height: 360px; position: relative;">

                    <!-- Teacher Profile Photo -->
                    <div
                        class="mb-4 mt-3 w-[120px] h-[120px] rounded-full overflow-hidden flex items-center justify-center bg-gray-50 shadow-inner">
                        <img src="{{ $teacher->profile && $teacher->profile->profile_photo ? asset('storage/' . $teacher->profile->profile_photo) : asset('assets/img/dashboard/edit/1.png') }}"
                            alt="{{ $teacher->name }}"
                            class="object-cover w-full h-full transition-transform duration-300 hover:scale-105 rounded-full">
                    </div>

                    <!-- Teacher Name -->
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $teacher->name }}</h3>

                    <!-- Email -->
                    <p class="text-sm text-gray-500 mb-3">{{ $teacher->email }}</p>

                    <!-- Course Info -->
                    <div class="bg-purple-50 rounded-lg px-3 py-2 mb-3 w-full">
                        <p class="text-sm text-gray-700 font-medium mb-1">
                            <span class="text-purple-600">Course:</span> {{ $course->title ?? 'Untitled Course' }}
                        </p>
                        <p class="text-xs text-gray-500">
                            Category: {{ $course->category->name ?? 'Uncategorized' }}
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 w-full mt-2">
                        <button
                            class="approve-request w-1/2 bg-green-100 text-green-700 border border-green-300 font-semibold py-2 rounded-lg hover:bg-green-600 hover:text-white transition"
                            data-request-id="{{ $request->id }}">
                            Approve
                        </button>

                        <button
                            class="reject-request w-1/2 bg-red-100 text-red-700 border border-red-300 font-semibold py-2 rounded-lg hover:bg-red-600 hover:text-white transition"
                            data-request-id="{{ $request->id }}">
                            Reject
                        </button>
                    </div>
                </div>
            </div>

        @empty
            <div class="col-12">
                <p class="text-center text-gray-500 text-lg mt-10">No pending instructor applications found.</p>
            </div>
        @endforelse
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.approve-request').on('click', function(e) {
            e.preventDefault();

            let button = $(this);
            let requestId = button.data('request-id');

            $.ajax({
                url: `/admin/approve/application/${requestId}`,
                type: 'PUT',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    let alertBox = $('#alertBox');

                    if (response.success) {
                        // ✅ Success Alert
                        alertBox
                            .removeClass('hidden bg-red-100 text-red-700 border-red-300')
                            .addClass(
                                'bg-green-100 text-green-700 border-green-300 border rounded-lg p-4 text-center font-semibold'
                            )
                            .html(response.message)
                            .hide()
                            .fadeIn(300);

                        // Update button UI
                        button.text('Approved')
                            .removeClass('bg-green-100 text-green-700 border-green-300')
                            .addClass('bg-green-600 text-white cursor-not-allowed')
                            .prop('disabled', true);

                        // Fade out card
                        button.closest('.col-xl-3').fadeOut(800, function() {
                            $(this).remove();
                        });

                        // Redirect to admin dashboard after 1.5s
                        setTimeout(() => {
                            window.location.href = '/admin/dashboard';
                        }, 1500);
                    } else {
                        // ❌ Error Alert
                        alertBox
                            .removeClass(
                                'hidden bg-green-100 text-green-700 border-green-300')
                            .addClass(
                                'bg-red-100 text-red-700 border-red-300 border rounded-lg p-4 text-center font-semibold'
                            )
                            .html(response.message)
                            .hide()
                            .fadeIn(300);
                    }
                },
                error: function(xhr) {
                    $('#alertBox')
                        .removeClass('hidden bg-green-100 text-green-700 border-green-300')
                        .addClass(
                            'bg-red-100 text-red-700 border-red-300 border rounded-lg p-4 text-center font-semibold'
                        )
                        .html('❌ Something went wrong. Please try again.')
                        .hide()
                        .fadeIn(300);
                }
            });
        });
    });
    $(document).on('click', '.reject-request', function(e) {
        e.preventDefault();

        let button = $(this);
        let requestId = button.data('request-id');

        $.ajax({
            url: `/admin/reject/application/${requestId}`, // adjust if your route prefix differs
            type: 'PUT',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                button.text('Rejecting...');
            },
            success: function(response) {
                if (response.success) {
                    // Show success message
                    $('body').prepend(`
                    <div class="alert alert-success text-center py-3">
                        ${response.message}
                    </div>
                `);

                    // Fade out rejected card and redirect
                    button.closest('.col-xl-3, .col-lg-4, .col-md-6, .col-sm-12')
                        .fadeOut(800, function() {
                            $(this).remove();
                        });

                    setTimeout(() => window.location.href = '/admin/dashboard', 1500);
                } else {
                    $('body').prepend(`
                    <div class="alert alert-danger text-center py-3">
                        ${response.message}
                    </div>
                `);
                }
            },
            error: function(xhr) {
                $('body').prepend(`
                <div class="alert alert-danger text-center py-3">
                    An error occurred: ${xhr.statusText}
                </div>
            `);
            },
            complete: function() {
                button.text('Reject');
            }
        });
    });
</script>
