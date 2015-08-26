@include("shared._head")

<body>
    @include("shared._header")

    <main id="content" role="main">
        @yield("content")
    </main>
    <!-- /content -->

    @include("shared._footer")
</body>

</html>
