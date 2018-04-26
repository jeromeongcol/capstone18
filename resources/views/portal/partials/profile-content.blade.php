<div class="profile-page wrapper">
    <div class="page-header page-header-small" filter-color="orange">
        <div class="page-header-image" data-parallax="true" style="background-image: url('{{ asset('layouts-default/assets/img/bg5.jpg') }}');">
        </div>
        <div class="container">
            <div class="content-center">
                <div class="photo-container">
                    <img src="{{ $profile->photo }}" alt="">
                </div>
                <h3 class="title">{{ $profile->lastname}}, {{ $profile->firstname}}</h3>
                <a>{{ $profile->email }}</a>
                <p class="category">{{ $profile->description }}</p>
                @if( $auth->user_id == $profile->user_id)
                    <a class="btn btn-info btn-round AgentUpdateBtn" id="{{ $auth->user_id }}">UPDATE</a>
                @endif
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="button-container">
                <a class="btn btn-primary btn-round btn-lg">Direct Downlines</a>
            </div>
            <br>

            <div id="Profile_Content">

              @include('portal.partials.downlines')

            </div>
                            

        </div>
    </div>

</div>