<div class="container-fluid">
    <!-- Page Header -->
    <div class="row pb-50 mb-10">
        <div class="col-auto">
            <h1 class="text-30 lh-12 fw-700">Manage Users</h1>
            <div class="mt-10 text-gray-600">View and manage Students and Teachers. You can delete any user if needed.
            </div>
        </div>
    </div>

    <!-- User Management Grid -->
    <div class="row y-gap-40">
        <!-- Students Section -->
        <div class="col-12">
            <h2 class="text-24 font-semibold text-gray-800 mb-4">Students</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Single Student Card -->
                @forelse ($students as $student)
                    <div
                        class="bg-white rounded-16 p-6 text-center border border-gray-100 shadow-sm hover:shadow-md transition-all"id="user-card-{{ $student->id }}">
                        <div class="w-24 h-24 mx-auto mb-4 rounded-full overflow-hidden shadow-inner bg-gray-50">
                            <img src="{{ $student?->profile?->profile_photo ? asset('storage/' . $student?->profile?->profile_photo) : asset('assets/img/dashboard/edit/1.png') }}"
                                alt="Student" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $student->name }}</h3>
                        <p class="text-sm text-gray-500 mb-3">{{ $student->email }}</p>


                        <button
                            class="delete-user bg-red-100 text-red-700 border border-red-300 font-semibold px-4 py-2 rounded-lg hover:bg-red-600 hover:text-white transition w-full"
                            data-user-id="{{ $student->id }}" data-role="{{ $student->role }}">
                            Delete
                        </button>
                    </div>
                @empty
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">No Students</h3>
                @endforelse
            </div>
        </div>

        <!-- Teachers Section -->
        <div class="col-12 mt-16">
            <h2 class="text-24 font-semibold text-gray-800 mb-4">Teachers</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($teachers as $teacher)
                    <!-- Single Teacher Card -->
                    <div class="bg-white rounded-16 p-6 text-center border border-gray-100 shadow-sm hover:shadow-md transition-all"
                        id="user-card-{{ $teacher->id }}">
                        <div class="w-24 h-24 mx-auto mb-4 rounded-full overflow-hidden shadow-inner bg-gray-50">
                            <img src="{{ asset('assets/img/dashboard/edit/1.png') }}" alt="Teacher"
                                class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $teacher->name }}</h3>
                        <p class="text-sm text-gray-500 mb-3">{{ $teacher->email }}</p>


                        <button
                            class="delete-user bg-red-100 text-red-700 border border-red-300 font-semibold px-4 py-2 rounded-lg hover:bg-red-600 hover:text-white transition w-full"
                            data-user-id="{{ $teacher->id }}" data-role="{{ $teacher->role }}">
                            Delete
                        </button>
                    </div>
                @empty
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">No Teachers</h3>
                @endforelse


            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        // Handle Delete Button Click
        $('.delete-user').on('click', function(e) {
            e.preventDefault();

            let userId = $(this).data('user-id');
            let card = $('#user-card-' + userId);

            if (!confirm('Are you sure you want to delete this user?')) {
                return;
            }

            $.ajax({
                url: `/delete/users/${userId}`,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        // Fade out and remove the card
                        card.fadeOut(500, function() {
                            $(this).remove();
                        });

                        // Optional success alert
                        $('#alertBox').removeClass('hidden').addClass(
                                'bg-green-100 text-green-700 p-3 rounded-md mb-4')
                            .text(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseJSON?.message ?? 'Something went wrong!');
                }
            });
        });
    });
</script>
