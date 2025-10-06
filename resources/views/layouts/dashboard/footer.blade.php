  <!-- JavaScript - fixed CDN URLs -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
      integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
      integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
      crossorigin=""></script>
  <script src="{{ asset('assets/js/vendors.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>



  @stack('scripts')
  <script>
      $(document).on('click', '.control-dshb', function(e) {
          e.preventDefault(); // prevent normal link behavior

          let url = $(this).attr('href'); // get the href dynamically

          $.ajax({
              url: url,
              type: 'GET',
              success: function(response) {

                  $('.dashboard__content').html(response); // append the returned view
              },
              error: function(xhr) {
                  console.error("Error loading content:", xhr.responseText);
                  $('.dashboard__content').html('<p class="text-danger">Failed to load content.</p>');
              }
          });
      });
      //   getting between settings tabs
      $(document).on('click', '.js-tabs-button', function() {
          // Remove active class from all buttons
          $('.js-tabs-button').removeClass('is-active');
          // Add active class to clicked button
          $(this).addClass('is-active');

          // Get target tab
          var target = $(this).data('tab-target');

          // Hide all tab content
          $('.tabs__pane').removeClass('is-active');

          // Show the selected one
          $(target).addClass('is-active');
      });
      //for dashboard pane navigation

      $(document).on('click', '.control-dshb', function(e) {
          // Remove active class from all items
          $('.sidebar__item').removeClass('-is-active');

          // Add active class to the parent of the clicked link
          $(this).closest('.sidebar__item').addClass('-is-active');
      });
      //profile photo deletion handling
      $(document).on('click', '.delete-photo', function(e) {
          e.preventDefault();
          $('#deletePhotoForm').submit();

      });
      //this is to handle profile

      $(document).ready(function() {

          // ✅ Global AJAX form handler
          $(document).on('submit', '.ajaxForm', function(e) {
              e.preventDefault();

              const form = $(this);
              const url = form.attr('action');
              const method = form.attr('method') || 'POST';
              const formData = new FormData(this);

              // Remove old messages
              form.find('.form-message').remove();

              $.ajax({
                  url: url,
                  type: method,
                  data: formData,
                  processData: false,
                  contentType: false,
                  success: function(response) {
                      // ✅ Show success message inline
                      const msg = $('<div class="form-message text-success mt-2 fw-bold">✅ ' +
                          (response.message || 'Updated successfully!') + '</div>');
                      form.append(msg);

                      // ✅ If profile photo updated, show preview dynamically
                      if (response.photo_url) {
                          $('.size-100').attr('src', response.photo_url);
                      }
                      // ✅ Clear form fields (except hidden & CSRF)
                      form.find('input:not([type=hidden]), textarea, select').val('');

                      // Auto-hide after 3 seconds
                      setTimeout(() => msg.fadeOut(500, () => msg.remove()), 3000);
                  },
                  error: function(xhr) {
                      let msgText = '❌ Something went wrong.';
                      if (xhr.responseJSON && xhr.responseJSON.message) {
                          msgText = '❌ ' + xhr.responseJSON.message;
                      }
                      const msg = $('<div class="form-message text-danger mt-2 fw-bold">' +
                          msgText + '</div>');
                      form.append(msg);
                      setTimeout(() => msg.fadeOut(500, () => msg.remove()), 3000);
                  }
              });
          });

          // ✅ For profile photo upload (click on icon-cloud)
          $(document).on('click', '.icon-cloud', function() {
              const input = $(
                  '<input type="file" name="profile_photo" accept="image/*" style="display:none;">');
              $('body').append(input);
              input.click();

              input.on('change', function() {
                  const formData = new FormData();
                  formData.append('profile_photo', this.files[0]);
                  formData.append('_token', '{{ csrf_token() }}');

                  $.ajax({
                      url: "{{ route('profile.photo.update') }}",
                      type: 'POST',
                      data: formData,
                      processData: false,
                      contentType: false,
                      success: function(response) {
                          const msg = $(
                              '<div class="form-message text-success mt-2 fw-bold">✅ ' +
                              response.message + '</div>');
                          $('.contact-form').append(msg);

                          // Update and round the profile photo
                          const img = $('.size-100');
                          img.attr('src', response.photo_url)
                              .addClass('rounded-circle') // Bootstrap
                              .css({
                                  'object-fit': 'cover',
                                  'width': '100px',
                                  'height': '100px'
                              });

                          setTimeout(() => msg.fadeOut(500, () => msg.remove()),
                              3000);
                      },

                      error: function() {
                          const msg = $(
                              '<div class="form-message text-danger mt-2 fw-bold">❌ Upload failed</div>'
                          );
                          $('.contact-form').append(msg);
                          setTimeout(() => msg.fadeOut(500, () => msg.remove()),
                              3000);
                      }
                  });
              });
          });

      });
  </script>
  </body>

  </html>
