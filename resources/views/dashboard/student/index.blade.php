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
                                            <a href="{{ route('student.course.view', $enrollment->course->id) }}"
                                                class="control-dshb shadow-md rounded-xl hover:shadow-lg transition-shadow duration-300 block"
                                                style="width: 19%; min-width: 250px; display: inline-block; vertical-align: top; height: 360px; margin: 0 0.5%; background: #fff; overflow: hidden;">

                                                <div style="position: relative;">
                                                    <img style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px 8px 0 0;"
                                                        src="{{ $enrollment->course->thumbnail ? asset('storage/' . $enrollment->course->thumbnail) : asset('assets/img/coursesCards/1.png') }}"
                                                        alt="Course Thumbnail">
                                                </div>

                                                <div
                                                    style="padding: 12px 10px 10px 10px; display: flex; flex-direction: column; justify-content: space-between; height: 140px;">
                                                    <div>
                                                        <div style="font-size: 14px; line-height: 1; color: #555;">
                                                            {{ $enrollment->course->teacher->name ?? 'Course Teacher' }}
                                                        </div>

                                                        <h3
                                                            style="font-size: 16px; font-weight: 500; line-height: 1.3; margin-top: 10px; height: 38px; overflow: hidden;">
                                                            {{ $enrollment->course->title }}
                                                        </h3>
                                                    </div>

                                                    <div class="mt-10">
                                                        <div class="progress-bar"
                                                            style="height: 6px; background: #eee; border-radius: 3px; overflow: hidden;">
                                                            <div class="progress-bar__bar"
                                                                style="width: {{ $enrollment->progress }}%; height: 100%; background: #8b5cf6; transition: width 0.4s ease;">
                                                            </div>
                                                        </div>

                                                        <div
                                                            style="display: flex; justify-content: space-between; align-items: center; margin-top: 8px; font-size: 13px; color: #333;">
                                                            <div>{{ $enrollment->progress }}% Completed</div>
                                                            <div>{{ $enrollment->progress }}%</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </a>

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
