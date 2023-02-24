@extends('layout/admin-layout')

@section('space-work')

<h2 class="mb-4">Marks</h2>
<!-- Button trigger modal -->

<br>
<br>

<table class="table text-center">
    <thead class="thead-dark">
        <thead>
            <th>#</th>
            <th>Exam Name</th>
            <th>Marks/Que.</th>
            <th>Total Marks</th>
            <th>Edit</th>
        </thead>

    <tbody>
        @if(count($exams)>0)
        @php $x = 1; @endphp
            @foreach($exams as $exam)
                <tr>
                    <td>{{ $x++ }}</td>
                    <td>{{ $exam->exam_name }}</td>
                    <td>{{ $exam->marks }}</td>
                    <td>{{ count($exam->getQnaExam)*($exam->marks) }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">Exams not added yet!!</td>
            </tr>
        @endif
    </tbody>

</table>

<br>
<br>


@endsection
