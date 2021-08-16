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
                <div class="dFFContentHolder">
                    <div class="dFFContent">
                        <h4 class="dFFCHeading">{{$form->name}}</h4>
                        <div>
                            <div class="dFFCQuestions" id="form" ></div>
                            <div class="dFFCBtn"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script type="text/javascript">
    let form=<?php echo json_encode($form->form_builder_json, JSON_HEX_TAG); ?>;;
    console.log(form);
    var x=JSON.parse(form);
    console.log(x[0].type);
    let render=document.getElementById('form');
    for (var i=0;i<x.length;i++)
    {
        if(x[i].type=="shorttext")
        {
            var question = document.createElement("div");
            question.innerHTML = "<label class=\"labelMain dFFCQLabel\">"+x[i].question+"</label><input type=\"text\" required name=\"question-"+i+"\" class=\"inputMain\">";
            question.className = "dFFCQHold";
            render.appendChild(question);
        }
        else if(x[i].type=="largetext" )
        {
            var question = document.createElement("div");
            question.innerHTML = "<label class=\"labelMain dFFCQLabel\">"+x[i].question+"</label><textarea type=\"text\" required name=\"question-"+i+"\" class=\"inputMain\"></textarea>";
            question.className = "dFFCQHold";
            render.appendChild(question);
        }
        else if(x[i].type=="multiselect" )
        {
            var question = document.createElement("div");
            var options=x[i].options;
            let ht="";
            for(var j=0;j<options.length;j++) {

                ht += "<div class=\"custom-control custom-checkbox checkboxMainDiv dFFCQHCheckHolder\"><input class=\"custom-control-input checkboxMain dFFCQHCheck\" type=\"checkbox\" value="+x[i].options[j]+" id=\"option-"+i+"-"+j+"\" name=\"question-"+i+"[]\"><label class=\"custom-control-label checkboxMainLabel dFFCQHLabel\" for=\"option-"+i+"-"+j+"\">"+options[j]+"</label></div>"
            }
            question.innerHTML="<label class=\"labelMain dFFCQLabel\"><strong>"+x[i].question+"</strong></label><div class=\"dFFCQHSelect\">"+ht+"</div>";
            question.className = "dFFCQHold";
            render.appendChild(question);
        }
        else if(x[i].type=="select" )
        {
            var question = document.createElement("div");
            var options=x[i].options;
            let z="";
            for(var j=0;j<options.length;j++) {

                z += "<div class=\"custom-control custom-radio radioMainDiv dFFCQHRadioHolder\"><input class=\"custom-control-input radioMain dFFCQHRadio\" type=\"radio\" id=\"option-"+i+"-"+j+"\" value="+x[i].options[j]+" name=\"question-"+i+"\"><label class=\"custom-control-label radioMainLabel dFFCQHLabel\" for=\"option-"+i+"-"+j+"\">"+options[j]+"</label></div>"
            }
            question.innerHTML="<label class=\"labelMain dFFCQLabel\"><strong>"+x[i].question+"</strong></label><div class=\"dFFCQHSelect\">"+z+"</div>";
            question.className = "dFFCQHold";
            render.appendChild(question);
        }
    }
    function submit()
    {
        let answers=[];
        for(let i=0;i<x.length;i++)
        {
            if(x[i].type=="select") {
                var l=0
                var cboxes = document.getElementsByName('question-' + i);
                var len = cboxes.length;
                for (var z=0; z<len; z++) {
                    if(cboxes[z].checked)
                    {
                        answers[i]= cboxes[z].value;

                    }
                }
            }
            else if(x[i].type=="multiselect")
            {   answers[i]=[];
                var l=0;
                var cboxes = document.getElementsByName('question-' + i);
                var len = cboxes.length;
                for (var z=0; z<len; z++) {
                    if(cboxes[z].checked)
                    {
                        answers[i][l]= cboxes[z].value;
                        l++;
                    }
                }
            }
            else
                answers[i] = document.getElementsByName('question-'+ i)[0].value;
        }
        console.log(answers);
    }
</script>
