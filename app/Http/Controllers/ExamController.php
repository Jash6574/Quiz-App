<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\QnaExam;
use App\Models\ExamAttempt;
use App\Models\ExamAnswer;

class ExamController extends Controller
{
    //
    public function loadExamDashboard($id)
    {
        $qnaExam = Exam::where('enterance_id', $id)->with('getQnaExam')->get();
        if (count($qnaExam) > 0) {
    $attemptCount = ExamAttempt::where(['exam_id'=>$qnaExam[0]['id'],'user_id'=>auth()->user()->id])->count();

           if($attemptCount >= $qnaExam[0]['attempt']){
            return view('student.exam-dashboard', ['success' => false, 'msg' => 'You already attempted this exam.', 'exam' => $qnaExam]);
           }
            else if ($qnaExam[0]['date'] == date('Y-m-d')) {
                if (count($qnaExam[0]['getQnaExam']) > 0) {
                    $qna = QnaExam::where('exam_id',$qnaExam[0]['id'])->with('question','answers')->inRandomOrder()->get();
                    return view('student.exam-dashboard', ['success' => true,'exam' => $qnaExam,'qna'=>$qna]);

                } else {
                    return view('student.exam-dashboard', ['success' => false, 'msg' => 'This Exam is not available for now!!', 'exam' => $qnaExam]);
                }
            } else if ($qnaExam[0]['date'] > date('Y-m-d')) {
                return view('student.exam-dashboard', ['success' => false, 'msg' => 'This Exam Will be start on ' . $qnaExam[0]['date'], 'exam' => $qnaExam]);
            } else {
                return view('student.exam-dashboard', ['success' => false, 'msg' => 'Sorry!! This Exam has been Expired on ' . $qnaExam[0]['date'], 'exam' => $qnaExam]);
            }
        } else {
            return view('404');
        }
    }



    public function examSubmit(Request $request){


        $attempt_id = ExamAttempt::insertGetId([
            'exam_id' => $request->exam_id,
            'user_id' => Auth::user()->id
        ]);
        $qcount = count($request->q);
        if($qcount > 0){
            for($i = 0; $i<$qcount ;$i++){
                if(!empty($request->input('ans_'.($i+1)))){
                    ExamAnswer::insert([
                        'attempt_id' => $attempt_id,
                        'question_id' => $request->q[$i],
                        'answer_id' => request()->input('ans_'.($i+1)),
                    ]);
                }
            }
        }

        return view('thank-you');
    }


    public function resultDashboard(){
        $attempts = ExamAttempt::where('user_id',Auth()->user()->id)->with('exam')->orderBy('updated_at')->get();
        return view('student.results',compact('attempts'));
    }
}
