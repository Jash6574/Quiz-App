@extends('layout/admin-layout')

@section('space-work')

<h2 class="mb-4">Q&A</h2>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQnaModel">
    Add Q&A
</button>
<br>
<br>

<table class="table text-center">
    <thead class="thead-dark">
        <thead>
            <th>#</th>
            <th>Question</th>
            <th>Answers</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>

    <tbody>
        @if(count($questions)>0)
        @foreach($questions as $question)
        <tr>
            <td>{{$question->id}}</td>
            <td>{{$question->question}}</td>
            <td>
                <a href="#" class="ansButton" data-id="{{$question->id}}" data-toggle="modal" data-target="#showAnsModal">See Answers</a>
            </td>
            <td>
                <button class="btn btn-info editButton" data-id="{{$question->id}}" data-toggle="modal" data-target="#editQnaModal">Edit</button>
            </td><td>
                <button class="btn btn-danger deleteButton" data-id="{{$question->id}}" data-toggle="modal" data-target="#deleteQnaModal">Delete</button>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="3">Questions & Answers are not found</td>
        </tr>
        @endif
    </tbody>

</table>

<br>
<br>




<!-- model -->
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
                <div class="modal-body addModalAnswers">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="w-100" name="question" placeholder="Enter Question" required>
                            <button class="mt-2 mb-2 btn btn-info" id="addAnswer" style="float: right;">Add Answer</button>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="error" style="color: red;"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Q&A</button>
                </div>
            </form>
        </div>
    </div>
</div>






<!-- show ans model -->
<div class="modal fade" id="showAnsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">


        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Show Answer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Answer</th>
                        <th></th>
                    </thead>

                    <tbody class="showAnswers">

                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <span class="error" style="color: red;"></span>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<!-- Edit Qna model -->
<div class="modal fade" id="editQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">


        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Q&A</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editQna">
                @csrf
                <div class="modal-body editModalAnswers">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="question_id" id="question_id">
                            <input type="text" class="w-100" name="question" id="question" placeholder="Enter Question" required>
                            <button class="mt-2 mb-2 btn btn-info" id="addEditAnswer" style="float: right;">Add Answer</button>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="editError" style="color: red;"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Q&A</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- delete Qna modal -->
