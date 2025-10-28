@extends('layouts.dashboard.main')
@section('content')
    <div class="dashboard__main">

        <div class="dashboard__content bg-light-4">
            <div class="row pb-50 mb-10">
                <div class="col-auto">
                    <h1 class="text-30 lh-12 fw-700">Dashboard</h1>
                    <div class="mt-10">
                        LMS Details and Statistics.
                    </div>
                </div>
            </div>

            <div class="row y-gap-30">
                <div class="col-xl-3 col-md-6">
                    <div
                        class="d-flex justify-between items-center py-35 px-30 rounded-16 bg-white -dark-bg-dark-1 shadow-4">
                        <div>
                            <div class="lh-1 fw-500">Total Sales</div>
                            <div class="text-24 lh-1 fw-700 text-dark-1 mt-20">
                                ${{ $totalPayments ?? '0' }}
                            </div>
                            <div class="lh-1 mt-25">
                                <span class="text-purple-1">$50</span> New Sales
                            </div>
                        </div>

                        <i class="text-40 icon-coupon text-purple-1"></i>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div
                        class="d-flex justify-between items-center py-35 px-30 rounded-16 bg-white -dark-bg-dark-1 shadow-4">
                        <div>
                            <div class="lh-1 fw-500">Total Courses</div>
                            <div class="text-24 lh-1 fw-700 text-dark-1 mt-20">
                                {{ $totalCourses->count() ?? '0' }}
                            </div>
                            <div class="lh-1 mt-25">
                                <span class="text-purple-1">{{ $totalCourses->count() ?? '0' }}+</span> New Courses
                            </div>
                        </div>

                        <i class="text-40 icon-play-button text-purple-1"></i>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div
                        class="d-flex justify-between items-center py-35 px-30 rounded-16 bg-white -dark-bg-dark-1 shadow-4">
                        <div>
                            <div class="lh-1 fw-500">Total Students</div>
                            <div class="text-24 lh-1 fw-700 text-dark-1 mt-20">
                                {{ $students ?? '0' }}
                            </div>
                            <div class="lh-1 mt-25">
                                <span class="text-purple-1">{{ $students ?? '0' }}+</span> New Students
                            </div>
                        </div>

                        <i class="text-40 icon-graduate-cap text-purple-1"></i>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div
                        class="d-flex justify-between items-center py-35 px-30 rounded-16 bg-white -dark-bg-dark-1 shadow-4">
                        <div>
                            <div class="lh-1 fw-500">Total Instructor</div>
                            <div class="text-24 lh-1 fw-700 text-dark-1 mt-20">
                                {{ $teachers->count() ?? '0' }}
                            </div>
                            <div class="lh-1 mt-25">
                                <span class="text-purple-1">{{ $teachers->count() ?? '0' }}+</span> New
                                Instructors
                            </div>
                        </div>

                        <i class="text-40 icon-online-learning text-purple-1"></i>
                    </div>
                </div>
            </div>



            <div class="row y-gap-30 pt-30">
                <div class="col-xl-4 col-md-6">
                    <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                        <div class="d-flex justify-between items-center py-20 px-30 border-bottom-light">
                            <h2 class="text-17 fw-500">Popular Instructor</h2>

                        </div>
                        <div class="py-30 px-30">
                            <div class="y-gap-40">
                                @forelse ($teachers as $teacher)
                                    <div class="d-flex">
                                        <img class="size-40 rounded-full"
                                            src="{{ $teacher->profile->profile_photo ? asset('storage/' . $teacher->profile->profile_photo) : asset('assets/img/dashboard/avatars/1.png') }}"
                                            alt="avatar" />
                                        <div class="ml-10 w-1/1">
                                            <h4 class="text-15 lh-1 fw-500">
                                                {{ $teacher->name }}
                                            </h4>
                                            <div class="d-flex items-center x-gap-20 y-gap-10 flex-wrap pt-10">

                                                <div class="d-flex items-center">
                                                    <i class="icon-online-learning text-15 mr-10"></i>
                                                    <div class="text-13 lh-1">692 Students</div>
                                                </div>
                                                <div class="d-flex items-center">
                                                    <i class="icon-play text-15 mr-10"></i>
                                                    <div class="text-13 lh-1">15 Course</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="d-flex border-top-light">
                                        <img class="size-40" src="{{ asset('assets/img/dashboard/avatars/2.png') }}"
                                            alt="avatar" />
                                        <div class="ml-10 w-1/1">
                                            <h4 class="text-15 lh-1 fw-500">Albert Flores</h4>
                                            <div class="d-flex items-center x-gap-20 y-gap-10 flex-wrap pt-10">
                                                <div class="d-flex items-center">
                                                    <i class="icon-message text-15 mr-10"></i>
                                                    <div class="text-13 lh-1">23,987 Reviews</div>
                                                </div>
                                                <div class="d-flex items-center">
                                                    <i class="icon-online-learning text-15 mr-10"></i>
                                                    <div class="text-13 lh-1">692 Students</div>
                                                </div>
                                                <div class="d-flex items-center">
                                                    <i class="icon-play text-15 mr-10"></i>
                                                    <div class="text-13 lh-1">15 Course</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse


                                <div class="d-flex border-top-light">
                                    <img class="size-40" src="{{ asset('assets/img/dashboard/avatars/3.png') }}"
                                        alt="avatar" />
                                    <div class="ml-10 w-1/1">
                                        <h4 class="text-15 lh-1 fw-500">
                                            Savannah Nguyen
                                        </h4>
                                        <div class="d-flex items-center x-gap-20 y-gap-10 flex-wrap pt-10">
                                            <div class="d-flex items-center">
                                                <i class="icon-message text-15 mr-10"></i>
                                                <div class="text-13 lh-1">23,987 Reviews</div>
                                            </div>
                                            <div class="d-flex items-center">
                                                <i class="icon-online-learning text-15 mr-10"></i>
                                                <div class="text-13 lh-1">692 Students</div>
                                            </div>
                                            <div class="d-flex items-center">
                                                <i class="icon-play text-15 mr-10"></i>
                                                <div class="text-13 lh-1">15 Course</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex border-top-light">
                                    <img class="size-40" src="{{ asset('assets/img/dashboard/avatars/4.png') }}"
                                        alt="avatar" />
                                    <div class="ml-10 w-1/1">
                                        <h4 class="text-15 lh-1 fw-500">Guy Hawkins</h4>
                                        <div class="d-flex items-center x-gap-20 y-gap-10 flex-wrap pt-10">
                                            <div class="d-flex items-center">
                                                <i class="icon-message text-15 mr-10"></i>
                                                <div class="text-13 lh-1">23,987 Reviews</div>
                                            </div>
                                            <div class="d-flex items-center">
                                                <i class="icon-online-learning text-15 mr-10"></i>
                                                <div class="text-13 lh-1">692 Students</div>
                                            </div>
                                            <div class="d-flex items-center">
                                                <i class="icon-play text-15 mr-10"></i>
                                                <div class="text-13 lh-1">15 Course</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex border-top-light">
                                    <img class="size-40" src="{{ asset('assets/img/dashboard/avatars/5.png') }}"
                                        alt="avatar" />
                                    <div class="ml-10 w-1/1">
                                        <h4 class="text-15 lh-1 fw-500">Guy Hawkins</h4>
                                        <div class="d-flex items-center x-gap-20 y-gap-10 flex-wrap pt-10">
                                            <div class="d-flex items-center">
                                                <i class="icon-message text-15 mr-10"></i>
                                                <div class="text-13 lh-1">23,987 Reviews</div>
                                            </div>
                                            <div class="d-flex items-center">
                                                <i class="icon-online-learning text-15 mr-10"></i>
                                                <div class="text-13 lh-1">692 Students</div>
                                            </div>
                                            <div class="d-flex items-center">
                                                <i class="icon-play text-15 mr-10"></i>
                                                <div class="text-13 lh-1">15 Course</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                        <div class="d-flex justify-between items-center py-20 px-30 border-bottom-light">
                            <h2 class="text-17 lh-1 fw-500">Recent Courses</h2>

                        </div>
                        <div class="py-30 px-30">
                            <div class="y-gap-40">
                                @forelse ($totalCourses->take(3) as $course)
                                    <div class="d-flex">
                                        <div class="shrink-0">
                                            <img src="{{ $course?->thumbnail
                                                ? asset('storage/' . $course?->thumbnail)
                                                : asset('assets/img/dashboard/recent-courses/1.png') }}"
                                                alt="image" class="w-24" />
                                        </div>
                                        <div class="ml-15">
                                            <h4 class="text-15 lh-16 fw-500">
                                                {{ $course->title }}
                                            </h4>
                                            <div class="d-flex items-center x-gap-20 y-gap-10 flex-wrap pt-10">
                                                <div class="d-flex items-center">
                                                    <img class="size-16 object-cover mr-8 rounded-full"
                                                        src="{{ $course?->teacher?->profile->profile_photo ? asset('storage/' . $course?->teacher?->profile->profile_photo) : asset('assets/img/general/avatar-1.png') }}"
                                                        alt="icon" />
                                                    <div class="text-14 lh-1">
                                                        {{ $course?->teacher?->name ?? 'Course Teacher' }}</div>
                                                </div>
                                                <div class="d-flex items-center">
                                                    <i class="icon-document text-16 mr-8"></i>
                                                    <div class="text-14 lh-1">
                                                        {{ $course?->sections?->flatMap->lessons->count() }} lesson</div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="d-flex border-top-light">
                                        <div class="shrink-0">
                                            <img src="{{ asset('assets/img/dashboard/recent-courses/2.png') }}"
                                                alt="image" />
                                        </div>
                                        <div class="ml-15">
                                            <h4 class="text-15 lh-16 fw-500">
                                                The Ultimate Drawing Course Beginner to Advanced
                                            </h4>
                                            <div class="d-flex items-center x-gap-20 y-gap-10 flex-wrap pt-10">
                                                <div class="d-flex items-center">
                                                    <img class="size-16 object-cover mr-8"
                                                        src="{{ asset('assets/img/general/avatar-1.png') }}"
                                                        alt="icon" />
                                                    <div class="text-14 lh-1">Ali Tufan</div>
                                                </div>
                                                <div class="d-flex items-center">
                                                    <i class="icon-document text-16 mr-8"></i>
                                                    <div class="text-14 lh-1">6 lesson</div>
                                                </div>
                                                <div class="d-flex items-center">
                                                    <i class="icon-clock-2 text-16 mr-8"></i>
                                                    <div class="text-14 lh-1">3h 56m</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex border-top-light">
                                        <div class="shrink-0">
                                            <img src="{{ asset('assets/img/dashboard/recent-courses/3.png') }}"
                                                alt="image" />
                                        </div>
                                        <div class="ml-15">
                                            <h4 class="text-15 lh-16 fw-500">
                                                Instagram Marketing 2021: Complete Guide To
                                                Instagram Growth
                                            </h4>
                                            <div class="d-flex items-center x-gap-20 y-gap-10 flex-wrap pt-10">
                                                <div class="d-flex items-center">
                                                    <img class="size-16 object-cover mr-8"
                                                        src="{{ asset('assets/img/general/avatar-1.png') }}"
                                                        alt="icon" />
                                                    <div class="text-14 lh-1">Ali Tufan</div>
                                                </div>
                                                <div class="d-flex items-center">
                                                    <i class="icon-document text-16 mr-8"></i>
                                                    <div class="text-14 lh-1">6 lesson</div>
                                                </div>
                                                <div class="d-flex items-center">
                                                    <i class="icon-clock-2 text-16 mr-8"></i>
                                                    <div class="text-14 lh-1">3h 56m</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    @endsection
