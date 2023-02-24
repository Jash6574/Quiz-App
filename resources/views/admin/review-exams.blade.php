@extends('layout/admin-layout')

@section('space-work')

<h2 class="mb-4">Exam Review</h2>

<br>
<br>

<table class="table text-center">
    <thead class="thead-dark">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Exam Name</th>
            <th>Status</th>
            <th>Review</th>
        </thead>

    <tbody>

        @if(count($attempts) > 0)
        @php $x=1; @endphp
            @foreach($attempts as $attempt)
                <tr>
                    <td>{{ $x++ }}</td>
                    <td>{{ $attempt->user->name }}</td>
                    <td>{{ $attempt->exam->exam_name }}</td>
                    <td>
                        @if($attempt->status == 0)
                            <span style="color:red">Pending</span>
                        @else
                            <span style="color:green">Completed</span>
                        @endif
                    </td>

                    <td>
                        @if($attempt->status == 0)
                            <a href="">Review & Approved</a>
                        @else
                            <span style="color:green">Completed</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">There is no Exam found for review!!</td>
            </tr>
        @endif

    </tbody>

</table>

<br>
<br>



@endsection
