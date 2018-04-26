@extends('layouts-agent.app')

@section('content')

    <div class="landing-page wrapper">
        <div class="page-header page-header-small">
            <div class="page-header-image" data-parallax="true" style="background-image: url('{{ asset('layouts-default/assets/img/bg6.jpg') }}');">
            </div>
            <div class="container">
                <div class="content-center">
                    <h1 class="title">WELCOME -/-</h1>
                </div>
            </div>
        </div>


                <div class="section section-about-us">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto text-center">
                        <h2 class="title">LATEST PROJECTS</h2>
                    </div>
                </div>
                <div class="separator separator-primary"></div>


                @if( count( $projects ) )
                <div class="row">
                    

                    @foreach( $projects as $project )
                    
                        <div class="product-item col-xs-12 col-lg-4">

                    <a href="/project/{{ $project->id }}/info" target="_blank">
                           <div class="product-container">
                                <div class="product-img">
                                    <img src="{{ $project->featured_photo }}" class="actionViewProject" id="{{ $project->id }}">
                                    
                                    <div class="item-upper-con">

                                        <div class="product-action text-right">

                                          <button class="btn btn-primary btn-simple btn-round btn-category" type="button">{{ $project->type }}</button> 

                                        </div>

                                    </div>

                                    <div class="item-lower-con">

                                        <p class="project-name">{{ $project->project_name }}</p>

                                        <p class="project-address">{{ $project->project_location }}</p>
                                        
                                    </div>
                                </div>

                                <div class="project-added-by-con">

                                    <span class="pull-left">Added : {{ Carbon\Carbon::parse($project->created_at)->diffForHumans() }}
                                    </span>

                                    <span class="pull-right">{{  date('d-m-Y', strtotime($project->created_at)) }} <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                           </div>

                    </a>
                        </div>


                    @endforeach
                        






                </div>

                @endif


            </div>
        </div>


    </div>
@endsection



