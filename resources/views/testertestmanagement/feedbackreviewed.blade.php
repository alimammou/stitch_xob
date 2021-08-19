<x-app-layout>
    <x-slot name="header">

        <li class="nav-item navItem nIUser" id="showThisOnceLoggedIn">
            <div class="nav-item dropdown DDNavItem"><a class="dropdown-toggle linkDLUserNav" aria-expanded="false" data-toggle="dropdown" href="#">{{ Auth::user()->name }}</a>
                <div class="dropdown-menu menuDL">
                    <div class="divUserInfoNav">
                        <p class="dUINPara">Rank:&nbsp;<span class="dUINPSpan">Bronze</span></p>
                    </div><a class="dropdown-item mDLItem" href="/account">Account</a><a class="dropdown-item mDLItem" href="/notification">Notifications</a>
                    <a class="dropdown-item mDLItem mDLITomato" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </div>
        </li>

    </x-slot>

    <div class="divMainSec dMSNoPad">
        <div class="divCustomContainer">
            <div class="divPageTitleMain">
                <h2 class="headingPageTitleMain DDBGNHeading">Managing:&nbsp;<span class="spanPageTitleMain DDBGNHSpan">Game Title</span></h2>
            </div>
            <div class="divDashboardBack"><a class="linkDB" href="/tests/{{$test->id}}/tester">Back to game management</a></div>
            <div class="divFeedbackForm">
                <div class="dFFNotesHolder">
                    <div class="dFFNotes">
                        <p class="dFFNPara">Status:&nbsp;<span class="dFFNPSpan">Reviewed</span></p>
                        <p class="dFFNPara">Score:&nbsp;<span class="dFFNPSpan">{{$submission->score}}/3</span></p>
                        <p class="dFFNPara">Reward:&nbsp;<span class="dFFNPSpan">{{$submission->reward}}</span></p>
                    </div>
                </div>
                <div class="dFFContentHolder">
                    <div class="dFFContent">
                        <div >
                              <div class="dFFCQuestions" id="form" ></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script type="text/javascript">
    let form=<?php echo json_encode($submission->content, JSON_HEX_TAG); ?>;
    let reviews=<?php echo json_encode($submission->review, JSON_HEX_TAG); ?>;
    var x=JSON.parse(form);
    var review=JSON.parse(reviews);
    let render=document.getElementById('form');

    for (var i=0;i<x.length;i++)
    {
        if(x[i].type=="shorttext")
        {
            var question = document.createElement("div");
            if(review[i]=="2")
                question.innerHTML = "<p class=\"DDCFFBGridLAPara\">"+x[i].question+"</p> <p class=\"DDCFFBGridLAParaAnswer\">"+x[i].answer+"</p><div class=\"DDCFFBGridLAReview\"><div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-1\" name=\"radioAnswer1"+i+"\" disabled><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Great response</label></div> <div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-2\" name=\"radioAnswer1\" disabled checked=\"\"><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Average response</label></div> <div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-1\" name=\"radioAnswer1\" disabled><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Bad response</label></div>";
            else if(review[i]=="1")
                question.innerHTML = "<p class=\"DDCFFBGridLAPara\">"+x[i].question+"</p> <p class=\"DDCFFBGridLAParaAnswer\">"+x[i].answer+"</p><div class=\"DDCFFBGridLAReview\"><div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-1\" name=\"radioAnswer1"+i+"\" disabled><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Great response</label></div> <div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-2\" name=\"radioAnswer1\" disabled ><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Average response</label></div> <div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-1\" name=\"radioAnswer1\" disabled checked=\"\"><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Bad response</label></div>";
            else if(review[i]=="3")
                question.innerHTML = "<p class=\"DDCFFBGridLAPara\">"+x[i].question+"</p> <p class=\"DDCFFBGridLAParaAnswer\">"+x[i].answer+"</p><div class=\"DDCFFBGridLAReview\"><div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-1\" name=\"radioAnswer1"+i+"\" disabled checked=\"\"><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Great response</label></div> <div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-2\" name=\"radioAnswer1\" disabled ><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Average response</label></div> <div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-1\" name=\"radioAnswer1\" disabled><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Bad response</label></div>";

            question.className = "DDCFFBGridLA";
            render.appendChild(question);
        }
        else if(x[i].type=="largetext" )
        {
            var question = document.createElement("div");
            if(review[i]=="2")
                question.innerHTML = "<p class=\"DDCFFBGridLAPara\">"+x[i].question+"</p> <p class=\"DDCFFBGridLAParaAnswer\">"+x[i].answer+"</p><div class=\"DDCFFBGridLAReview\"><div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-1\" name=\"radioAnswer1"+i+"\" disabled><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Great response</label></div> <div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-2\" name=\"radioAnswer1\" disabled checked=\"\"><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Average response</label></div> <div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-1\" name=\"radioAnswer1\" disabled><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Bad response</label></div>";
            else if(review[i]=="1")
                question.innerHTML = "<p class=\"DDCFFBGridLAPara\">"+x[i].question+"</p> <p class=\"DDCFFBGridLAParaAnswer\">"+x[i].answer+"</p><div class=\"DDCFFBGridLAReview\"><div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-1\" name=\"radioAnswer1"+i+"\" disabled><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Great response</label></div> <div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-2\" name=\"radioAnswer1\" disabled ><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Average response</label></div> <div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-1\" name=\"radioAnswer1\" disabled checked=\"\"><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Bad response</label></div>";
            else if(review[i]=="3")
                question.innerHTML = "<p class=\"DDCFFBGridLAPara\">"+x[i].question+"</p> <p class=\"DDCFFBGridLAParaAnswer\">"+x[i].answer+"</p><div class=\"DDCFFBGridLAReview\"><div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-1\" name=\"radioAnswer1"+i+"\" disabled checked=\"\"><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Great response</label></div> <div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-2\" name=\"radioAnswer1\" disabled ><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Average response</label></div> <div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"formCheck-1\" name=\"radioAnswer1\" disabled><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"formCheck-1\">Bad response</label></div>";
            question.className = "DDCFFBGridLA";
            render.appendChild(question);
        }
        else if(x[i].type=="multiselect" )
        {
            var question = document.createElement("div");
            var options=x[i].options;
            var answers=x[i].answer;
            let ht="";
            var cc=0;
            for(var j=0;j<options.length;j++) {
                for (var z=0;z<answers.length;z++) {
                    if (options[j] == answers[z]) {
                        ht += "<p class=\"DDCFFBGridLAParaAnswer DDCFFBGridLAPAActive\">Option</p>";
                        cc = 1;
                    }
                }
                if(cc==0)
                {
                    ht +="<p class=\"DDCFFBGridLAParaAnswer \">Option</p>";
                }
                else {
                    cc=0;
                }

            }
            question.innerHTML="<p class=\"DDCFFBGridLAPara\">"+x[i].question+"</p> <div class=\"DDCFFBGridLAGrid\">"+ht+"</div>";
            question.className = "DDCFFBGridLA";
            render.appendChild(question);
        }
        else if(x[i].type=="select" )
        {
            var question = document.createElement("div");
            var options=x[i].options;
            let z="";
            for(var j=0;j<options.length;j++) {
                if (options[j] == x[i].answer) {
                    z += "<p class=\"DDCFFBGridLAParaAnswer DDCFFBGridLAPAActive\">Option</p>";

                }
                else
                    z +="<p class=\"DDCFFBGridLAParaAnswer \">Option</p>";


            }
            question.innerHTML=" <p class=\"DDCFFBGridLAPara\">"+x[i].question+"</p> <div class=\"DDCFFBGridLAGrid\">"+z+"</div>";
            question.className = "DDCFFBGridLA";
            render.appendChild(question);
        }
    }
</script>