<div class="modal fade" id="deleteQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">


        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete Q&A</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


            </div>
            <form id="deleteQna">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="delete_qna_id">
                    <p>Are you sure you want to Delete Q&A?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete Q&A</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        //form submission
        $("#addQna").submit(function(e) {
            e.preventDefault();

            if ($(".answers").length < 2) {
                $(".error").text("Please add minimum two answers.")
                setTimeout(function() {
                    $(".error").text("")
                }, 2000);
            } else {
                var checkIsCorrect = false;

                for (let i = 0; i < $(".is_correct").length; i++) {

                    if ($(".is_correct:eq(" + i + ")").prop('checked') == true) {
                        checkIsCorrect = true;
                        $(".is_correct:eq(" + i + ")").val($(".is_correct:eq(" + i + ")").next().find('input').val());
                    }

                }

                if (checkIsCorrect) {
                    var formData = $(this).serialize();
                    $.ajax({
                        url: "{{ route('addQna') }}",
                        type: "POST",
                        data: formData,
                        success: function(data) {
                            console.log(data);
                            if (data.success == true) {
                                location.reload();
                            } else {
                                alert(data.msg);
                            }

                        }
                    })
                } else {
                    $(".error").text("Please select an Answer.")
                    setTimeout(function() {
                        $(".error").text("")
                    }, 2000)
                }
            }
        });

        //add answer

        $("#addAnswer").click(function() {

            if ($(".answers").length >= 4) {
                $(".error").text("You can add Maximum 4 answers")
                setTimeout(function() {
                    $(".error").text("")
                }, 2000)
            } else {
                var html = `
                <div class="mt-2 row answers">
                <input type="radio" name="is_correct" class="ml-3 is_correct">
                    <div class="col">
                        <input type="text" class="ml-1 w-100" name="answers[]" placeholder="Enter Answer" required>
                    </div>
                    <button class="ml-4 mr-3 btn btn-danger removeButton" style="line-height:1">X</button>
                </div>
            `;
                $(".addModalAnswers").append(html);
            }
        });


        $(document).on("click", ".removeButton", function() {
            $(this).parent().remove();
        });


        //show answers

        $(".ansButton").click(function() {

            var questions = @json($questions);
            var qid = $(this).attr('data-id');
            var html = '';
            console.log(questions);

            for (let i = 0; i < questions.length; i++) {

                if (questions[i]['id'] == qid) {

                    var answerLength = questions[i]['answers'].length;
                    for (let j = 0; j < answerLength; j++) {

                        let is_correct = "False";
                        if (questions[i]['answers'][j]['is_correct'] == 1) {
                            is_correct = 'True';
                        }



                        html += `
                            <tr>
                                <td>` + (j + 1) + `</td>
                                <td>` + questions[i]['answers'][j]['answer'] + `</td>
                                <td>` + is_correct + `</td>
                            </tr>
                        `;
                    }

                    break;
                }
            }

            $('.showAnswers').html(html);
        });



        //edit answer

        $("#addEditAnswer").click(function() {

            if ($(".editAnswers").length >= 4) {
                $(".editError").text("You can add Maximum 4 answers")
                setTimeout(function() {
                    $(".editError").text("")
                }, 2000)
            } else {
                var html = `
                    <div class="mt-2 row editAnswers">
                    <input type="radio" name="is_correct" class="ml-3 edit_is_correct">
                        <div class="col">
                            <input type="text" class="ml-1 w-100" name="new_answers[]" placeholder="Enter Answer" required>
                        </div>
                        <button class="ml-4 mr-3 btn btn-danger removeButton" style="line-height:1">X</button>
                    </div>
                `;
                $(".editModalAnswers").append(html);
            }
        });

        $(".editButton").click(function(){
            var qid = $(this).attr('data-id');

            $.ajax({
                url:"{{ route('getQnaDetails') }}",
                type:"GET",
                data:{qid:qid},
                success:function(data){
                    // console.log(data);

                    var qna = data.data[0];
                    $("#question_id").val(qna['id']);
                    $("#question").val(qna['question']);
                    $(".editAnswers").remove();


                    var html = '';

                    for(let i = 0; i < qna['answers'].length;i++){

                        var checked = '';
                        if(qna['answers'][i]['is_correct'] == 1){
                            checked = 'checked';
                        }

                        html += `
                            <div class="mt-2 row editAnswers">
                            <input type="radio" name="is_correct" class="ml-3 edit_is_correct" `+checked+`>
                                <div class="col">
                                    <input type="text" class="ml-1 w-100" name="answers[`+qna['answers'][i]['id']+`]" placeholder="Enter Answer" value="`+qna['answers'][i]['answer']+`" required>
                                </div>
                                <button class="ml-4 mr-3 btn btn-danger removeButton removeAnswer" data-id="`+qna['answers'][i]['id']+`" style="line-height:1">X</button>
                            </div>
                        `;
                    }
                $(".editModalAnswers").append(html);


                }
            })
        });


//update qna submition
        $("#editQna").submit(function(e) {
            e.preventDefault();

            if ($(".editAnswers").length < 2) {
                $(".editError").text("Please add minimum two answers.")
                setTimeout(function() {
                    $(".editError").text("")
                }, 2000);
            } else {
                var checkIsCorrect = false;

                for (let i = 0; i < $(".edit_is_correct").length; i++) {

                    if ($(".edit_is_correct:eq(" + i + ")").prop('checked') == true) {
                        checkIsCorrect = true;
                        $(".edit_is_correct:eq(" + i + ")").val($(".edit_is_correct:eq(" + i + ")").next().find('input').val());
                    }

                }

                if (checkIsCorrect) {

                   var formData = $(this).serialize();

                    $.ajax({
                    url:"{{ route('updateQna') }}",
                    type:"POST",
                    data:formData,
                    success:function(data){
                        if(data.success == true){
                            location.reload();
                        }
                        else{
                            alert(data.msg)
                        }
                    }

                })

                } else {
                    $(".editError").text("Please select an Answer.")
                    setTimeout(function() {
                        $(".editError").text("")
                    }, 2000)
                }
            }
        });


        //remove answers
        $(document).on('click','.removeAnswer',function(){
            var ansId = $(this).attr('data-id');

            $.ajax({
                url:"{{ route('deleteAns') }}",
                type:"GET",
                data:{ id:ansId },
                success:function(data){
                    if(data.success == true){
                        console.log(data.msg);
                    }
                    else{
                        alert(data.msg)
                    }
                }

            })
        })


        //delete

        $(".deleteButton").click(function(){
            var id = $(this).attr('data-id');
            $('#delete_qna_id').val(id);
        })

        $("#deleteQna").submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('deleteQna') }}",
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
