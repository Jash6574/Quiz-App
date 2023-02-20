@extends('layout/student-layout')

@section('space-work')

<h2>Exam</h2>

<table class="table">
    <thead>
        <th>#</th>
        <th>Exam Name</th>
        <th>Subject Name</th>
        <th>Date</th>
        <th>Time</th>
        <th>Total Attempt</th>
        <th>Available Attempt</th>
        <th>Copy Link</th>
    </thead>

    <tbody>
        @if(count($exams) > 0)
        @php $count = 1; @endphp
            @foreach($exams as $exam)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $exam->exam_name }}</td>
                    <td>{{ $exam->subjects[0]['subject'] }}</td>
                    <td>{{ $exam->date }}</td>
                    <td>{{ $exam->time }} Hrs</td>
                    <td>{{ $exam->attempt }} Time/s</td>
                    <td></td>
                    <td><a href="#" class="copy" data-code="{{ $exam->enterance_id }}">Click here to copy  <i class="fa fa-copy"></i></a></td>
                </tr>
            @endforeach
        @else

        <tr>
            <td colspan="8">There is No Exams</td>
        </tr>
        @endif
    </tbody>
</table>


<script>
    $(document).ready(function(){
        $('.copy').click(function(){
            $(this).parent().append('<pre class="copied_text text-white bg-dark p-1" style="width: fit-content;">Copied!</pre>');

            var code = $(this).attr('data-code');
            var url = "{{URL::to('/')}}/exam/"+code;

            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            document.execCommand("copy");
            $temp.remove();

            setTimeout(()=>{
                $('.copied_text').remove();
            },500);
        })
    })
</script>

@endsection
