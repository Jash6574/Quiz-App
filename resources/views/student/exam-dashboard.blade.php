@extends('layout/layout-common')


@section('space-work')

    <div class="container"><Br>
        <p style="color:black">Welcome, {{ Auth::user()->name }}</p>
        <h1 class="text-center">{{ $exam[0]['exam_name'] }}</h1>

        @php $qcount = 1; @endphp
        @if($success==true)

            @if(count($qna)>0)
            <form action="" method="POST" class="mb-5" onsubmit="return isValid()">
                <input type="hidden" name="exam_id" value="{{ $exam[0]['id'] }}">
                @foreach($qna as $data)<br>
                <div >
                    <h5>(Q:{{ $qcount++ }})  {{ $data['question'][0]['question' ] }}</h5>
                    <input type="hidden" name="q[]" value="{{ $data['question'][0]['id'] }}">
                    <input type="hidden" name="ans_{{ $qcount-1 }}" id="ans_{{ $qcount-1 }}">
                    @php $acount = 'A'; @endphp
                    @foreach($data['question'][0]['answers'] as $answer)
                        <p>({{ $acount++ }})  {{ $answer['answer'] }}
                            <input type="radio" name="radio_{{ $qcount-1 }}" data-id="{{ $qcount-1 }}" class="select_ans" value="{{ $answer['id'] }}">
                        </p>
                    @endforeach
                </div>
                <br>
                @endforeach
                <div class="text-center">
                    <input type='submit' class="btn btn-info">
                </div>

            </form>
            @else
                <h3 class="text-center" style="color:red;">Questions are not Available!</h3>
            @endif

        @else
            <h3 class="text-center" style="color:red;">{{ $msg }}</h3>
        @endif
    </div>


<script>

    $(document).ready(function(){
        $('.select_ans').click(function(){
            var no = $(this).attr('data-id');

            $('#ans_'+no).val($(this).val());
        });


    });


    function isValid(){
            var result = true;

            var qlength = parseInt("{{$qcount}}")-1;
            $('.error_msg').remove();
            for(let i = 1; i <= qlength; i++){
                if($('#ans_'+i).val() == ""){
                    result = false;
                    $('#ans_'+i).parent().append('<span class="error_msg" style="color:red;">Please Select an Answer.</span>');
                    setTimeout(()=>{
                        $('.error_msg').remove();
                    },5000);
                }
            }

            return result;
        }

</script>


@endsection
