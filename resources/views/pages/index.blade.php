@extends("layouts.default")

@section("content")
    <div class="featured">
        <div class="row">
            <div class="small-12 columns">
                <div class="row">
                    <div class="small-12 columns">
                        <h1>Nordic Health<br />
                        Data Portal <span class="tag prototype">[prototype]</span> <small>&mdash; Making Nordic Health Data Visible</small></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        @include("search._form")
                    </div>
                </div>
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->
    </div>
    <!-- /featured -->

    <div class="row">
        <div class="small-12 columns">
            <ul class="featured-grid small-block-grid-1 medium-block-grid-3">
                <li>
                    <img src="{{ asset("/images/content/making_nordic_health_data_visible.png") }}" alt="Making Nordic Health Data Visible" />

                    <h2>Making Nordic Health Data Visible</h2>

                    <p>This is a project funded by NordForsk. The project period is from autumn 2014 until autumn 2016 and the project is a collaboration between the data archives in Norway, Sweden, Finland and Denmark. The goal is to make a search portal prototype for Nordic health data. For this purpose the portal is covering metadata from the data collections in the four data archives, and builds upon existing DDI documentation.</p>
                </li>
                <li>
                    <img src="{{ asset("/images/content/portal_for_nordic_health_data.png") }}" alt="Search Portal Prototype" />

                    <h2>Search Portal Prototype</h2>

                    <p>The purpose of the prototype is to demonstrate mechanisms to search and retrieve metadata for the catalogued datasets. It allows searching in metadata across repositories and studies, presenting the results in a standardised way.</p>
                </li>
                <li>
                    <img src="{{ asset("/images/content/collaboration_with_researchers.png") }}" alt="Input" />

                    <h2>Input</h2>

                    <p>The main user group for a portal like this is researchers. The prototype is based on input from the research community and experiences from other search portals. The work is carried out in dialog with other research infrastructures.</p>
                </li>
            </ul>
            <!-- /featured-grid.small-block-grid-1.medium-block-grid-3 -->
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->

@endsection
