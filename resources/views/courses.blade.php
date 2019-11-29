@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Select Course') }}</div>
                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <select id="department" class="form-control input-lg dynamic" name="department" required autocomplete="department" data-dependent="year" autofocus>
                                        <option value="" disabled selected>Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->department }}"> {{ $department->department }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="year" class="form-control input-lg dynamic" name="year" required autocomplete="year" data-dependent="semester" autofocus>
                                        <option value="" disabled selected>Select Year</option>

                                            <option value=""> </option>

                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="semester" class="form-control input-lg dynamic" name="semester" required autocomplete="semester" data-dependent="subject" autofocus>
                                        <option value="" disabled selected>Select Semester</option>
                                        <option value=""> </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="subject" class="form-control input-lg dynamic" name="subject" required autocomplete="subject" autofocus>
                                        <option value="" disabled selected>Select Subject</option>
                                        <option value=""> </option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="application/javascript">
        // $(document).ready(function () {
        //     $(document).on('change', '.dynamic', function () {
        //         console.log("changed");
        //
        //         var dapartment = $(this).val();
        //         console.log(department);
        //     });
        // });

        $(document).ready(function(){


            $('.dynamic').change(function(){

                if($(this).val() != '')
                {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = $('input[name="_token"]').val();

                    var department = $('#department').val();
                    $.ajax({
                        url:"{{ route('dynamicdependentcontroller.fetch') }}",
                        method:"POST",
                        data:{select:select, value:value, _token:_token, dependent:dependent, department:department},
                        success:function(result)
                        {
                            console.log(result);
                            $('#'+dependent).html(result);
                        }

                    })
                }
            });

            $('#department').change(function(){
                $('#year').val('');
                $('#semester').val('');
                $('#subject').val('');

            });

            $('#year').change(function(){
                $('#semester').val('');

            });

            $('#semester').change(function(){
                $('#subject').val('');
            });

        });

    </script>
@endsection

