@extends('layout/student-layout')

@section('space-work')


<h2>Results</h2>

<table class="table text-left">

    <thead>
        <th>#</th>
        <th>Exam</th>
        <th>Marks</th>
        <!-- <th>Status</th> -->
    </thead>

    <tbody>
        @if(count($attempts)>0)
        @php $x = 1; @endphp
            @foreach($attempts as $attempt)
                <tr>
                    <td>{{ $x++ }}</td>
                    <td>{{ $attempt->exam->exam_name }}({{ $attempt->exam->date }})</td>
                    <td>
                        @if($attempt->status == 0)
                            <p style="color:red">Result Not Declared</p>
                        @else
                            {{$attempt->marks}} marks
                        @endif
                    </td>
                    <!-- <td>
                        @if($attempt->status == 0)
                            <p style="color:red">Pending</p>
                        @else
                            <a href="#" data-id="{{ $attempt->id }}">Review your Answer</a>
                        @endif
                    </td> -->
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3">You not attempt any Exams yet.</td>
            </tr>
        @endif
    </tbody>

</table>

@endsection
