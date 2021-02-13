$(document).ready(function(){

   /* Active Sidebar */
    hiddenPathDomain = function(str) {
        return str.replace('http://localhost','');
    }

    var url = window.location.pathname;  
    var activePage = hiddenPathDomain(url);

    const SelectorParent = document.querySelectorAll('li.dropdown ul.dropdown-menu li a');
    for(i=0; i < SelectorParent.length; i++){
        var sidebarUrl = hiddenPathDomain(SelectorParent[i].getAttribute('href'));
        if(activePage == sidebarUrl){
            var elementsParent = SelectorParent[i].parentElement.parentElement.parentElement;
            elementsParent.classList.add('active');
            var elementsDropdown = SelectorParent[i].parentElement.parentElement;
            elementsDropdown.style.display = 'block'; 
        }
    }

    const SelectorChild = document.querySelectorAll('ul.sidebar-menu li a');
    for(i= 0; i < SelectorChild.length; i++){
        var currentPage = hiddenPathDomain(SelectorChild[i].getAttribute('href'));
        if(currentPage == activePage){
            SelectorChild[i].parentElement.classList.add('active');
        }
    }
    /* End of Active Sidebar */

    /* Setting notify, base url & reload */
    const myStack = new PNotify.Stack({
        dir1: 'down',
        dir2: 'left',
        firstpos1: 20,
        firstpos2: 20,
        spacing1: 10,
        spacing2: 10,
        push: 'bottom',
        overlayClose: false,
        modal: false,
        context: document.body,
        maxOpen : Infinity
      });

    const PNotifys = function(title,text,type,icon,delay){
        var delays = typeof delay ==="undefined" ? 1500 : delay;
        PNotify.alert({
            title : title,
            text: text,
            type : type,
            icon: icon,
            delay: delays,
            stack : myStack
        });
    }

    const reload = function(){
        return window.location.reload();
    }

    const arrNotif = {Warning:"notice", Success: "success", Info: "info"};

    var base_url = document.getElementById("url").value;
    var xhrRequest = new XMLHttpRequest;
    /* End setting */

    /* Ajax Error handling */
    const errorHandling = function (getStatus, getResponse){
        var alertError = document.querySelector('.alert-error');
        alertError.style.display = 'block';
        alertError.innerHTML = getStatus+"<br>"+getResponse;
        $.magnificPopup.close();
        window.scrollBy(0,-1000);
    }
    /* End error handling */

    /* Send email */
    var btn = document.getElementById("send_msg");
    if(btn){
        btn.addEventListener('click', function(){
            var mail = document.querySelector("#mail_form");
            var url = base_url+"home/sendmail";
            var data = serialize(mail);
            xhrMail = xhrRequest;
            xhrMail.open("POST", url, true);
            xhrMail.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            beforeSend = function(){
                PNotifys("Success","Email sedang dikirim mohon ditunggu...", "success","fa fa-refresh fa-spin");
            }
            xhrMail.onreadystatechange = function(){
                var notify = document.querySelectorAll(".brighttheme-success");
                if(this.readyState == 4 && this.status == 200){
                    var response = JSON.parse(this.responseText);
                    document.querySelector("input[name='"+response.token_name+"']").value = response.token;
                    for(i = 0; i < notify.length; i++){
                        notify[i].style = "display:none";
                    }
                    PNotifys(response.msg,response.text, arrNotif[response.msg],"fa fa-info-circle", 5000);
                }
                if(this.readyState == 3 && this.status >= 400){
                    for(i = 0; i < notify.length; i++){
                        notify[i].style = "display:none";
                    }
                    PNotifys("Error","Request Not Allowed", "info","fa fa-info-circle");
                }
            }
            beforeSend();
            send = xhrMail.send(data);
        });
    }
    /* End send email */


    /* Reset token */
    resetToken = function(getToken){
        valueSecurity = document.querySelectorAll(".security_token");
        for(i = 0; i < valueSecurity.length; i++){
            valueSecurity[i].value = getToken;
        }
    }

    /* Pop up for update & delete data */
    editForm = function(typeOfPop){
        var src;
        switch(typeOfPop)
        {
            case 'intern_detail':
                src = '#editForm2';
            break;
            default :
                src = '#editForm';
            break;
        }
        $.magnificPopup.open({
            items : {
                src : src
            },
            type : 'inline',
            modal : true,
            callbacks: {
                beforeOpen: function() {
                    if($(window).width() < 700) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '#name';
                    }
                }
            },
        });
    }

    popUpUpdate = function(i, typeOfPop){
        var controller;
        switch(typeOfPop){
            case 'apps':
                controller = "dashboard/getAppsById";
            break;
            case 'conf':
                controller = "dashboard/getConfById";
            break;
            case 'intern':
                controller = "dashboard/getInternById";
            break;
            case 'experience':
                controller = "dashboard/getExpById";
            break;
            case 'intern_detail':
                controller = "dashboard/getDetailInternById";
            break;
        }
        var url = base_url+controller;
        xhrData = xhrRequest;
        xhrData.open("POST", url);
        xhrData.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhrData.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                try{
                    var response = JSON.parse(this.responseText, true);
                }
                catch(err){
                    errorHandling(this.statusText, this.responseText);
                }
                switch(typeOfPop){
                    case 'apps'             :
                    case 'intern'           :
                    case 'intern_detail'    :
                    case 'experience'    :
                        var listUpdateApps = document.querySelectorAll('#update_'+typeOfPop+' .form-control');
                        for(x = 0; x < listUpdateApps.length; x++){
                            var listName = listUpdateApps[x].getAttribute('name');
                            var listType = listUpdateApps[x].getAttribute('type');
                            if(listType !== 'file'){
                                if(listName == "description" || listName == "requirement"){
                                    listUpdateApps[x].value = response[listName].replaceAll("<br>","\n");
                                }else{
                                    listUpdateApps[x].value = response[listName];
                                }
                                document.querySelector('button[name="update_'+typeOfPop+'"]').setAttribute('id', i);
                               }else{
                                listUpdateApps[x].setAttribute('value', response[listName]);
                                document.querySelector('.walpaper').setAttribute('src', base_url+"assets/img/portfolio/"+response[listName]);
                            }
                        }
                    break;
                    case 'conf':
                        document.querySelector(".value").value = response.value;
                        document.querySelector(".desc").value = response.desc;
                        document.querySelector(".content").value = response.content;
                        $("button[name='update_conf']").attr("id", i);
                    break;
                }
                resetToken(response.token);
            }else{
                if(this.statusText != "OK" && this.statusText != ""){
                    var alertError = document.querySelector('.alert-error');
                    alertError.style.display = 'block';
                    alertError.innerHTML = "Error : "+this.statusText;
                }
            }
        }
        xhrData.send("id="+i+"&my_portfolio_csrf="+$(".security_token").val());
        editForm(typeOfPop);
    }

    $(document).on('click', '.modal-dismiss', function (e) {
        e.preventDefault();
        $.magnificPopup.close();
    });

    deleteData = function(i, typeOfDelete){
        switch(typeOfDelete)
        {
            case 'intern_detail':
                var src = '#deleteDetail';
            break;
            default :
                var src = '#deleteData'
            break;
        }
        var data_id = i;
        $(".modal-confirm_delete").attr("id", data_id);
        $.magnificPopup.open({
            items : {
                src : src
            },
            type : 'inline',
            modal : true,
            callbacks: {
                beforeOpen: function() {
                    if($(window).width() < 700) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '#name';
                    }
                }
            },
        });
        $(".modal-text p").html("Apakah anda yakin ingin menghapus data dengan ID #"+data_id+ " ?");
    }
    /* End pop up */
    
    /* Create, Update, Delete data (CUD) */
    // For add data
    addData = function(modal, form_data, typeOfData){
        var controller;
        switch(typeOfData){
            case 'configurable':
                controller = 'add_configurable';
            break;

            case 'apps':
                controller = "add_apps";
            break;

            case 'intern':
                controller = "add_intern";
            break;

            case 'intern_detail':
                controller = "add_intern_detail";
                console.log(form_data);
            break;

            case 'apps_img':
                controller = "add_image";
            break;
        }
        $.ajax({
            url : base_url+"dashboard/"+controller,
            type : "post",
            dataType : "json",
            data : form_data,
            processData : false,
            contentType : false,
            success:function(response){
                resetToken(response.token);
                if(response.msg == "Success"){
                    sessionStorage.setItem("title", response.msg);
                    sessionStorage.setItem("text", response.text);
                    reload();
                }else{
                    modal.find(".modal-body").prepend('<div class="alert alert-warning">'+response.text+'</div>');
                }
            },
            error:function(xhr, ajaxOptions, thrownError){
                modal.find(".modal-body").prepend('<div class="alert alert-danger">'+thrownError+'</div>');
                resetToken(response.token);
            }
        });
    }

    //For delete data
    deleteX = function(typeOfDelete, id){
        var controller;
        switch(typeOfDelete){
            case 'delete_conf':
                controller = "delete_configurable";
            break;
            case 'delete_apps':
                controller = "delete_apps/"+id;
            break;
            case 'delete_intern':
                controller = "delete_intern";
            break;
            case 'delete_intern_detail':
                controller = "delete_intern_detail";
            break;
            case 'delete_apps_img':
                controller = "delete_image";
            break;
        }
        url = base_url+"dashboard/"+controller;
        xhrUpt = xhrRequest;
        xhrUpt.open("POST", url, true);
        xhrUpt.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhrUpt.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                response = JSON.parse(this.responseText);
                resetToken(response.token);
                if(response.msg == "Success"){
                    sessionStorage.setItem("title", response.msg);
                    sessionStorage.setItem("text", response.text);
                    reload();
                }
            }
        }
        xhrUpt.send("id="+id+"&my_portfolio_csrf="+$(".security_token").val());
    }

    //For update data
    updateData = function(typeOfUpdate, id, formData){
        var controller;
        switch(typeOfUpdate){
            case 'update_conf':
                controller = "edit_configurable/"+id;
            break;
            case 'update_apps':
                controller = "edit_apps/"+id;
            break;
            case 'update_intern':
                controller = "edit_intern/"+id;
            break;
            case 'update_intern_detail':
                controller = "edit_detail_intern/"+id;
            break;
        }
        url = base_url+"dashboard/"+controller;
        xhrUpt = xhrRequest;
        xhrUpt.open("POST", url, true);
        if(typeOfUpdate != "update_apps"){
            xhrUpt.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        }
        xhrUpt.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                try{
                    response = JSON.parse(this.responseText);
                }
                catch(err){
                    errorHandling(this.statusText, this.responseText);
                }
                if(response.msg == "Success"){
                    sessionStorage.setItem("title", response.msg);
                    sessionStorage.setItem("text", response.text);
                    reload();
                }else{
                    var alert = document.querySelector(".edit_data");
                    alert.classList.add("alert-warning");
                    alert.innerHTML = response.text;
                    alert.style.display = 'block';
                }
                resetToken(response.token);
            }
            else if(this.status >= 400) {
                errorHandling(this.statusText, this.responseText);
            }
        }
        xhrUpt.send(formData);
    }
    /* End of CUD */

    /* Button for CUD & Select by radio */

    //Button add data
    var buttonData = document.querySelectorAll('a[href="#add"]');
    for(xbtn = 0; xbtn < buttonData.length; xbtn++){
        var bodyAddData;
        var typeData = buttonData[xbtn].getAttribute('id');
        switch(typeData){
            case 'add_data':
                bodyAddData = $('#form_add');
            break;
            case 'add_detail':
                bodyAddData = $('#form_detail');
            break;
        }
        $("#"+typeData).fireModal({
            title: 'Add Data',
            body: bodyAddData,
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {
                var form_data = new FormData(this); //$(e.target).serialize(); 
                let ajax = setTimeout(function() {
                    form.stopProgress();
                    var target = e.target;
                    data = target.attributes.data.value;
                    console.log(data);
                    if(data == "intern_detail"){
                        var typeOfData = $('.modal-body form.form2').attr('data');
                    }else{
                        var typeOfData = $('.modal-body form').attr('data');
                    }
                    addData(modal, form_data, typeOfData);
                    $(".alert-warning").hide();
                    clearInterval(ajax);
                }, 1500);
                e.preventDefault();
            },
            buttons: [
                {
                    text: 'Submit',
                    submit: true,
                    class: 'btn btn-primary btn-shadow',
                    handler: function(modal) {
                    }
                }
            ]
      });
    }

    //button update data
    var update = document.querySelectorAll(".modal-update");
    for(i=0; i < update.length; i++){
        if(update[i]){
            update[i].addEventListener('click', function(e){
                var typeOfUpdate = this.name;
                var id = this.id;
                var formData;
                if(this.name != "update_apps"){
                    formData = serialize(document.getElementById(this.name));
                }else{
                    //formData = serialize(document.getElementById("update_apps"));
                    formData = new FormData($('#update_apps')[0]);
                }
                updateData(typeOfUpdate, id, formData);
                e.preventDefault();
            });
        }
    }

    //button delete data *notes : Get type of update by names attribute which class modal-confirm-delete
    var del = document.querySelectorAll(".modal-confirm_delete");
    for(i = 0; i < del.length; i++){
        del[i].addEventListener('click', function(){
            var typeOfDelete = this.name; // <-- 
            console.log(typeOfDelete);
            var id = this.id;
            //console.log(typeOfDelete);
            deleteX(typeOfDelete, id);
        }); 
    }

    //Select by radio
    var radio = document.querySelectorAll('#radioButton');
    for(i = 0; i < radio.length; i++){
        radio[i].addEventListener('click',function(){
            document.querySelector('input[name="experience_id"]').setAttribute('value', this.value);
            if(this.name == "radio"){
                url = base_url+"dashboard/getDetailIntern";
            }
            if(this.name == "experience"){
                url = base_url+"dashboard/getDetailExp";
            }
            var detailTable = document.querySelector('table[id="table-2"] tbody');
            xhrGet = xhrRequest;
            xhrGet.open('POST',url, true);
            xhrGet.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xhrGet.onreadystatechange = function (){
                if(this.readyState == 4 && this.status == 200){
                    try {
                        response = JSON.parse(this.responseText);
                    }
                    catch(err) {
                        errorHandling(err+"<br", this.responseText);
                    }
                    resetToken(response[0].token);
                    html = "";
                    for(x = 0; x < response.length; x++){
                        intern_detail = response[0].data;
                        html += "<tr>"+
                                    "<td>"+response[x].detail_intern_id+"</td>"+
                                    "<td>"+response[x].job_desc+"</td>"+
                                    "<td>"+response[x].date_time+"</td>"+
                                    "<td>"+
                                        '<a onclick="popUpUpdate('+response[x].detail_intern_id+', intern_detail)" class="btn btn-primary text-white"><i class="fa fa-edit"></i></a> '+
                                        '<a onclick="deleteData('+response[x].detail_intern_id+', intern_detail)" class="btn btn-danger text-white"><i class="fa fa-trash"></i></a> '+
                                    '</td>'+
                                "<tr>";
                    }
                    if(typeof response[0].detail_intern_id ==="undefined" ){
                        detailTable.innerHTML = '<tr><td colspan="4" class="text-center">No data available in table</td></tr>';
                    }else{
                        detailTable.innerHTML = '';
                        detailTable.innerHTML += html;
                    }
                }else if(this.status >= 400){
                    if(this.statusText != "OK"){
                        errorHandling(this.statusText, this.responseText);
                    }
                }
            }
            xhrGet.send('id='+this.value+'&my_portfolio_csrf='+document.querySelector('.security_token').value);
        });
    }
    /* End of button CUD */


    /* Get notify after reload page */
    $(function(){
        var session = sessionStorage;
        if(session.getItem('title') && session.getItem('text')){
            PNotifys(sessionStorage.getItem('title'),sessionStorage.getItem('text'), arrNotif[sessionStorage.getItem('title')],"fa fa-check", 5000);
            session.removeItem("title");
            session.removeItem("text");
        }
    });

});