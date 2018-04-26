
@if( count($downlines) > 0 )

    <div class="row">
        
            @foreach( $downlines as $downline )

        <div class="col-md-3 text-center">
                <a href="/{{$downline->id}}/profile">
                    <div class="agent-downlines-con text-center">

                        <img src="{{ $downline->photo }}">
                        

                    </div>
                    <p class="text-center downlines-name">{{ $downline->name }}</p>
                </a>


        </div>
            @endforeach

    </div>
@endif