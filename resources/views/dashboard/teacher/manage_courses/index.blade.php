<div class="container mx-auto px-4 py-8">
    {{-- Header --}}
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-gray-800">Course Management</h1>
        <p class="text-gray-500 mt-2">Assigned courses are listed below click to add a lesson or a quiz .</p>
    </div>

    {{-- Courses Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse ($courses as $course)
            <a href="{{ route('teacher.edit.course', $course->id) }}" class="control-dshb">
                <div
                    class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">

                    {{-- Thumbnail --}}
                    <div class="relative w-full overflow-hidden bg-gray-100">
                        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('assets/img/coursesCards/1.png') }}"
                            alt="Course Image" class="w-full h-auto transition-transform duration-300 hover:scale-105">
                    </div>


                    {{-- Course Details --}}
                    <div class="p-4">
                        {{-- Rating and Created At --}}
                        <div class="flex items-center text-sm mb-2">
                            <span class="text-yellow-500 font-semibold mr-1">★ 4.5</span>
                            <span class="text-gray-500">({{ $course->created_at->diffForHumans() }})</span>
                        </div>

                        {{-- Title --}}
                        <h3 class="font-semibold text-gray-800 text-lg mb-1">
                            {{ $course->title ?? 'Untitled Course' }}
                        </h3>

                        {{-- Category --}}
                        <p class="text-gray-500 text-sm mb-3 text-center">
                            {{ $course->category->name ?? 'Uncategorized' }}
                        </p>

                        {{-- Course Info --}}
                        <div class="flex flex-wrap gap-3 text-xs text-gray-500 mb-4">
                            <div class="flex items-center gap-1"><i class="fa fa-play-circle text-primary"></i>6 Lessons
                            </div>
                            <div class="flex items-center gap-1"><i class="fa fa-clock text-primary"></i>3h 56m</div>
                            <div class="flex items-center gap-1"><i class="fa fa-signal text-primary"></i>Beginner</div>
                        </div>

                        {{-- Footer --}}
                        <div class="flex justify-between items-center border-t border-gray-200 pt-3">
                            <div class="flex items-center gap-2">
                                <img src="{{ $course->teacher->profile->profile_photo ? asset($course->teacher->profile->profile_photo) : asset('assets/img/general/avatar-1.png') }}"
                                    class="rounded-full w-8 h-8 object-cover" alt="Instructor">
                                <span class="text-sm font-medium text-gray-800">
                                    {{ $course->teacher->name ?? 'Ali Tufan' }}
                                </span>
                            </div>

                            <div class="text-right">

                                <div class="text-green-600 font-bold">PKR 79</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-10">
                <p class="text-gray-500 text-lg">No courses found. Assigned courses will appear here.</p>
            </div>
        @endforelse
    </div>
</div>
