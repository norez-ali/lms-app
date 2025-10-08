<div class="container-fluid">
    <div class="row pb-50 mb-10">
        <div class="col-auto">
            <h1 class="text-30 lh-12 fw-700">Course Management</h1>
            <div class="mt-10">Manage and Create Courses.</div>
        </div>
    </div>

    <!-- Add New Course Button -->
    <div class="row y-gap-30 mb-30">
        <div class="col-12 col-md-6">
            <a href="{{ route('admin.create.course') }}"
                class="control-dshb button -md -purple-1 text-white hover:opacity-90 transition-all">
                <i class="icon-plus mr-10"></i> Add New Course
            </a>
        </div>
    </div>

    <!-- Course Grid -->
    <div class="row y-gap-30">
        @forelse ($courses as $course)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                <div class="bg-light-3 rounded-16 text-center p-30 shadow-sm d-flex flex-column align-items-center justify-content-between transition-all hover:shadow-md"
                    style="min-height: 320px; position: relative;">

                    <!-- Course Thumbnail -->
                    <div class="mb-15 mt-25"
                        style="width:150px; height:150px; border-radius:50%; overflow:hidden; display:flex; align-items:center; justify-content:center; background:#f8f9fa; box-shadow:0 2px 8px rgba(0,0,0,0.05);">
                        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('assets/img/dashboard/edit/1.png') }}"
                            alt="{{ $course->title }} image"
                            style="width:100%; height:100%; object-fit:cover; border-radius:50%; transition:transform 0.3s;">
                    </div>

                    <!-- Course Title -->
                    <h3 class="text-17 fw-600 text-dark-1 mb-10">{{ $course->title }}</h3>

                    <!-- Category Name -->
                    <p class="text-14 text-gray-600 mb-5">
                        {{ $course->category ? $course->category->name : 'Uncategorized' }}
                    </p>

                    <!-- Level -->
                    <p class="text-13 text-light-1 mb-15">{{ $course->level ?? 'N/A' }}</p>

                    <!-- Teacher Name -->
                    <span class="text-13 text-purple-1 mb-10">
                        {{ $course->teacher ? 'By ' . $course->teacher->name : 'No Instructor Assigned' }}
                    </span>

                    <!-- Manage Button -->
                    <a href="{{ route('admin.edit.course', $course->id) }}"
                        class="control-dshb button -sm -outline-purple-1 text-purple-1 hover:bg-purple-1 hover:text-white transition-all w-100 mb-10">
                        Manage Course
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-16 text-light-1">No courses found. Click "Add New Course" to get started.</p>
            </div>
        @endforelse
    </div>
</div>
