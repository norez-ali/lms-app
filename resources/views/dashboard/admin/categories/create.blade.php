<div class="row y-gap-60">
    <div class="col-12">
        <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
            <div class="d-flex items-center py-20 px-30 border-bottom-light">
                <h2 class="text-17 lh-1 fw-500">Create Category</h2>
            </div>

            <div class="py-30 px-30">
                {{-- Laravel form for creating category --}}
                <form class="create-category contact-form row y-gap-30" action="{{ route('admin.store.category') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Category Name --}}
                    <div class="col-12">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Category Name*</label>
                        <input type="text" name="name" placeholder="e.g. Web Development" required
                            value="{{ old('name') }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Category Image --}}
                    <div class="col-12">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Category Image*</label>
                        <div class="form-upload__wrap">
                            <input type="file" name="image" accept="image/*" required>
                        </div>
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <p class="mt-10 text-14 text-light-1">
                            Upload an image (recommended size: 750x440px; formats: .jpg, .jpeg, .png).
                        </p>
                    </div>

                    {{-- Buttons --}}
                    <div class="row y-gap-20 justify-between pt-15">
                        <div class="col-auto">
                            <a href="{{ route('admin.dashboard') }}"
                                class="button -md -outline-purple-1 text-purple-1">Cancel</a>
                        </div>

                        <div class="col-auto">
                            <button type="submit" class="button -md -purple-1 text-white">Save Category</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
