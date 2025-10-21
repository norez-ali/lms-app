@include('layouts.home.header')
<section data-anim="fade" class="breadcrumbs ">
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <div class="breadcrumbs__content">

                    <div class="breadcrumbs__item ">
                        <a href="#">Home</a>
                    </div>

                    <div class="breadcrumbs__item ">
                        <a href="#">All courses</a>
                    </div>

                    <div class="breadcrumbs__item ">
                        <a href="#">User Experience Design</a>
                    </div>

                    <div class="breadcrumbs__item ">
                        <a href="#">User Interface</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>



<div class="js-pin-container">
    <section class="page-header -type-5 bg-light-6">
        <div class="page-header__bg">
            <div class="bg-image js-lazy" data-bg="img/event-single/bg.png"></div>
        </div>
        <div class="message"></div>
        <div class="container">
            <div class="page-header__content pt-90 pb-90">
                <div class="row y-gap-30 relative">
                    <div class="col-xl-7 col-lg-8">


                        <div data-anim="slide-up delay-1">
                            <h1 class="text-30 lh-14 pr-60 lg:pr-0">{{ $course->title }}</h1>
                        </div>

                        <p class="col-xl-9 mt-20">{{ $course->short_description }}</p>

                        <div class="d-flex x-gap-30 y-gap-10 items-center flex-wrap pt-20">
                            <div class="d-flex items-center">
                                <div class="text-20 lh-1 text-yellow-1 mr-10">Uploaded</div>

                                <div class="text-14 lh-1 text-light-1 ml-10">
                                    {{ '(' . $course->created_at->diffForHumans() . ')' }}</div>
                            </div>


                            <div class="d-flex items-center text-light-1">
                                <div class="icon icon-person-3 text-13"></div>
                                <div class="text-14 ml-8">853 enrolled on this course</div>
                            </div>

                            <div class="d-flex items-center text-light-1">
                                <div class="icon icon-wall-clock text-13"></div>
                                <div class="text-14 ml-8">Last updated 11/2021</div>
                            </div>

                        </div>

                        <div class="d-flex items-center pt-20">
                            <div class="bg-image size-30 rounded-full"
                                style="background-image: url('{{ optional(optional($course->teacher)->profile)->profile_photo
                                    ? asset('storage/' . optional($course->teacher->profile)->profile_photo)
                                    : asset('assets/img/avatars/small-1.png') }}');
            background-size: cover; background-position: center;">
                            </div>

                            <div class="text-14 lh-1 ml-10">{{ $course->teacher->name ?? 'Course Teacher' }}</div>
                        </div>
                    </div>

                    <div class="courses-single-info js-pin-content">
                        <div class="bg-white shadow-2 rounded-8 border-light py-10 px-10">
                            <div class="relative">
                                <img class="w-1/1" src="{{ asset('assets/img/misc/1.png') }}" alt="image">
                                <div class="absolute-full-center d-flex justify-center items-center">

                                </div>
                            </div>

                            <div class="courses-single-info__content scroll-bar-1 pt-30 pb-20 px-20">
                                <div class="d-flex justify-between items-center mb-30">
                                    <div class="text-24 lh-1 text-dark-1 fw-500">Price</div>
                                    <div class="text-24 lh-1 text-dark-1 fw-500">${{ $course->price }}</div>

                                </div>

                                <button class="button -md -purple-1 text-white w-1/1 add-cart"
                                    data-id="{{ $course->id }}">Add To Cart</button>
                                <button class="button -md -outline-dark-1 text-dark-1 w-1/1 mt-10">Buy
                                    Now</button>

                                <div class="text-14 lh-1 text-center mt-30">30-Day Money-Back Guarantee
                                </div>

                                <div class="mt-25">

                                    <div class="d-flex justify-between py-8 ">
                                        <div class="d-flex items-center text-dark-1">
                                            <div class="icon-video-file"></div>
                                            <div class="ml-10">Lessons</div>
                                        </div>
                                        <div>{{ $course->sections->flatMap->courses->count() }}</div>
                                    </div>

                                    <div class="d-flex justify-between py-8 border-top-light">
                                        <div class="d-flex items-center text-dark-1">
                                            <div class="icon-puzzle"></div>
                                            <div class="ml-10">Quizzes</div>
                                        </div>
                                        <div>{{ $course->quizzes->count() }}</div>
                                    </div>

                                    <div class="d-flex justify-between py-8 border-top-light">
                                        <div class="d-flex items-center text-dark-1">
                                            <div class="icon-clock-2"></div>
                                            <div class="ml-10">Duration</div>
                                        </div>
                                        <div>Self Paced</div>
                                    </div>

                                    <div class="d-flex justify-between py-8 border-top-light">
                                        <div class="d-flex items-center text-dark-1">
                                            <div class="icon-bar-chart-2"></div>
                                            <div class="ml-10">Skill level</div>
                                        </div>
                                        <div>{{ $course->level ?? 'Beginner' }}</div>
                                    </div>

                                    <div class="d-flex justify-between py-8 border-top-light">
                                        <div class="d-flex items-center text-dark-1">
                                            <div class="icon-translate"></div>
                                            <div class="ml-10">Language</div>
                                        </div>
                                        <div>{{ $course->audio_language ?? 'English' }}</div>
                                    </div>

                                    <div class="d-flex justify-between py-8 border-top-light">
                                        <div class="d-flex items-center text-dark-1">
                                            <div class="icon-badge"></div>
                                            <div class="ml-10">Certificate</div>
                                        </div>
                                        <div>Yes</div>
                                    </div>

                                    <div class="d-flex justify-between py-8 border-top-light">
                                        <div class="d-flex items-center text-dark-1">
                                            <div class="icon-infinity"></div>
                                            <div class="ml-10">Full lifetime access</div>
                                        </div>
                                        <div>Yes</div>
                                    </div>

                                </div>

                                <div class="d-flex justify-center pt-15">

                                    <a href="#" class="d-flex justify-center items-center size-40 rounded-full">
                                        <i class="fa fa-facebook"></i>
                                    </a>

                                    <a href="#" class="d-flex justify-center items-center size-40 rounded-full">
                                        <i class="fa fa-twitter"></i>
                                    </a>

                                    <a href="#" class="d-flex justify-center items-center size-40 rounded-full">
                                        <i class="fa fa-instagram"></i>
                                    </a>

                                    <a href="#" class="d-flex justify-center items-center size-40 rounded-full">
                                        <i class="fa fa-linkedin"></i>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="layout-pt-md layout-pb-md">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="page-nav-menu -line">
                        <div class="d-flex x-gap-30">
                            <div><a href="#overview" class="pb-12 page-nav-menu__link is-active">Overview</a></div>
                            <div><a href="#course-content" class="pb-12 page-nav-menu__link">Course
                                    Content</a></div>
                            <div><a href="#instructors" class="pb-12 page-nav-menu__link">Instructors</a>
                            </div>

                        </div>
                    </div>

                    <div id="overview" class="pt-60 lg:pt-40 to-over">
                        <h4 class="text-18 fw-500">Description</h4>

                        <div class="show-more mt-30 js-show-more">
                            <div class="{{ strlen($course->description) > 300 ? 'show-more__content' : '' }}">
                                <p class="">
                                    {{ $course->description }}
                                </p>
                            </div>

                            <button class="show-more__button text-purple-1 fw-500 underline mt-30">Show
                                more</button>
                        </div>

                        <div class="mt-60">
                            <h4 class="text-20 mb-30">What you'll learn</h4>
                            <div class="row x-gap-100 justfiy-between">
                                @foreach (explode('.', $course->learning_outcomes) as $outcome)
                                    @if (trim($outcome) != '')
                                        <div class="d-flex items-center">
                                            <div
                                                class="d-flex justify-center items-center border-light rounded-full size-20 mr-10">
                                                <i class="size-12" data-feather="check"></i>
                                            </div>
                                            <p>{{ trim($outcome) }}.</p>
                                        </div>
                                    @endif
                                @endforeach



                            </div>
                        </div>

                        <div class="mt-60">
                            <h4 class="text-20">Requirements</h4>
                            <ul class="ul-list y-gap-15 pt-30">
                                @foreach (explode('.', $course->requirements) as $requirement)
                                    @if (trim($requirement) != '')
                                        <li>{{ trim($requirement) }}.</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div id="course-content" class="pt-60 lg:pt-40">
                        <h2 class="text-20 fw-500">Course Content</h2>

                        <div class="d-flex justify-between items-center mt-30">
                            <div>
                                {{ $course->sections->count() . ' sections • ' . $course->sections->flatMap->lessons->count() . ' lectures' }}
                            </div>


                        </div>

                        <div class="mt-10">
                            <div class="accordion -block-2 text-left js-accordion">
                                @if ($course->sections->isNotEmpty())
                                    @foreach ($course->sections as $section)
                                        <div class="accordion__item">
                                            <div class="accordion__button py-20 px-30 bg-light-4">
                                                <div class="d-flex items-center">
                                                    <div class="accordion__icon">
                                                        <div class="icon" data-feather="chevron-down"></div>
                                                        <div class="icon" data-feather="chevron-up"></div>
                                                    </div>
                                                    <span
                                                        class="text-17 fw-500 text-dark-1">{{ $section->title }}</span>
                                                </div>

                                                <div>
                                                    {{ $section->lessons->count() > 0 ? $section->lessons->count() . ' Lessons' : 'No lessons yet' }}
                                                </div>
                                            </div>

                                            <div class="accordion__content">
                                                <div class="accordion__content__inner px-30 py-30">
                                                    <div class="y-gap-20">
                                                        @forelse ($section->lessons as $lesson)
                                                            <div class="d-flex justify-between">
                                                                <div class="d-flex items-center">
                                                                    <div
                                                                        class="d-flex justify-center items-center size-30 rounded-full bg-purple-3 mr-10">
                                                                        <div class="icon-play text-9"></div>
                                                                    </div>
                                                                    <div>{{ $lesson->title }}</div>
                                                                </div>
                                                            </div>
                                                        @empty
                                                            <div>No Lesson added to this section.</div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="accordion__item">
                                        <div class="accordion__button py-20 px-30 bg-light-4">
                                            <div class="d-flex items-center">
                                                <div class="accordion__icon">
                                                    <div class="icon" data-feather="chevron-down"></div>
                                                    <div class="icon" data-feather="chevron-up"></div>
                                                </div>
                                                <span class="text-17 fw-500 text-dark-1">No Content</span>
                                            </div>
                                        </div>

                                        <div class="accordion__content">
                                            <div class="accordion__content__inner px-30 py-30">
                                                <div class="y-gap-20">
                                                    <div>Content will be added soon to this course.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                            </div>
                        </div>
                    </div>

                    <div id="instructors" class="pt-60 lg:pt-40">
                        <h2 class="text-20 fw-500">Instructor</h2>
                        <div class="mt-30">
                            <div class="d-flex x-gap-20 y-gap-20 items-center flex-wrap ">
                                <div class="size-120">
                                    <img src="{{ $course->teacher->profile->profile_photo ? asset('storage/' . $course->teacher->profile->profile_photo) : asset('assets/img/misc/verified/1.png') }}"
                                        alt="Teacher Photo" class="object-cover object-top"
                                        style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">

                                </div>

                                <div class="">
                                    <h5 class="text-17 lh-14 fw-500">{{ $course->teacher->name ?? 'Course Teacher' }}
                                    </h5>
                                    <p class="mt-5">
                                        {{ optional($course->teacher->experiences->first())->title ?? 'President of Sales' }}

                                    </p>

                                    <div class="d-flex x-gap-20 y-gap-10 flex-wrap items-center pt-10">




                                        <div class="d-flex items-center text-light-1">
                                            <div class="icon-person-3 text-13 mr-8"></div>
                                            <div class="text-13 lh-1">692 Students</div>
                                        </div>

                                        <div class="d-flex items-center text-light-1">
                                            <div class="icon-wall-clock text-13 mr-8"></div>
                                            <div class="text-13 lh-1">
                                                {{ $course->teacher->courses_count ?? 0 }} Courses
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="mt-30">
                                <p>
                                    {{ optional($course->teacher->experiences->first())->description ?? 'Course description that has been added by the teacher of the course, or the teacher has yet to be assigned to this course' }}

                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

