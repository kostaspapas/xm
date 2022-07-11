@extends('layouts.app')
@section('content')
    <script>
        $( function() {
            $("#start_date").datepicker({
                maxDate: "0d"
            });
            $("#end_date").datepicker({
                maxDate: "0d",
            });

            $.validator.addMethod("lessThanOrEqualsTo", function(value, element) {
                let startDate = $( "#start_date" ).datepicker( "getDate" );
                let endDate = $( "#end_date" ).datepicker( "getDate" );

                return Date.parse(startDate) <= Date.parse(endDate) || value == "";
            }, "Start date must be less than or equals to end date");

            $("#input-form").validate({
                errorClass: "ui-state-error",

                rules: {
                    company_symbol: {
                        required: true
                    },
                    start_date: {
                        required: true,
                        date: true,
                        lessThanOrEqualsTo: "#end_date"
                    },
                    end_date: {
                        required: true,
                        date: true,
                        lessThanOrEqualsTo: "#end_date"
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    start_date: {
                        required: "Please enter the start date",
                        date: "Please enter a valid date"
                    },
                    end_date: {
                        required: "Please enter the end date",
                        date: "Please enter a valid date"
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email"
                    }
                },
                errorPlacement: function( error, element ) {
                    $( "<br>" ).appendTo( element.parent().find( "label" ) );
                    error.appendTo( element.parent().find( "label" ) );
                }
            });
        });
    </script>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                Search form
            </div>
            <div class="card-body">
                <form name="input-form" id="input-form" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="company_symbol">Company symbol</label>
                        <select id="company_symbol" name="company_symbol" class="form-control">
                            @foreach ($company_symbols as $symbol)
                                <option value="{{ $symbol->symbol }}">{{ $symbol->symbol }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="start_date">Start date</label>
                        <input id="start_date" name="start_date" type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="end_date">End date</label>
                        <input id="end_date" name="end_date" type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
