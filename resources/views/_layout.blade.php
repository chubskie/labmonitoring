<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lab Monitoring</title>
  @include('_styles')
  @yield('styles')
</head>

<body>
  @include('_sidebar')
  <div id="body">
    <div class="columns is-centered">
      <div class="column">
        <section class="section">
          <div class="container">

            @yield('body')

          </div>
        </section>
      </div>
    </div>

    @include('_scripts')
    @yield('scripts')
  </body>

  </html>
