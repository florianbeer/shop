<footer class="hidden-print">
  <div class="container">
    <div>
      <div class="col-sm-6">
        <p>&copy;{{ date('Y') }} <a href="http://42dev.eu">42dev</a> - {{ Lang::get('misc.footer-text') }}.</p>
        <p class="nowrap">
          {{ Lang::get('misc.language') }}:
        @foreach(Config::get('app.languages') as $locale => $language)
          <a href="{{ URL::route('switchLanguage', $locale) }}" title="{{ Lang::get('misc.switch-to-language', ['lang' => $language]) }}"><span class="flag flag-{{ $locale }}"></span></a>
        @endforeach
      </p>
      </div>
      <div class="col-sm-6">
        <div class="pull-right">
          <a href="#">Imprint</a> |
          <a href="#">Privacy policy</a> |
          <a href="#">Terms of service</a> |
          <a href="/contact">Contact us</a>
        </div>
      </div>
    </div>
  </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/main.js') }}
@yield('script')
</body>
</html>
