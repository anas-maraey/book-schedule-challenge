@extends('layouts.app')
@section('content')
    <script type="text/javascript">
        jQuery(document).ready(function($)
        {
            $('input.icheck').iCheck({
                checkboxClass: 'icheckbox_minimal',
                radioClass: 'iradio_minimal'
            });

            $('input.icheck-2').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
        });


        jQuery(document).ready(function($)
        {
            var icheck_skins = $(".icheck-skins a");

            icheck_skins.click(function(ev)
            {
                ev.preventDefault();

                icheck_skins.removeClass('current');
                $(this).addClass('current');

                updateiCheckSkinandStyle();
            });

            $("#icheck-style").change(updateiCheckSkinandStyle);
        });

        function updateiCheckSkinandStyle()
        {
            var skin = $(".icheck-skins a.current").data('color-class'),
                style = $("#icheck-style").val();

            var cb_class = 'icheckbox_' + style + (skin.length ? ("-" + skin) : ''),
                rd_class = 'iradio_' + style + (skin.length ? ("-" + skin) : '');

            if(style == 'futurico' || style == 'polaris')
            {
                cb_class = cb_class.replace('-' + skin, '');
                rd_class = rd_class.replace('-' + skin, '');
            }

            $('input.icheck-2').iCheck('destroy');
            $('input.icheck-2').iCheck({
                checkboxClass: cb_class,
                radioClass: rd_class
            });
        }
    </script>
    @if($errors->any())
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p><strong>Error: </strong> {{ $error }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        Schedule Form
                    </div>

                    <div class="panel-options">
                        {{--<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>--}}
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <div class="panel-body">
                    <form role="form" class="form-horizontal form-groups-bordered" method="POST" action="/schedule">

                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="guest_name" class="col-sm-2 control-label">Number of Sessions/Chapter</label>

                            <div class="col-sm-5">
                                <input type="number" class="form-control" value="" id="sessions_per_chapter" name="sessions_per_chapter" placeholder="Number of Sessions for each Chapter">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Week Days</label>

                            <div class="col-sm-5">
                                <select multiple="multiple" name="week_days[]" class="form-control multi-select">
                                    <option value="0">Saturday</option>
                                    <option value="1">Sunday</option>
                                    <option value="2">Monday</option>
                                    <option value="3">Tuesday</option>
                                    <option value="4">Wednesday</option>
                                    <option value="5">Thursday</option>
                                    <option value="6">Friday</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-sm-2 control-label">Starting Date</label>

                            <div class="col-sm-5">
                                <input type="text" name="starting_date" class="form-control datepicker" data-start-date="-2d" data-end-date="+1w">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-7">
                                <button type="submit" class="btn btn-default btn-icon icon-left">
                                    Submit
                                    <i class="entypo-list-add"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection

@section('plugins')
    @parent

    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset("assets/js/select2/select2-bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/js/select2/select2.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/js/selectboxit/jquery.selectBoxIt.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/js/daterangepicker/daterangepicker-bs3.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/js/icheck/skins/minimal/_all.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/js/icheck/skins/square/_all.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/js/icheck/skins/flat/_all.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/js/icheck/skins/futurico/futurico.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/js/icheck/skins/polaris/polaris.css") }}">
    <!-- Imported scripts on this page -->
    <script src="{{ asset("assets/js/bootstrap-switch.min.js") }}"></script>
    <script src="{{ asset("assets/js/select2/select2.min.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap-tagsinput.min.js") }}"></script>
    <script src="{{ asset("assets/js/typeahead.min.js") }}"></script>
    <script src="{{ asset("assets/js/selectboxit/jquery.selectBoxIt.min.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap-datepicker.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap-timepicker.min.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap-colorpicker.min.js") }}"></script>
    <script src="{{ asset("assets/js/moment.min.js") }}"></script>
    <script src="{{ asset("assets/js/daterangepicker/daterangepicker.js") }}"></script>
    <script src="{{ asset("assets/js/jquery.multi-select.js") }}"></script>
    <script src="{{ asset("assets/js/icheck/icheck.min.js") }}"></script>
    <script src="{{ asset("assets/js/neon-chat.js") }}"></script>
@endsection