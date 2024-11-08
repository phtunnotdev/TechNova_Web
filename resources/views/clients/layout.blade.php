<!DOCTYPE html>
<html class="no-js" lang="zxx">
  <!-- Mirrored from htmldemo.net/volga/volga/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Sep 2024 06:17:11 GMT -->
  <head>
    @include('clients.components.head')
  </head>

  <body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- Main Wrapper Start Here -->
    <div class="wrapper">
      {{-- <!-- Newsletter Popup Start -->
      <div class="popup_wrapper">
        <div class="test">
          <span class="popup_off">Close</span>
          <div class="subscribe_area text-center mt-60">
            <h2>Newsletter</h2>
            <p>
              Subscribe to the Volga mailing list to receive updates on new
              arrivals, special offers and other discount information.
            </p>
            <div class="subscribe-form-group">
              <form action="#">
                <input
                  autocomplete="off"
                  type="text"
                  name="message"
                  id="message"
                  placeholder="Enter your email address"
                />
                <button type="submit">subscribe</button>
              </form>
            </div>
            <div class="subscribe-bottom mt-15">
              <input type="checkbox" id="newsletter-permission" />
              <label for="newsletter-permission"
                >Don't show this popup again</label
              >
            </div>
          </div>
        </div>
      </div>
      <!-- Newsletter Popup End --> --}}
      @include('clients.components.header')
      @include($template)
      @include('clients.components.newsletter')
      @include('clients.components.footer')
      @yield('modal')
    </div>
    <!-- Main Wrapper End Here -->
    @include('clients.components.script')
  </body>

  <!-- Mirrored from htmldemo.net/volga/volga/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Sep 2024 06:17:39 GMT -->
</html>
