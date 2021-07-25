
    var ct = 1;
    function new_title()
    {
        ct++;
        var div1 = document.createElement('div');
        div1.id = ct;
        // link to delete extended form elements
        var delLink = '<div style="text-align:right;margin-right:65px"><a href="javascript:delIt('+ ct +')">Del</a></div>';
        div1.innerHTML = document.getElementById('shablone').innerHTML + delLink;
        document.getElementById('titul_group').appendChild(div1);
    }
    function delIt(eleId)
    {
        d = document;
        var ele = d.getElementById(eleId);
        var parentEle = d.getElementById('titul_group');
        parentEle.removeChild(ele);
    }


