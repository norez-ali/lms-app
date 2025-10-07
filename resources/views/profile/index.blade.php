<div>
    <div class="row pb-50 mb-10">
        <div class="col-auto">

            <h1 class="text-30 lh-12 fw-700">Settings</h1>
            <div class="mt-10">Change your profile information.</div>

        </div>
    </div>


    <div class="row y-gap-30">
        <div class="col-12">
            <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                <div class="tabs -active-purple-2 js-tabs pt-0">
                    <div
                        class="tabs__controls d-flex x-gap-30 items-center pt-20 px-30 border-bottom-light js-tabs-controls">
                        <button class="tabs__button text-light-1 js-tabs-button is-active" data-tab-target=".-tab-item-1"
                            type="button">
                            Edit Profile
                        </button>
                        <button class="tabs__button text-light-1 js-tabs-button" data-tab-target=".-tab-item-2"
                            type="button">
                            Password
                        </button>
                        @if (auth()->user()->role === 'teacher')
                            <button class="tabs__button text-light-1 js-tabs-button" data-tab-target=".-tab-item-3"
                                type="button">
                                Experiences
                            </button>
                        @endif
                        @if (auth()->user()->role === 'teacher')
                            <button class="tabs__button text-light-1 js-tabs-button" data-tab-target=".-tab-item-4"
                                type="button">
                                Education
                            </button>
                        @endif
                        <button class="tabs__button text-light-1 js-tabs-button" data-tab-target=".-tab-item-5"
                            type="button">
                            Close Account
                        </button>
                    </div>

                    <div class="tabs__content py-30 px-30 js-tabs-content">
                        <div class="tabs__pane -tab-item-1 is-active">
                            <div class="row y-gap-20 x-gap-20 items-center">
                                <div class="col-auto">
                                    <img class="size-100 rounded-full object-cover"
                                        src="{{ $profile && $profile->profile_photo ? asset('storage/' . $profile->profile_photo) : asset('assets/img/dashboard/edit/1.png') }}"
                                        alt="profile_photo">
                                </div>

                                <div class="col-auto">
                                    <div class="text-16 fw-500 text-dark-1">{{ auth()->user()->name }}</div>
                                    <div class="text-14 lh-1 mt-10">PNG or JPG no bigger than 800px wide and tall.</div>

                                    <div class="d-flex x-gap-10 y-gap-10 flex-wrap pt-15">
                                        <div>
                                            <div
                                                class="d-flex justify-center items-center size-40 rounded-8 bg-light-3 cursor-pointer">
                                                <div class="icon-cloud text-16 "></div>
                                            </div>
                                        </div>
                                        <div>
                                            <div
                                                class="d-flex justify-center items-center size-40 rounded-8 bg-light-3 cursor-pointer delete-photo">
                                                <div class="icon-bin text-16"></div>
                                            </div>
                                            <form id="deletePhotoForm" class="ajaxForm d-none"
                                                action="{{ route('profile.photo.delete') }}" method="POST"> @csrf
                                                @method('DELETE') </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top-light pt-30 mt-30">
                                <form id="profileForm" action="{{ route('profile.update') }}"
                                    enctype="multipart/form-data" class="ajaxForm contact-form row y-gap-30">

                                    @csrf

                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Phone</label>
                                        <input type="text" name="phone" placeholder="Enter your phone number">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Address</label>
                                        <input type="text" name="address" placeholder="Enter your address">
                                    </div>



                                    <div class="col-12">
                                        <button type="submit" class="button -md -purple-1 text-white">Update
                                            Profile</button>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="tabs__pane -tab-item-2">
                            <form action="{{ route('profile.password.update') }}" method="POST"
                                class="ajaxForm contact-form row y-gap-30">
                                @csrf
                                @method('PUT')

                                <div class="col-md-7">
                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Current Password</label>
                                    <input type="password" name="current_password" placeholder="Enter current password"
                                        required>
                                </div>

                                <div class="col-md-7">
                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">New Password</label>
                                    <input type="password" name="new_password" placeholder="Enter new password"
                                        required>
                                </div>

                                <div class="col-md-7">
                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Confirm New Password</label>
                                    <input type="password" name="new_password_confirmation"
                                        placeholder="Confirm new password" required>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="button -md -purple-1 text-white">Save
                                        Password</button>
                                </div>
                            </form>

                        </div>
                        @if (auth()->user()->role === 'teacher')
                            <div class="tabs__pane -tab-item-3">

                                <form action="{{ route('profile.experience.update') }}" method="POST"
                                    class="ajaxForm contact-form row y-gap-30 bg-white rounded-2xl p-4 shadow-sm">
                                    @csrf

                                    <div class="col-12">
                                        <h3 class="fw-600 mb-20 text-dark-1">Teaching Experience</h3>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Job Title</label>
                                        <input type="text" name="title"
                                            value="{{ optional(auth()->user()->experience)->title }}"
                                            class="form-control w-100 border border-light-3 rounded-8 px-3 py-2 focus:border-purple-1 focus:ring-1 focus:ring-purple-1 outline-none"
                                            placeholder="e.g. Assistant Professor" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Institution</label>
                                        <input type="text" name="institution"
                                            value="{{ optional(auth()->user()->experience)->institution }}"
                                            class="form-control w-100 border border-light-3 rounded-8 px-3 py-2 focus:border-purple-1 focus:ring-1 focus:ring-purple-1 outline-none"
                                            placeholder="e.g. XYZ University" required>
                                    </div>

                                    {{-- ✨ Start & End Date Styled Side by Side --}}
                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Start Date</label>
                                        <div class="relative">
                                            <input type="date" name="start_date"
                                                value="{{ optional(auth()->user()->experience)->start_date }}"
                                                class="form-control w-100 border border-light-3 rounded-8 px-3 py-2 pr-10 focus:border-purple-1 focus:ring-1 focus:ring-purple-1 outline-none">
                                            <i class="icon-calendar text-gray-400 absolute right-3 top-3 text-18"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">End Date</label>
                                        <div class="relative">
                                            <input type="date" name="end_date"
                                                value="{{ optional(auth()->user()->experience)->end_date }}"
                                                class="form-control w-100 border border-light-3 rounded-8 px-3 py-2 pr-10 focus:border-purple-1 focus:ring-1 focus:ring-purple-1 outline-none">
                                            <i class="icon-calendar text-gray-400 absolute right-3 top-3 text-18"></i>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Description</label>
                                        <textarea name="description" rows="4"
                                            class="form-control w-100 border border-light-3 rounded-8 px-3 py-2 focus:border-purple-1 focus:ring-1 focus:ring-purple-1 outline-none"
                                            placeholder="Describe your teaching role">{{ optional(auth()->user()->experience)->description }}</textarea>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit"
                                            class="button -md -purple-1 text-white hover:opacity-90 transition-all">
                                            Save Experience
                                        </button>
                                    </div>
                                </form>


                            </div>
                        @endif

                        @if (auth()->user()->role === 'teacher')
                            <div class="tabs__pane -tab-item-4">
                                <form action="{{ route('profile.education.update') }}" method="POST"
                                    class="ajaxForm contact-form row y-gap-30 bg-white rounded-2xl p-4 shadow-sm ">
                                    @csrf

                                    <div class="col-12">
                                        <h3 class="fw-600 mb-10 text-dark-1">Education</h3>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Degree</label>
                                        <input type="text" name="degree"
                                            value="{{ optional(auth()->user()->education)->degree }}"
                                            class="form-control w-100 border border-light-3 rounded-8 px-3 py-2 h-50 focus:border-purple-1 focus:ring-1 focus:ring-purple-1 outline-none"
                                            placeholder="e.g. Master of Education" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Institution</label>
                                        <input type="text" name="institution"
                                            value="{{ optional(auth()->user()->education)->institution }}"
                                            class="form-control w-100 border border-light-3 rounded-8 px-3 py-2 h-50 focus:border-purple-1 focus:ring-1 focus:ring-purple-1 outline-none"
                                            placeholder="e.g. University of Karachi" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Start Year</label>
                                        <input type="number" name="start_year" min="1950"
                                            max="{{ date('Y') }}"
                                            value="{{ optional(auth()->user()->education)->start_year }}"
                                            class="form-control w-100 border border-light-3 rounded-8 px-3 py-2 h-50 focus:border-purple-1 focus:ring-1 focus:ring-purple-1 outline-none"
                                            placeholder="e.g. 2015">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">End Year</label>
                                        <input type="number" name="end_year" min="1950"
                                            max="{{ date('Y') }}"
                                            value="{{ optional(auth()->user()->education)->end_year }}"
                                            class="form-control w-100 border border-light-3 rounded-8 px-3 py-2 h-50 focus:border-purple-1 focus:ring-1 focus:ring-purple-1 outline-none"
                                            placeholder="e.g. 2019">
                                    </div>

                                    <div class="col-12">
                                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Description</label>
                                        <textarea name="description" rows="4"
                                            class="form-control w-100 border border-light-3 rounded-8 px-3 py-2 focus:border-purple-1 focus:ring-1 focus:ring-purple-1 outline-none"
                                            placeholder="Describe your academic background">{{ optional(auth()->user()->education)->description }}</textarea>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit"
                                            class="button -md -purple-1 text-white hover:opacity-90 transition-all">
                                            Save Education
                                        </button>
                                    </div>
                                </form>

                            </div>
                        @endif

                        <div class="tabs__pane -tab-item-5">
                            <form action="#" class="contact-form row y-gap-30">
                                <div class="col-12">
                                    <div class="text-16 fw-500 text-dark-1">Close account</div>
                                    <p class="mt-10">Warning: If you close your account, you will be unsubscribed from
                                        all your 5 courses, and will lose access forever.</p>
                                </div>


                                <div class="col-md-7">

                                    <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Enter Password</label>

                                    <input type="text" placeholder="Enter Password">
                                </div>


                                <div class="col-12">
                                    <button class="button -md -purple-1 text-white">Close Account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
