<x-app-layout>
    <x-slot name="header">

        <li class="nav-item navItem nIUser" id="showThisOnceLoggedIn">
            <div class="nav-item dropdown DDNavItem"><a class="dropdown-toggle linkDLUserNav" aria-expanded="false" data-toggle="dropdown" href="#">{{ Auth::user()->name }}</a>
                <div class="dropdown-menu menuDL">
                    <div class="divUserInfoNav">
                        <p class="dUINPara">Rank:&nbsp;<span class="dUINPSpan">Bronze</span></p>
                    </div><a class="dropdown-item mDLItem" href="/account">Account</a>
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
    <div class="divMainContent">
        <div class="divMainSec dMSNoPad">
            <div class="divCustomContainer">
                <div class="divPageTitleMain">
                    <h2 class="headingPageTitleMain">Managing:&nbsp;<span class="spanPageTitleMain">{{$test->title}}</span></h2>
                </div>
                <div class="divDashboardBack"><a class="linkDB" href="/dashboard">Back to dashboard</a></div>
                <div class="divDashboard DDManageTest">
                    <div class="divDTabsHolder">
                        <div class="divDTabs"><a class="linkDT " href="/tests/{{$test->id}}/manage">Edit Test</a><a class="linkDT" href="/tests/{{$test->id}}/keysinvites">Keys &amp; Invites</a><a class="linkDT linkDTActive" href="/tests/{{$test->id}}/forms">Feedback Forms</a><a class="linkDT" href="/tests/{{$test->id}}/bugreports">Bug Reports</a><a class="linkDT " href="/tests/{{$test->id}}/nda">NDA</a></div>
                        <div class="divDOther">
                            <p class="divDOPara">Remaining points:&nbsp;<span class="divDOPSpan">{{$test->remaining_points}}</span></p>
                        </div>
                        <div class="divDOther"><a class="btn btnMain btnMainFull btnMainFullLighter btnMainFullLighter" role="button" href="/tests/{{$test->id}}/delete">Delete test</a></div>
                    </div>
                    <form action="/tests/{{$test->id}}/forms/{{$form->id}}/submissions/{{$submissions->id}}" method="post" class="divDContentHolder">
                        @csrf
                        <div class="DDCFFBlank">
                            <div class="DDCFFBGridListAnswers" id="form">

                            </div>
                        </div>
                        <div class="DDCFFAction">
                            <div class="DDCFFALegit"><label class="DDCFFALLabel">Is this report spam?</label><select name="spam" required class="inputMain">
                                    <optgroup label="Spam?" class="optgroupMain">
                                        <option value="0" selected="">No</option>
                                        <option value="1">Yes</option>
                                    </optgroup>
                                </select></div>
                            <div class="DDCFFALegit"><label class="DDCFFALLabel">Reward amount</label><input type="number" name="reward" class="inputMain"min="0" max="{{$test->remaining_points}}" required placeholder="00"></div>
                            <div class="DDCFFAButton"><button class="btn btnMain btnMainFull btnMainFullLighter" type="submit">Complete review</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    </x-app-layout>
<script type="text/javascript">
    let form=<?php echo json_encode($submissions->content, JSON_HEX_TAG); ?>;
    var x=JSON.parse(form);
    let render=document.getElementById('form');
    for (var i=0;i<x.length;i++)
    {
        if(x[i].type=="shorttext")
        {
            var question = document.createElement("div");
            question.innerHTML = "<p class=\"DDCFFBGridLAPara\">"+x[i].question+"</p> <p class=\"DDCFFBGridLAParaAnswer\">"+x[i].answer+"</p><div class=\"DDCFFBGridLAReview\"><div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"option-"+i+"-1\" value=\"3\" name=\"score"+i+"\"><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"option-"+i+"-1\">Great response</label></div> <div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"option-"+i+"-1\" value=\"2\" name=\"score"+i+"\"><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"option-"+i+"-"+j+"\">Average response</label></div> <div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"option-"+i+"-"+j+"\" value=\"2\" name=\"score"+i+"\"><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"option-"+i+"-1\">Bad response</label></div>";
            question.className = "DDCFFBGridLA";
            render.appendChild(question);
        }
        else if(x[i].type=="largetext" )
        {
            var question = document.createElement("div");
            question.innerHTML = "<p class=\"DDCFFBGridLAPara\">"+x[i].question+"</p> <p class=\"DDCFFBGridLAParaAnswer\">"+x[i].answer+"</p><div class=\"DDCFFBGridLAReview\"><div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"option-"+i+"-1\" value=\"3\" name=\"score"+i+"\"><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"option-"+i+"-1\">Great response</label></div> <div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"option-"+i+"-1\" value=\"2\" name=\"score"+i+"\"><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"option-"+i+"-"+j+"\">Average response</label></div> <div class=\"form-check DDCFFBGridLAR\"><input class=\"form-check-input DDCFFBGridLARCheck\" type=\"radio\" id=\"option-"+i+"-"+j+"\" value=\"2\" name=\"score"+i+"\"><label class=\"form-check-label DDCFFBGridLARLabel\" for=\"option-"+i+"-1\">Bad response</label></div>";
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
            question.innerHTML=" <input hidden name=\"score[]\" value=\"3\"><p class=\"DDCFFBGridLAPara\">"+x[i].question+"</p> <div class=\"DDCFFBGridLAGrid\">"+ht+"</div>";
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
            question.innerHTML="<input hidden name=\"score[]\" value=\"3\"> <p class=\"DDCFFBGridLAPara\">"+x[i].question+"</p> <div class=\"DDCFFBGridLAGrid\">"+z+"</div>";
            question.className = "DDCFFBGridLA";
            render.appendChild(question);
        }
    }
</script>
