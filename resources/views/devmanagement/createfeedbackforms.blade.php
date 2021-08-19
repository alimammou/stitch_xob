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
    <div class="divDContentHolder">
        @if ($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('message'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('message') }}
            </div>
        @endif
        <form id="ff" action="/tests/{{$test->id}}/createform" method="POST">
            @csrf
            <input name="x" id="xxx" hidden>
        <div class="DDCFFTitle">
            <p class="DDCFFQPara">Feedback form title</p><input type="text" class="inputMain" id="title" name="title" placeholder="Title.." required>
        </div>
        <div class="DDCFF">
            <div class="DDCFFQuestions">
                <div class="DDCFFQHolder" id="gg">
                    <div class="DDCFFQ">
                        <input hidden value="shorttext">
                        <div class="DDCFFQWithAdd"><button class="btn btnMain btnMainFull btnMainFullLighter btnMainFullLighterRed" data-toggle="tooltip" data-bss-tooltip="" type="button" onclick="DeleteGParent(this)"><i class="fas fa-minus"></i></button>
                            <p class="DDCFFQPara">Short text question type</p>
                        </div><input type="text" class="inputMain" placeholder="Your question.." required>
                    </div>
                </div>
                <div class="DDCFFQBtn"><a class="btn btnMain btnMainFull btnMainFullLighter" role="button" type="submit"  onclick="gg()">Create form</a></div>
            </div>
            <div class="DDCFFAdd">
                <div class="DDCFFAH">
                    <div class="DDCFFAHolder">
                        <div class="DDCFFA"><label class="labelMain">Question type</label><select id="qtype" class="inputMain inputMFF"name="qtype">
                                <optgroup label="Question type" class="optgroupMain">
                                    <option value="0" selected>Short text</option>
                                    <option value="1">Large text</option>
                                    <option value="2">Single select (Radio)</option>
                                    <option value="3">Multiple select (Checkbox)</option>
                                </optgroup>
                            </select><button class="btn btnMain btnMainFull btnMainFullLighter" type="button"onclick="addquestion()">Add</button></div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>
    </div>
    </div>
    </div>








