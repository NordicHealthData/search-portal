@extends("layouts.default")

@section("content")
    <div class="featured">
        <div class="row">
            <div class="small-12 columns">
                <h1>Nordic Health<br />
                    Data Portal <span class="tag prototype">[prototype]</span> <small>&mdash; Making Nordic Health Data Visible</small></h1>

                @include("search._form")
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
                    <li>DDA/DNA</li>
                    <li>FSD</li>
                    <li>NordForsk</li>
                    <li>NSD</li>
                    <li>SND</li>
                </ul>
                <!-- /small-block-grid-1.medium-block-grid-4 -->
            </div>
            <!-- /small-12.columns.text-center -->
        </div>
        <!-- /row -->
    </div>
    <!-- /block -->
@endsection
