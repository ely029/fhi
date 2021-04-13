@if(session('alert'))
    <div class="alert">
        <span class="alert__text">{{ session('alert.message') }}</span>
        <button class="button button--transparent js-hide-alert">CLOSE</button>
    </div>
@endif