</x-app-layout>
<script type="text/javascript">
    function DeleteGParent(button){
        var x=button.parentElement;
        x.parentElement.remove();
        var c = document.getElementsByClassName("ui-tooltip-content");
        c[0].remove();
    }
    function deleteoption(button)
    {
        var x = button.parentElement;
        x = x.parentElement;
        if(x.childElementCount==3)
        {
            alert('a select question needs to have at least 2 options')
            return;
        }
        button.parentElement.remove();
        var c = document.getElementsByClassName("ui-tooltip-content");
        c[0].remove();
    }
    function addoption(button) {

        var x = button.parentElement;
        x = x.parentElement;
        x = x.parentElement;
        if(x.childElementCount>10)
        {
            alert('too many options')
            return;
        }
        var btn = document.createElement("div");
        btn.innerHTML = "<button class=\"btn btnMain btnMainFull btnMainFullLighter btnMainFullLighterRed\" data-toggle=\"tooltip\" data-bss-tooltip=\"\" type=\"button\" title=\"Add option\"onclick=\"deleteoption(this)\"><i class=\"fas fa-minus\" ></i></button><input type=\"text\" class=\"inputMain\" placeholder=\"Option..\" required>";
        btn.className = "DDCFFQFOptionHolder"
        x.appendChild(btn);
    }

        function addquestion(){
            var elem = document.getElementById('gg');
            var qtype=document.getElementById('qtype').value;

            if(document.getElementById('gg').childElementCount>29)
            {
                alert('too many questions');
                return;
            }
            if(qtype==0) {
                var btn = document.createElement("div");
                btn.innerHTML = " <input hidden value=\"shorttext\"><div class=\"DDCFFQWithAdd\"><button  class=\"btn btnMain btnMainFull btnMainFullLighter btnMainFullLighterRed\" data-toggle=\"tooltip\" data-bss-tooltip=\"\" type=\"button\" onclick=\"DeleteGParent(this)\"><i class=\"fas fa-minus\"></i></button> <p class=\"DDCFFQPara\">Short text question type</p> </div><input type=\"\" class=\"inputMain\" placeholder=\"Your question..\" required>"
                btn.className = "DDCFFQ"
                elem.appendChild(btn);
            }
            else if(qtype==1){
                var btn = document.createElement("div");
                btn.innerHTML = "<input hidden value=\"largetext\"><div class=\"DDCFFQWithAdd\"><button class=\"btn btnMain btnMainFull btnMainFullLighter btnMainFullLighterRed\" data-toggle=\"tooltip\" data-bss-tooltip=\"\" type=\"button\" onclick=\"DeleteGParent(this)\"><i class=\"fas fa-minus\"></i></button> <p class=\"DDCFFQPara\">Large text question type</p> </div><input type=\"\" class=\"inputMain\" placeholder=\"Your question..\" required>"
                btn.className = "DDCFFQ"
                elem.appendChild(btn);
            }
            else if(qtype==2){
                var btn = document.createElement("div");
                btn.innerHTML = "<input hidden value=\"select\"><div class=\"DDCFFQWithAdd\"><button onclick=\"DeleteGParent(this)\" class=\"btn btnMain btnMainFull btnMainFullLighter btnMainFullLighterRed\" data-toggle=\"tooltip\" data-bss-tooltip=\"\" type=\"button\" title=\"Add option\"><i class=\"fas fa-minus\"></i></button> <p class=\"DDCFFQPara\">Single select (Radio) question type</p> </div> <div class=\"DDCFFQField\"> <div class=\"DDCFFQQuestion DDCFFQQWithOptions\"><input type=\"text\" class=\"inputMain\" placeholder=\"Your question..\" required> <div class=\"DDCFFQQWO\"><button class=\"btn btnMain btnMainFull btnMainFullLighter\" data-toggle=\"tooltip\" data-bss-tooltip=\"\" type=\"button\"onclick=\"addoption(this)\" ><i class=\"fas fa-plus\"></i></button></div> </div> <div class=\"DDCFFQFOptionHolder\"><button class=\"btn btnMain btnMainFull btnMainFullLighter btnMainFullLighterRed\" data-toggle=\"tooltip\" data-bss-tooltip=\"\" type=\"button\" title=\"Add option\"onclick=\"deleteoption(this)\"><i class=\"fas fa-minus \"></i></button><input type=\"text\" class=\"inputMain\" placeholder=\"Option..\" required></div> <div class=\"DDCFFQFOptionHolder\"><button class=\"btn btnMain btnMainFull btnMainFullLighter btnMainFullLighterRed\" data-toggle=\"tooltip\" data-bss-tooltip=\"\" type=\"button\" title=\"Add option\"onclick=\"deleteoption(this)\"><i class=\"fas fa-minus\"></i></button><input type=\"text\" class=\"inputMain\" placeholder=\"Option..\" required></div> </div>"
                btn.className = "DDCFFQ"
                elem.appendChild(btn);
            }
            else if(qtype==3){
                var btn = document.createElement("div");
                btn.innerHTML = "<input hidden value=\"multiselect\"><div class=\"DDCFFQWithAdd\"><button onclick=\"DeleteGParent(this)\" class=\"btn btnMain btnMainFull btnMainFullLighter btnMainFullLighterRed\" data-toggle=\"tooltip\" data-bss-tooltip=\"\" type=\"button\" title=\"Add option\"><i class=\"fas fa-minus\"></i></button> <p class=\"DDCFFQPara\">Multiple select (Checkbox) question type</p> </div> <div class=\"DDCFFQField\"> <div class=\"DDCFFQQuestion DDCFFQQWithOptions\"><input type=\"text\" class=\"inputMain\" placeholder=\"Your question..\" required> <div class=\"DDCFFQQWO\"><button class=\"btn btnMain btnMainFull btnMainFullLighter\" data-toggle=\"tooltip\" data-bss-tooltip=\"\" type=\"button\"onclick=\"addoption(this)\" ><i class=\"fas fa-plus\"></i></button></div> </div> <div class=\"DDCFFQFOptionHolder\"><button class=\"btn btnMain btnMainFull btnMainFullLighter btnMainFullLighterRed\" data-toggle=\"tooltip\" data-bss-tooltip=\"\" type=\"button\" title=\"Add option\"onclick=\"deleteoption(this)\"><i class=\"fas fa-minus\"></i></button><input type=\"text\" class=\"inputMain\" placeholder=\"Option..\" required></div> <div class=\"DDCFFQFOptionHolder\"><button class=\"btn btnMain btnMainFull btnMainFullLighter btnMainFullLighterRed\" data-toggle=\"tooltip\" data-bss-tooltip=\"\" type=\"button\" title=\"Add option\"onclick=\"deleteoption(this)\"><i class=\"fas fa-minus\"></i></button><input type=\"text\" class=\"inputMain\" placeholder=\"Option..\" required></div> </div>"
                btn.className = "DDCFFQ"
                elem.appendChild(btn);
            }
    }
    function gg(){
        if(document.getElementById('gg').childElementCount<2)
        {
            alert('you need to add at least 2 questions');
            return;
        }
        if(document.getElementById("title").value=="")
        {
            alert("the title is required")
            return;
        }
     //   var elem = document.querySelector(".DDCFFQHolder");
        var initElement = document.querySelector(".DDCFFQHolder");
        var json = mapDOM(initElement, true);
   //     var i,questions;
      //  alert(elem.childElementCount);
       //  elem = JSON.stringify(elem);

    }
    // Test with an element.


    // Test with a string.
  //  initElement = "<div><span>text</span>Text2</div>";
  //  json = mapDOM(initElement, true);

    function mapDOM(element, json) {
        var treeObject = [];

        // If string convert to document Node

        //Recursively loop through DOM elements and assign properties to object
        function treeHTML(treeObject) {
          var  elem=document.getElementsByClassName('DDCFFQ');
            var element=elem.childNodes;
            for(let i=0;i<elem.length;i++) {
                var object = {};
                var c = elem[i];
                var x = c.children;
                if(x[0].value=="")
                {
                    alert('there was an error processing your form');
                    return;
                }
                object['type']=x[0].value;
                if (x[0].value == "shorttext" || x[0].value == "largetext") {
                    object['question'] = x[2].value;
                } else
                {
                    var q=x[2].children;
                    var qq=q[0].children;
                    if(qq[0].value=="")
                    {
                        alert('you need to fill all fields');
                        return;
                    }
                    object['question'] = qq[0].value;
                    object['options']=[];
                    for(let i=1;i<q.length;i++)
                    {
                     var option=q[i].children;
                        if(option[1].value.value=="")
                        {
                            alert('you need to fill all fields');
                            return;
                        }
                     object['options'][i-1]=option[1].value;

                    }
                }
                treeObject[i]=object;
            }
            json= JSON.stringify(treeObject)
            document.getElementById('xxx').value=json
            event.preventDefault();
            document.getElementById('ff').submit();
        }
        treeHTML(treeObject);



    }
</script>

