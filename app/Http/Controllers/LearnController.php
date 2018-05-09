<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Category;
use App\WordSet;
use App\Lang;
use App\Results;
use Validator;
use Illuminate\Support\Facades\Auth;

class LearnController extends Controller
{

    public function respontToAlg3()
    {
        return 123;
    }
    public function respondToChallange(Request $request)
    {
        $words=unserialize($request->slowo);
        $answers= array();
        $result=0;
        if($request->langType==0)
        {
            for($i=0;$i<=count($words)-2;$i+=2)
            {
                $answers[$i]=$request->input('odp'.$i);
                if($answers[$i]==$words[$i+1])
                    $result++;
            }
        }
        else
        {
            for($i=0;$i<=count($words)-2;$i+=2)
            {
                $answers[$i+1]=$request->input('odp'.($i+1));
                if($answers[$i+1]==$words[$i])
                    $result++;
            }
        }

        $res=$result/(count($words)/2);
        $id=-1;
        if(Auth::check())
        {
            $id= Auth::user()->role_id;
        }


        /*Make result*/
        $resultEnt=new Results();
        $resultEnt->user_id=Auth::user()->id;
        $resultEnt->word_set_id=$request->wordsetId;
        $resultEnt->result=$res;
        $resultEnt->save();
        if($res==1)
        {
            alert("Wpisałeś wszystko dobrze");
        }
        else
        {
            $r=(count($words)/2)-$result;
            alert("Zle wpisales ".$r);
        }
        return View('fake')->with(['message'=>'dobrze']);
    }
    public function challange($wordSetId)
    {

        $id=-1;
        if(Auth::check())
        {
            $id= Auth::user()->id;
            $wordSet=WordSet::find($wordSetId);

            $words = multiexplode(array(';'),$wordSet->words);
            for($i=0;$i<count($words);$i++)
            {
                $ran1=rand(0, count($words)-1);
                $ran2=rand(0, count($words)-1);
                $temp=$words[$ran1];
                $words[$ran1]=$words[$ran2];
                $words[$ran2]=$temp;
            }
            $wordsBeforeShift= implode(";",$words);
            $wordsAfterShift = multiexplode(array(',',';'),$wordsBeforeShift);
            $langList = Lang::all();
            return View('words.challange',['wordSetId'=>$wordSetId ,'userId'=> $id, 'wordSet'=>$wordSet, 'words'=> $wordsAfterShift ,'langList' =>$langList]);
        }
        else
            return View('fake');
    }
    public function respondToLearn(Request $request)
    {
        $words=unserialize($request->slowo);
        $answers= array();
        $result=0;
        if($request->langType==0)
        {
            for($i=0;$i<=count($words)-2;$i+=2)
            {
                $answers[$i]=$request->input('odp'.$i);
                if($answers[$i]==$words[$i+1])
                    $result++;
            }
        }
        else
        {
            for($i=0;$i<=count($words)-2;$i+=2)
            {
                $answers[$i+1]=$request->input('odp'.($i+1));
                if($answers[$i+1]==$words[$i])
                    $result++;
            }
        }
        $res=$result/(count($words)/2);
        if($res==1)
        {
            alert("Wpisałeś wszystko dobrze");
        }
        else
        {
            $r=(count($words)/2)-$result;
            alert("Zle wpisales ".$r);;
        }
        return View('fake')->with('message','aaaa');
    }
    public function respondToCheck(Request $request)
    {
        $words=unserialize($request->slowo);
        $answers= array();
        $result=0;
        if($request->langType==0)
        {
            for($i=0;$i<=count($words)-2;$i+=2)
            {
                $answers[$i]=$request->input('odp'.$i);
                if($answers[$i]==$words[$i+1])
                    $result++;
            }
        }
        else
        {
            for($i=0;$i<=count($words)-2;$i+=2)
            {
                $answers[$i+1]=$request->input('odp'.($i+1));
                if($answers[$i+1]==$words[$i])
                    $result++;
            }
        }
        $res=$result/(count($words)/2);

        $id=-1;
        if(Auth::check())
        {
            $id= Auth::user()->role_id;
        }
//        $request->session()->
        if($res==1)
        {
            alert("Wpisałeś wszystko dobrze");
        }
        else
        {
            $r=(count($words)/2)-$result;
            alert("Spróbuj ponownie. Zle wpisales ".$r);
        }

        return $this->index($request->wordsetId);

    }
    public function index($wordSetId)
    {

            $wordSet = WordSet::find($wordSetId);
            $words = multiexplode(array(';'),$wordSet->words);
            for($i=0;$i<count($words);$i++)
            {
                $ran1=rand(0, count($words)-1);
                $ran2=rand(0, count($words)-1);
                $temp=$words[$ran1];
                $words[$ran1]=$words[$ran2];
                $words[$ran2]=$temp;
            }
            $wordsBeforeShift= implode(";",$words);
            $wordsAfterShift = multiexplode(array(',',';'),$wordsBeforeShift);
            $langList = Lang::all();
            return View('words.learn',['wordSetId'=>$wordSetId , 'wordSet'=>$wordSet, 'words'=> $wordsAfterShift ,'langList' =>$langList]);

    }

}
function multiexplode ($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}