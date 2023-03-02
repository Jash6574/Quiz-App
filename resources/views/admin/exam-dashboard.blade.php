@extends('layout/admin-layout')

@section('space-work')

<h2 class="mb-4">Exams</h2>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addExamModel">
    Add Exams
</button>

<br>
<br>

<table class="table text-left">
<thead class="">

        <tr>
            <th>#</th>
            <th>Exam Name</th>
            <th>Subject</th>
            <th>Date</th>
            <th>Time Limit</th>
            <th>Attempt</th>
            <th>Add Question</th>
            <th>Show Question</th>
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
                <a href="#" class="addQuestion" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#addQnaModel">Add Questions</a>
            </td>
            <td>
                <a href="#" class="seeQuestions" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#seeQnaModel">See Questions</a>
            </td>
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



<!-- add answer model -->
<div class="modal fade" id="addQnaModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">


        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Q&A</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


            </div>
            <form id="addQna">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="exam_id" id="addExamId">

                    <input type="search" name="search" id="search" onkeyup="searchTable()" class="w-100" placeholder="Type to Search...">
                    <table class="table" id="questionsTable">
                        <thead>
                            <th>Select</th>
                            <th>Question</th>
                        </thead>
                        <tbody class="addBody"></tbody>
                    </table>

                    <!-- <select name="question" class="w-100" multiple multiselect-search="true" multiselect-select-all="true" onchange="console.log(this.selectedOptions)" required>
                    <option value="">vrunda</option>
                    <option value="">jash</option>
                    <option value="">bhavisha</option>
                    </select><br><br> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Q&A</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- see question model -->
<div class="modal fade" id="seeQnaModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">See Questions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <th>No.</th>
                            <th>Question</th>
                            <th>Delete</th>
                        </thead>
                        <tbody class="seeQuestionTable"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
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


        //add question

        $(".addQuestion").click(function(){
            var id = $(this).attr('data-id');
            $('#addExamId').val(id);

            $.ajax({
                url:"{{ route('getQuestions') }}",
                type:"GET",
                data:{exam_id:id},
                success:function(data){
                    if(data.success==true){
                        var questions = data.data;
                        var html = '';
                        if(questions.length > 0){
                            for(let i=0;i<questions.length;i++){
                                html +=`
                                    <tr>
                                        <td><input type="checkbox" value="`+questions[i]['id']+`" name="questions_ids[]"></td>
                                        <td>`+questions[i]['questions']+`</td>
                                    </tr>
                                `;
                            }
                        }else{
                            html += `
                                <tr>
                                    <td colspan='2'>
                                        Question not available
                                    </td>
                                </tr>
                            `;
                        }
                        $('.addBody').html(html);

                    }else{
                        alert(data.msg);
                    }
                }
            });
        });

        $("#addQna").submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('addQuestions') }}",
                type: "POST",
                data: formData,
                success: function(data) {
                    if (data.success == true) {
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                }
            });
        });


        // see questions
        $('.seeQuestions').click(function(){
            var id = $(this).attr('data-id');


            $.ajax({
                url:"{{ route('getExamQuestions') }}",
                type:"GET",
                data:{exam_id:id},
                success:function(data){
                    console.log(data);
                    var html = '';
                    var questions = data.data;

                    if(questions.length > 0){
                        for(let i = 0; i < questions.length; i++){
                            html +=`
                                <tr>
                                    <td>`+(i+1)+`</td>
                                    <td>`+questions[i]['question'][0]['question']+`</td>
                                    <td>
                                        <button class='btn btn-danger deleteQuestion' data-id='`+questions[i]['id']+`'>Delete</button>
                                    </td>
                                </tr>
                            `;
                        }

                    }else{
                        html +=`
                            <tr>
                                <td>Questions not found!!</td>
                            </tr>
                        `;
                    }
                    $('.seeQuestionTable').html(html);

                }
            });
        });


        //delete question
        $(document).on('click','.deleteQuestion',function(){
            var id = $(this).attr('data-id');
            var obj = $(this);
            $.ajax({
                url:"{{ route('deleteExamQuestions') }}",
                type:"GET",
                data:{id:id},
                success:function(data){
                    if(data.success == true){
                        obj.parent().parent().remove();
                    }else{
                        alert(data.msg)
                    }
                }
            })
        })
    });
</script>

<script>
    function searchTable(){
        var input, filter, table, tr, td, i, txtValue;

        input = document.getElementById('search');
        filter = input.value.toUpperCase();
        table = document.getElementById('questionsTable');
        tr = table.getElementsByTagName("tr");
        for(i=0; i < tr.length; i++){
            td = tr[i].getElementsByTagName("td")[1];
            if(td){
                txtValue = td.textContent || td.innerText;

                if(txtValue.toUpperCase().indexOf(filter) > -1){
                    tr[i].style.display = "";
                }else{
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>


@endsection
