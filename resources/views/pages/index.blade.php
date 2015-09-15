@extends("layouts.default")

@section("content")
    <div class="featured">
        <div class="row">
            <div class="small-12 columns">
                <h1>Nordic Health<br />
                    Data Portal <span class="tag prototype">[prototype]</span> <small>&mdash; Making Nordic Health Data Visible</small></h1>
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
                    <img src="/images/content/making_nordic_health_data_visible.png" alt="Making Nordic Health Data Visible" />

                    <h2>Making Nordic Health Data Visible</h2>

                    <p>The Nordic countries have a solid tradition for gathering high quality survey and administrative data that enable researchers to analyse and understand processes like ageing, socio-economic health differences, health risks and changing welfare service systems. However, locating and accessing the data can be a challenge. We will develop common practices for easier access to data resources across national borders and enhance the visibility of Nordic research in the European context.</p>
                </li>
                <li>
                    <img src="/images/content/portal_for_nordic_health_data.png" alt="Portal for Nordic Health Data" />

                    <h2>Portal for Nordic Health Data</h2>

                    <p>The main outcome of this project is a web portal prototype that helps researchers search and access the existing Nordic health research data. The portal will build upon the participating data archives’ existing DDI documentation. In order to provide an enhanced user experience, we will harmonize our documentation practices and, for example, expand our common controlled vocabularies to include concepts relevant for health data.</p>
                </li>
                <li>
                    <img src="/images/content/collaboration_with_researchers.png" alt="Collaboration with Researchers" />

                    <h2>Collaboration with Researchers</h2>

                    <p>We believe that reseachers know best what they need and an active dialogue with researchers is important to us. We will invite researchers to our meetings to share their experiences about finding and accessing Nordic health data, and to give feedback about the data portal prototype. We will also attend Nordic seminars and conferences to present our services and the project outcomes.</p>
                </li>
            </ul>
            <!-- /featured-grid.small-block-grid-1.medium-block-grid-3 -->
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->

    @include("shared._in_collaboration")
@endsection