</div>

<script>
    $(document).on('click', '.add-cart', function(e) {
        e.preventDefault();

        const courseId = $(this).data('id'); // ensure your button has data-id="{{ $course->id }}"

        $.ajax({
            url: `/student/add/cart/${courseId}`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    showSuccessMessage(response.message || 'Course added to cart successfully!');
                } else {
                    showErrorMessage(response.message || 'Failed to add course to cart.');
                }
            },
            error: function(xhr) {
                // ✅ Handle unauthenticated case
                if (xhr.status === 401) {
                    window.location.href = "{{ route('login') }}"; // or route('login')
                    return;
                }

                console.error(xhr.responseText);
                showErrorMessage('Something went wrong while adding to cart.');
            }
        });
    });


    // ✅ Helper functions for alert messages
    function showSuccessMessage(message) {
        const alertBox = $(`
        <div class="alert-message bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg shadow-md mb-4">
            ${message}
        </div>
    `);
        $('.message').prepend(alertBox);
        setTimeout(() => alertBox.fadeOut(500, () => alertBox.remove()), 4000);
    }

    function showErrorMessage(message) {
        const alertBox = $(`
        <div class="alert-message bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg shadow-md mb-4">
            ${message}
        </div>
    `);
        $('.message').prepend(alertBox);
        setTimeout(() => alertBox.fadeOut(500, () => alertBox.remove()), 4000);
    }
</script>



@include('layouts.home.footer')
