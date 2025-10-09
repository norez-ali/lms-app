<div class="container-fluid">
    <div class="row pb-50 mb-10">
        <div class="col-auto">
            <h1 class="text-30 lh-12 fw-700">Courses categories</h1>
            <div class="mt-10">Browse categories to make application as Instructor.</div>
        </div>
    </div>



    <div class="row y-gap-30">
        @forelse ($categories as $category)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                <div class="bg-light-3 rounded-16 text-center p-30 shadow-sm d-flex flex-column align-items-center justify-content-between transition-all hover:shadow-md"
                    style="min-height: 280px; position: relative;">

                    <!-- Rounded Image -->
                    <div class="mb-15 mt-25"
                        style="width:150px; height:150px; border-radius:50%; overflow:hidden; display:flex; align-items:center; justify-content:center; background:#f8f9fa; box-shadow:0 2px 8px rgba(0,0,0,0.05);">
                        <img src="{{ asset($category->image ?? 'assets/img/dashboard/edit/1.png') }}"
                            alt="{{ $category->name }} image"
                            style="width:100%; height:100%; object-fit:cover; border-radius:50%; transition:transform 0.3s;">
                    </div>


                    <!-- Category Name -->
                    <h3 class="text-17 fw-600 text-dark-1 mb-15">{{ $category->name }}</h3>
                    @php
                        $course_count = $category->courses->count();
                    @endphp

                    <!-- Courses Count (spaced slightly inward) -->
                    <span class="position-absolute top-15 end-20 text-14 text-purple-1 fw-500">
                        {{ $course_count ?? 0 }}+ Courses
                    </span>

                    <!-- Manage Button (added more bottom space) -->
                    <a href="{{ route('teacher.view.courses', $category->id) }}"
                        class="control-dshb button -sm -outline-purple-1 text-purple-1 hover:bg-purple-1 hover:text-white transition-all w-100 mb-15">
                        Browse Courses
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-16 text-light-1">No categories found. Click "Add New Category" to get started.</p>
            </div>
        @endforelse
    </div>
</div>
