@extends("layouts.default")

@section("content")
    <img src="{{ asset("/images/content/nordic_health_data_group.jpg") }}" class="featured" alt="Nordic Health Data (group photo)" />

    <div class="row">
        <div class="small-12 columns">
            <h2>Making Nordic Health Data Visible</h2>
        </div>
      <!-- /small-12.columns -->
    </div>
    <!-- /row -->

    <div class="row">
        <div class="small-12 medium-7 columns">
            <p>This project is a collaboration between the national data archives of the Nordic countries: <a href="http://www.nsd.uib.no/nsd/english/index.html" title="Norwegian Social Science Data Services (NSD)">NSD</a>, <a href="http://snd.gu.se/en" title="Swedish National Data Service (SND)">SND</a>, <a href="http://www.fsd.uta.fi/en/" title="Finnish Social Science Data Archive (FSD)">FSD</a> and <a href="http://samfund.dda.dk/dda/default-en.asp" title="Danish Data Archive (DDA)">DDA</a>. <a href="http://www.nordforsk.org/en/news/nordforsk-invests-in-biobank-and-registry-research" title="NordForsk">NordForsk awarded the project a grant</a> of NOK 490 000 for the period 2014‒2016.</p>

            <p>Our objective is to develop common practices for storing and disseminating health-related data across national borders, taking advantage of synergies between the Nordic countries. The project will build a portal prototype for Nordic health data for research purpose and enhance the visibility of Nordic research in a European context. The work will also lay the ground for further collaboration in finding solutions to common challenges and possibilities with regard to data curation, preservation and data sharing in the Nordic countries.</p>

            <p>For more information, please contact the project leader <a href="http://www.uib.no/personer/Dag.Kiberg" title="University of Bergen: Dag Kiberg">Dag Kiberg</a> of the <a href="http://www.nsd.uib.no/nsd/english/index.html" title="Norwegian Social Science Data Services (NSD)">Norwegian Social Science Data Services (NSD)</a>.</p>
        </div>
        <!-- /small-12.medium-7.columns -->

        <aside class="small-12 medium-5 columns">
            <h3>Upcoming meetings</h3>

            <ul class="timeline">
                <li>Autumn 2016 in Bergen: Closing meeting</li>
                <li class="next"><span>Next up</span> March 2016 in Gothenburg: 2nd hackathon and 5th meeting</li>
                <li class="history">October 2015 in Tampere: 4th meeting</li>
                <li class="history">August 2015 in Bergen: 1st hackathon and 3rd meeting</li>
                <li class="history">January 2015 in Copenhagen: pre-hackathon  and 2nd meeting</li>
                <li class="history">October 2014 in Göteborg: Kick-off meeting</li>
            </ul>
            <!-- /timeline -->
        </aside>
        <!-- /small-12.medium-5.columns -->
    </div>
    <!-- /row -->

    @include("shared._in_collaboration")
@endsection
