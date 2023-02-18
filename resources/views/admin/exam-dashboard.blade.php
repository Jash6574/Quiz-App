@extends('layout/admin-layout')

@section('space-work')

<h2 class="mb-4">Exams</h2>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addExamModel">
    Add Exams
</button>

<br>
<br>

<table class="table">
<thead class="thead-dark">

        <tr>
            <th>#</th>
            <th>Exam Name</th>
            <th>Subject</th>
            <th>Date</th>
            <th>Time Limit</th>
            <th>Attempt</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>
        @if(count($exams)>0)

        @foreach($exams as $exam)
        <tr>
            <td>{{ $exam->id }}</td>
            <td>{{ $exam->exam_name }}</td>
            <td>{{ $exam->subjects [0]['subject'] }}</td>
            <td>{{ $exam->date }}</td>
            <td>{{ $exam->time }}Hrs</td>
            <td>{{ $exam->attempt }} Time/s</td>
            <td>
                <button class="btn btn-info editButton" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#editExamModel">Edit</button>
            </td>
            <td>
                <button class="btn btn-danger deleteButton" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#deleteExamModel">Delete</button>
            </td>
        </tr>
        @endforeach

        @else
        <tr>
            <td colspan='5'>Exam not Found !!</td>
        </tr>
        @endelse
        @endif



    </tbody>
</table>


<!-- model -->
<div class="modal fade" id="addExamModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">


        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


            </div>
            <form id="addExam">
                @csrf
                <div class="modal-body">
                    <input type="text" name="exam_name" placeholder="Enter Exam Name" class="w-100" required><br><br>
                    <select name="subject_id" required class="w-100">

                        <option value="" hidden>Select Subject</option>
                        @if(count($subject) > 0)
                        @foreach($subject as $subject)
                        <option value="{{ $subject->id }}">{{$subject->subject}}</option>
                        @endforeach
                        @endif
                    </select><br><br>

                    <input type="date" name="date" class="w-100" required min="<?php echo date('Y-m-d') ?>"><br><br>
                    <input type="time" name="time" class="w-100" required><br><br>
                    <input type="number" name="attempt" placeholder="Enter exam attempt time" min="1" class="w-100" required><br><br>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Exam</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- edit model -->
<div class="modal fade" id="editExamModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">


        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


            </div>
            <form id="editExam">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="exam_id">
                    <input type="text" name="exam_name" id="exam_name" placeholder="Enter Exam Name" class="w-100" required><br><br>

                    <select name="subject_id" id="subject_id" required class="w-100">
                    <option value="" hidden>Select Subject</option>
                        @if(is_countable($subject) && count($subject) > 0)
                            @foreach($subject as $subject)
                                <option value="{{ $subject->id }}">{{$subject->subject}}</option>
                            @endforeach
                        @endif
                    </select><br><br>

                    <input type="date" name="date" id="date" class="w-100" required min="<?php echo date('Y-m-d') ?>"><br><br>
                    <input type="time" name="time" id="time" class="w-100" required><br><br>
                    <input type="number" name="attempt" id="attempt" placeholder="Enter exam attempt time" min="1" class="w-100" required><br><br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Exam</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- delete modal -->
<div class="modal fade" id="deleteExamModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">


        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


            </div>
            <form id="deleteExam">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="exam_id" id="deleteExamId">
                    <p>Are you sure you want to Delete Exam?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete Exam</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $("#addExam").submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('addExam') }}",
                type: "POST",
                data: formData,
                success: function(data) {
                    if (data.success == true) {
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                }


            })
        });


        $(".editButton").click(function() {
            var id = $(this).attr('data-id');
            $("#exam_id").val(id);

            var url = '{{ route("getExamDetail","id") }}';
            url = url.replace('id', id);


            $.ajax({
                url: url,
                type: "GET",
                success: function(data) {
                    if (data.success == true) {
                        var exam = data.data;
                        $('#exam_name').val(exam[0].exam_name);
                        $('#subject_id').val(exam[0].subject_id);
                        $('#date').val(exam[0].date);
                        $('#time').val(exam[0].time);
                        $('#attempt').val(exam[0].attempt);

                    } else {
                        alert(data.msg);
                    }
                }
            })
        });


        //edit
        $("#editExam").submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('updateExam') }}",
                type: "POST",
                data: formData,
                success: function(data) {
                    if (data.success == true) {
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                }
            })
        });

        //delete

        $(".deleteButton").click(function(){
            var id = $(this).attr('data-id');
            $('#deleteExamId').val(id);
        })

        $("#deleteExam").submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('deleteExam') }}",
                type: "POST",
                data: formData,
                success: function(data) {
                    if (data.success == true) {
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                }


            })
        });
    });
</script>

@endsection
