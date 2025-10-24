@extends('layouts.dashboard.main')
@section('content')
    <div class="dashboard__main">
        <div class="dashboard__content bg-light-4">
            <div class="row pb-50 mb-10">
                <div class="col-auto">

                    <h1 class="text-30 lh-12 fw-700">My Courses</h1>
                    <div class="mt-10">All the enrolled courses will show here.</div>

                </div>
            </div>


            <div class="row y-gap-30">
                <div class="col-12">
                    <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                        <div class="tabs -active-purple-2 js-tabs">
                            <div
                                class="tabs__controls d-flex items-center pt-20 px-30 border-bottom-light js-tabs-controls">
                                <button class="text-light-1 lh-12 tabs__button js-tabs-button is-active"
                                    data-tab-target=".-tab-item-1" type="button">
                                    All Courses
                                </button>
                                <button class="text-light-1 lh-12 tabs__button js-tabs-button ml-30"
                                    data-tab-target=".-tab-item-2" type="button">
                                    Finished
                                </button>

                            </div>

                            <div class="tabs__content py-30 px-30 js-tabs-content">
                                <div class="tabs__pane -tab-item-1 is-active">
                                    <div class="row y-gap-30 pt-30">
                                        @forelse ($enrollments as $enrollment)
                                            <div class="w-1/5 xl:w-1/3 lg:w-1/2 sm:w-1/1">
                                                <div class="relative">
                                                    <img class="rounded-8 w-1/1"
                                                        src="{{ $enrollment->course->thumbnail ? asset('storage/' . $enrollment->course->thumbnail) : asset('assets/img/coursesCards/1.png') }}"
                                                        alt="image">
                                                </div>

                                                <div class="pt-15">
                                                    <div class="d-flex y-gap-10 justify-between items-center">
                                                        <div class="text-14 lh-1">
                                                            {{ $enrollment->course->teacher->name ?? 'Course Teacher' }}
                                                        </div>


                                                    </div>

                                                    <h3 class="text-16 fw-500 lh-15 mt-10">{{ $enrollment->course->title }}
                                                    </h3>

                                                    <div class="progress-bar mt-10">
                                                        <div class="progress-bar__bg bg-light-3"></div>
                                                        <div class="progress-bar__bar bg-purple-1 w-1/5">
                                                        </div>
                                                    </div>

                                                    <div class="d-flex y-gap-10 justify-between items-center mt-10">
                                                        <div class="text-dark-1">% 20 Completed</div>
                                                        <div>25%</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-gray-500">You haven’t enrolled in any courses yet.</p>
                                        @endforelse

                                    </div>

                                    <div class="row justify-center pt-30">
                                        <div class="col-auto">
                                            {{ $enrollments->links() }}
                                        </div>
                                    </div>
                                </div>

                                <div class="tabs__pane -tab-item-2"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection
