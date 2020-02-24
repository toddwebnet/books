<?php
/**
 * all of this happens on a landing page, of course we could have broken this out into multiple routes
 */
?>
@extends('template')

@section('body')
    <div class="container"
            id="mainContainer"
    >Page Loading ...
    </div>
    <script type="text/javascript">
      $(document).ready(function () {
        loadTopBooks()
      })

      $(document).blur(function () {
        if ($('#mainContainer').html() == 'Page Loading ...') {
          alert('loading')
          loadTopBooks()
        }
      })

    </script>
@endsection
