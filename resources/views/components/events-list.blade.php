<div>
    <!-- When there is no desire, all things are at peace. - Laozi -->
    <ul class="list-group">
        @foreach($events as $event)
        <li class="list-group-item">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('events.show', $event->id) }}">
                        <h5>{{ $event->name }}</h5>
                    </a>
                </div>
                <div class="col-12">
                    {{$event->location}}
                </div>
                <div class="col-6">
                    {{$event->date}}
                </div>
                <div class="col-6">
                    {{$event->time}}
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>