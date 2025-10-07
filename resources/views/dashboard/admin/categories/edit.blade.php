<div class="row y-gap-60">
    <div class="col-12">
        <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
            <div class="d-flex items-center py-20 px-30 border-bottom-light justify-between">
                <h2 class="text-17 lh-1 fw-500">Edit Category</h2>

                {{-- Delete button --}}
                <form action="" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button -sm -outline-danger text-danger">
                        Delete
                    </button>
                </form>
            </div>

            <div class="py-30 px-30">
                {{-- Laravel form for updating category --}}
                <form class="update-category contact-form row y-gap-30" action="" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- Category Name --}}
                    <div class="col-12">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Category Name*</label>
                        <input type="text" name="name" placeholder="e.g. Web Development" required
                            value="{{ old('name', $category->name) }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Category Image --}}
                    <div class="col-12">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Category Image*</label>

                        {{-- Show existing image --}}
                        <div class="mb-3">
                            <div style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden;">
                                <img src="{{ asset($category->image ?? 'assets/img/dashboard/edit/1.png') }}"
                                    alt="{{ $category->name }} image"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>

                        <div class="form-upload__wrap">
                            <input type="file" name="image" accept="image/*">
                        </div>
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <p class="mt-10 text-14 text-light-1">
                            Upload a new image (optional; recommended: 750x440px, formats: .jpg, .jpeg, .png)
                        </p>
                    </div>

                    {{-- Buttons --}}
                    <div class="row y-gap-20 justify-between pt-15">
                        <div class="col-auto">
                            <a href="{{ route('admin.dashboard') }}"
                                class="button -md -outline-purple-1 text-purple-1">Cancel</a>
                        </div>

                        <div class="col-auto">
                            <button type="submit" class="button -md -purple-1 text-white">Update Category</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
