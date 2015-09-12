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
        <div class="small-12 medium-4 columns">
            <h2>Heading H2</h2>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat laboriosam in deleniti, eos quidem doloribus nobis. Quisquam, natus illum eius aliquam quaerat aperiam, obcaecati eum vero, inventore consectetur earum quibusdam.</p>
        </div>
        <!-- /small-12.medium-4.columns -->

        <div class="small-12 medium-4 columns">
            <h2>Heading H2</h2>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat laboriosam in deleniti, eos quidem doloribus nobis. Quisquam, natus illum eius aliquam quaerat aperiam, obcaecati eum vero, inventore consectetur earum quibusdam.</p>
        </div>
        <!-- /small-12.medium-4.columns -->

        <div class="small-12 medium-4 columns">
            <h2>Heading H2</h2>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat laboriosam in deleniti, eos quidem doloribus nobis. Quisquam, natus illum eius aliquam quaerat aperiam, obcaecati eum vero, inventore consectetur earum quibusdam.</p>
        </div>
        <!-- /small-12.medium-4.columns -->
    </div>
    <!-- /row -->

    <div class="block">
        <div class="row">
            <div class="small-12 columns text-center">
                <h2>In collaboration between</h2>

                <ul class="small-block-grid-1 medium-block-grid-5">
                    <li><a href="http://samfund.dda.dk/dda/default-en.asp" title="Danish Data Archive (DDA)"><img src="{{ asset('/images/content/partners/dda_logo.png') }}" alt="Danish Data Archive (DDA)" /></a></li>
                    <li><a href="http://www.fsd.uta.fi/en/" title="Finnish Social Science Data Archive (FSD)"><img src="{{ asset('/images/content/partners/fsd_logo.png') }}" alt="Finnish Social Science Data Archive (FSD)" /></a></li>
                    <li><a href="http://www.nordforsk.org/en" title="NordForsk"><img src="{{ asset('/images/content/partners/nordforsk_logo.png') }}" alt="NordForsk" /></a></li>
                    <li><a href="http://www.nsd.uib.no/nsd/english/index.html" title="Norwegian Social Science Data Services (NSD)"><img src="{{ asset('/images/content/partners/nsd_logo.png') }}" alt="Norwegian Social Science Data Services (NSD)" /></a></li>
                    <li><a href="http://snd.gu.se/en" title="Swedish National Data Service (SND)"><img src="{{ asset('/images/content/partners/snd_logo.png') }}" alt="Swedish National Data Service (SND)" /></a></li>
                </ul>
                <!-- /small-block-grid-1.medium-block-grid-4 -->
            </div>
            <!-- /small-12.columns.text-center -->
        </div>
        <!-- /row -->
    </div>
    <!-- /block -->
@endsection
