<div>

            @if(count($comments)>0)
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <ul>
            @foreach($comments as $comment)
                <li>{{$comment}}</li>

            @endforeach
        </ul>
    </div>
                @endif
</div>
